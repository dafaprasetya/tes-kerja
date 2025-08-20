<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use App\Models\Topik;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TopikController extends Controller
{
    //
    public function index() {
        // return view('home');
        $topikTotal = Topik::count();
        $datasetTotal = Dataset::count();
        $datasetByTopik = Topik::withCount('dataset')->count();
        $topikAll = Topik::all();
        $data = [
            'datasetByTopik' => $datasetByTopik,
            'totalTopik' => $topikTotal,
            'totalDataset' => $datasetTotal,
            'topikAll' => $topikAll,
            'title' => 'Dashboard Topik',
        ];
        return view('topik.dashboard', $data);
    }
    public function formAdd() {
        $data = [
            'topics' => Topik::all(),
            'title' => 'Tambah Topik',
        ];
        return view('topik.tambah', $data);
    }
    public function formAddDataset() {
        $data = [
            'topics' => Topik::all(),
            'title' => 'Tambah Topik',
        ];
        return view('topik.tambahDataset', $data);
    }
    public function topikList(Request $request) {
        $topic = Topik::paginate(10);
        if (request()->has('search')) {
            $search = request()->input('search');
            $topic = Topik::where('topik', 'like', '%' . $search . '%')->get();
        }
        $data = [
            'topiks' => $topic,
            'title' => 'List Topik',
        ];
        return view('topik.list', $data);
    }
    public function deleteTopik($id) {
        $topic = Topik::findOrFail($id);
        $datasets = Dataset::where('topik_id', $id)->get();
        foreach ($datasets as $dataset) {
            Storage::disk('public')->delete($dataset->files);
        }
        $topic->delete();
        return redirect()->back()->with('success', 'Topik Berhasil Dihapus');
    }
    public function deleteDataset($id) {
        $dataset = Dataset::findOrFail($id);
        $filePath = storage_path('app/public/' . $dataset->files);
        Storage::disk('public')->delete($dataset->files);
        $dataset->delete();
        return redirect()->back()->with('success', 'Dataset Berhasil Dihapus');
    }
    public function topikDetail($id, Request $request) {
        $topic = Topik::findOrFail($id);
        $dataset = Dataset::where('topik_id', $id)->paginate(5);
        if ($request->has('search')) {
            $search = $request->input('search');
            $dataset = Dataset::where('topik_id', $id)
                ->where('nama_dataset', 'like', '%' . $search . '%')
                ->paginate(10);
        }
        $data = [
            'topik' => $topic,
            'datasets' => $dataset,
            'title' => 'List Topik',
        ];
        return view('topik.detail', $data);
    }
    public function topikAddPost(Request $request) {
        $request->validate([
            'topik' => 'required|string|max:255|unique:topiks,topik',
        ]);

        $topic = Topik::create([
            'topik' => $request->topik,
            'user_id' => $request->user()->id,
        ]);

        return redirect()->back()->with('success', 'Topik Berhasil Ditambahkan');
        // return view('topik.', $data);
    }
    public function topikEditPost($id, Request $request) {
        $request->validate([
            'topik' => 'required|string|max:255|unique:topiks,topik',
        ]);
        $topic = Topik::find($id);
        $topic->topik = $request->topik;
        $topic->user_id = $request->user()->id;
        $topic->save();
        return redirect()->back()->with('success', 'Topik Berhasil diupdate');
        // return view('topik.', $data);
    }
    public function datasetAddPost(Request $request) {
        $request->validate([
            'topik_id'      => 'required|exists:topiks,id',
            'nama_dataset'  => 'required|string|max:255',
            'file'          => 'required|file|mimes:xlsx,csv,xls|max:2048',
        ]);

        $path = $request->file('file')->store('datasets', 'public');
        $dataArray = Excel::toArray([], $request->file('file'));
        $sheetData = $dataArray[0] ?? [];
        $metaDataJson = [
            "sheet" => $sheetData,
        ];
        $metaDataInfo = [
            'original_name' => $request->file('file')->getClientOriginalName(),
            'size' => $request->file('file')->getSize(),
            'extension' => $request->file('file')->getClientOriginalExtension(),
        ];

        $dataset = Dataset::create([
            'topik_id'      => $request->topik_id,
            'nama_dataset'  => $request->nama_dataset,
            'metadata_info' => json_encode($metaDataInfo, JSON_UNESCAPED_UNICODE),
            'meta_data_json'=> json_encode($metaDataJson, JSON_UNESCAPED_UNICODE),
            'files'     => $path,
            'user_id'     => $request->user()->id,
            'last_update'   => now()->format('Y-m-d H:i:s') . " by " . $request->user()->name,
        ]);
        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }
    public function datasetEditPost($id, Request $request) {
        $request->validate([
            'topik_id'      => 'required|exists:topiks,id',
            'nama_dataset'  => 'required|string|max:255',
            'file'          => 'nullable|file|mimes:xlsx,csv,xls|max:2048',
        ]);
        if ($request->hasFile('file')) {
            $dataset = Dataset::find($id);
            Storage::disk('public')->delete($dataset->files);
            $path = $request->file('file')->store('datasets', 'public');
            $dataArray = Excel::toArray([], $request->file('file'));
            $sheetData = $dataArray[0] ?? [];
            $metaDataJson = [
                "sheet" => $sheetData,
            ];
            $metaDataInfo = [
                'original_name' => $request->file('file')->getClientOriginalName(),
                'size' => $request->file('file')->getSize(),
                'extension' => $request->file('file')->getClientOriginalExtension(),
            ];
            $dataset->topik_id = $request->topik_id;
            $dataset->nama_dataset = $request->nama_dataset;
            $dataset->metadata_info = json_encode($metaDataInfo, JSON_UNESCAPED_UNICODE);
            $dataset->meta_data_json = json_encode($metaDataJson, JSON_UNESCAPED_UNICODE);
            $dataset->files = $path;
            $dataset->user_id = $request->user()->id;
            $dataset->last_update = now()->format('Y-m-d H:i:s') . " by " . $request->user()->name;
            $dataset->save();
            return redirect()->back()->with('success', 'Data Berhasil Diupdate');
        }else{
            $dataset = Dataset::find($id);
            $dataset->topik_id = $request->topik_id;
            $dataset->nama_dataset = $request->nama_dataset;
            $dataset->user_id = $request->user()->id;
            $dataset->last_update = now()->format('Y-m-d H:i:s') . " by " . $request->user()->name;
            $dataset->save();
            return redirect()->back()->with('success', 'Data Berhasil Diupdate');
        }
    }
    public function datasetDownload($id){
        $dataset = Dataset::findOrFail($id);

        $filePath = storage_path('app/public/' . $dataset->files);

        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }

        return response()->download($filePath);
    }

}
