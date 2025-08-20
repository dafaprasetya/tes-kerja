@extends('layouts.wowdash.core')
@section('body')
@include('topik.sidebar')
<main class="dashboard-main">
    @include('topik.topbar')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Topik</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{ route('topik.list') }}" class="d-flex align-items-center gap-1 hover-text-primary">
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
                <div class="table-responsive">
                    <table class="table striped-table mb-0">
                        <thead>
                        <tr>
                            <th scope="col">Nama Topik</th>
                            <th scope="col">Pembuat</th>
                            <th scope="col" class="text-center">Jumlah Dataset</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($topiks as $topik)
                            <tr>
                                <td>{{ $topik->topik }}</td>
                                <td>{{ $topik->user->name }}</td>
                                <td class="text-center">
                                    <span class="bg-success-focus text-success-main px-32 py-4 rounded-pill fw-medium text-sm">{{ $topik->dataset->count() }}</span>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <a type="button" href="{{ route('topik.detail', $topik->id) }}" class="btn btn-outline-primary-600 radius-8 px-20 py-11 fw-medium text-sm">Lihat</a>
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="button" class="btn mb-3 btn-outline-success-600 radius-8 px-20 py-11 fw-medium text-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $topik->id }}">Update</button>
                                            <div class="modal fade modal-lg" id="editModal{{ $topik->id }}" tabindex="-1" aria-labelledby="basicModalLabel" aria-hidden="true">
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
                                                                            <p>Update "{{ $topik->topik }}"</p>
                                                                        </div>
                                                                        <div class="row gy-3">
                                                                            <form id="editForm{{ $topik->id }}" action="{{ route('topik.edit.post', $topik->id) }}" method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                                <div class="col-12">
                                                                                    <label class="form-label">Nama Topik</label>
                                                                                    <input type="text" name="topik" value="{{ $topik->topik }}" class="form-control" placeholder="Masukan Nama Topik">
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
                                                            document.getElementById('editForm{{ $topik->id }}').submit();" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <form action="{{ route('topik.delete', $topik->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger-600 radius-8 px-20 py-11 fw-medium text-sm">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $topiks->links('pagination::bootstrap-5') }}
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

