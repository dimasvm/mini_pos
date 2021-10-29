@extends('layouts.master')

@section('title', 'Tambah Kategori Produk')

@section('content')
    <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <form action="{{ route('product-category.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nama Kategori</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea class="ckeditor form-control rounded-0" name="description"></textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-flat btn-info">Simpan</button>
                    <a href="{{ url()->previous() }}" class="btn btn-default btn-flat float-right">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>
@endpush
