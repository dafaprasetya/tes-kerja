@extends('layouts.wowdash.core')
@section('body')
@include('topik.sidebar')
<main class="dashboard-main">
    @include('topik.topbar')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Form tambah topik</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{ route('topik.list') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Topik
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Tambah</li>
            </ul>
        </div>

        <div class="card h-100 p-0 radius-12 overflow-hidden">
            <div class="card-body p-0">
                <div class="card-body">
                    <div class="card-title">
                        <p>Tambah Topik</p>
                    </div>
                    <div class="row gy-3">
                        @if (session()->has('success'))
                            <div class="alert alert-success bg-success-600 text-white border-success-600 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">
                                {{ session('success') }}
                                <button class="remove-button text-white text-xxl line-height-1"> <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon></button>
                            </div>
                        @endif
                        <form action="{{ route('topik.form.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf


                            <div class="col-12">
                                <label class="form-label">Nama Topik</label>
                                <input type="text" name="topik" class="form-control" placeholder="Masukan Nama Topik">
                            </div>
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-primary-600">Submit</button>
                            </div>
                        </form>
                    </div>
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
