@extends('layouts.master')

@section('title', 'Daftar Produk')

@section('content')
    <div class="container-fluid">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Sukses!</h5>
                {{ $message }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm btn-flat"><i
                            class="fa fa-plus"></i> Tambah Produk</a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped mb-3">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Kategori</th>
                            <th>Desc</th>
                            <th>Act</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $item)
                            <tr>
                                <td>{{ $loop->iteration + $products->firstItem() - 1 }}</td>
                                <td>
                                    <img class="img-circle elevation-2 d-inline mr-2" src="{{ Storage::url($item->photo) }}" style="width: 50px; height: 50px;" alt="User Avatar">
                                    {{ $item->name }}
                                </td>
                                <td><strong class="text-danger">Rp
                                        {{ number_format($item->price, 0, ',', '.') }}</strong>
                                </td>
                                <td>{{ $item->product_category->name }}</td>
                                <td>{!! $item->description !!}</td>
                                <td>
                                    <a href="{{ route('product.edit', $item) }}">Edit</a> |
                                    <a href="{{ route('product.destroy', $item) }}"
                                        onclick=" event.preventDefault(); if(confirm('Yakin ingin menghapus?')) { document.getElementById('form-{{ $item->id }}').submit(); }"
                                        class="text-danger">Hapus</a>
                                    <form id="form-{{ $item->id }}" action="{{ route('product.destroy', $item) }}"
                                        method="post" style="display: none;">@csrf @method('DELETE')</form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Data produk masih kosong. Silahkan <a
                                        href="{{ route('product.create') }}">tambah produk</a>.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $products->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
