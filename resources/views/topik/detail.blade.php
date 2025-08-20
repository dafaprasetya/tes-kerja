@extends('layouts.wowdash.core')
@section('body')
@include('topik.sidebar')
<main class="dashboard-main">
    @include('topik.topbar')
    <div class="modal fade modal-lg" id="modalAdd" tabindex="-1" aria-labelledby="basicModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card h-100 p-0 radius-12 overflow-hidden">
                    <div class="card-body p-0">
                        <div class="card-body">
                            <div class="card-title">
                                <p>Tambah Dataset</p>
                            </div>
                            <div class="row gy-3">

                                <form id="tambahForm" action="{{ route('dataset.form.post') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="col-12">
                                        <input type="text" name="topik_id" value="{{ $topik->id }}" hidden>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Nama Dataset</label>
                                        <input type="text" name="nama_dataset" class="form-control" placeholder="Nama Dataset">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">File</label>
                                        <input type="file" name="file" class="form-control">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" onclick="event.preventDefault();
                  document.getElementById('tambahForm').submit();" class="btn btn-primary">Simpan</button>
            </div>

            </div>
        </div>
    </div>
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">{{ $topik->topik }}</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Topik
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">List</li>
            </ul>
        </div>

        <div class="card h-100 p-0 radius-12 overflow-hidden">
            <div class="card-body p-40">
                @if (session()->has('success'))
                    <div class="alert alert-success bg-success-600 text-white border-success-600 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
                        {{ session('success') }}
                        <button class="remove-button text-white text-xxl line-height-1"> <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon></button>
                    </div>
                @endif
                <button type="button" href="" class="btn mb-3 btn-outline-primary-600 radius-8 px-20 py-11 fw-medium text-sm" data-bs-toggle="modal" data-bs-target="#modalAdd">Tambah Dataset</button>

                <div class="table-responsive">
                    <table class="table striped-table mb-0">
                        <thead>
                        <tr>
                            <th scope="col">Nama Dataset</th>
                            <th scope="col">Pengupload</th>
                            <th scope="col">Metadata info</th>
                            <th scope="col" class="text-center">Last Update</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($datasets as $dataset)
                            <tr>
                                <td>{{ $dataset->nama_dataset }}</td>
                                <td>{{ $dataset->user->name }}</td>
                                <td class="text-center">
                                    @php
                                    $metaDataInfos = json_decode($dataset->metadata_info, true);
                                    @endphp
                                    <span class="bg-success-focus text-success-main px-32 py-4 rounded-pill fw-medium text-sm">{{ $metaDataInfos['extension'] }}</span>
                                </td>
                                <td>{{ $dataset->last_update }}</td>
                                <td>
                                    <div class="row ">
                                        <div class="col-sm-4">
                                            <a type="button" href="{{ route('dataset.download', $dataset->id) }}" class="btn btn-outline-primary-600 radius-8 px-20 py-11 fw-medium text-sm">Download</a>
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="button" class="btn mb-3 btn-outline-success-600 radius-8 px-20 py-11 fw-medium text-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $dataset->id }}">Update</button>
                                            <div class="modal fade modal-lg" id="editModal{{ $dataset->id }}" tabindex="-1" aria-labelledby="basicModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card h-100 p-0 radius-12 overflow-hidden">
                                                                <div class="card-body p-0">
                                                                    <div class="card-body">
                                                                        <div class="card-title">
                                                                            <p>Edit Dataset</p>
                                                                        </div>
                                                                        <div class="row gy-3">

                                                                            <form id="editForm{{ $dataset->id }}" action="{{ route('dataset.edit.post', $dataset->id) }}" method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                                <div class="col-12">
                                                                                    <input type="text" name="topik_id" value="{{ $topik->id }}" hidden>
                                                                                </div>

                                                                                <div class="col-12">
                                                                                    <label class="form-label">Nama Dataset</label>
                                                                                    <input type="text" name="nama_dataset" class="form-control" value="{{ $dataset->nama_dataset }}" placeholder="Nama Dataset">
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <label class="form-label">File</label>
                                                                                    <input type="file" name="file" class="form-control">
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                            <button type="button" onclick="event.preventDefault();
                                                            document.getElementById('editForm{{ $dataset->id }}').submit();" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <form action="{{ route('dataset.delete', $dataset->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger-600 radius-8 px-20 py-11 fw-medium text-sm">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $datasets->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('scripts')
<script>
    $('.remove-button').on('click', function() {
        $(this).closest('.alert').addClass('d-none')
    });
</script>
@endsection
