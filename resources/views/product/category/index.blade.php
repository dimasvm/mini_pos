@extends('layouts.master')

@section('title', 'Daftar Kategori Produk')

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
                <a href="{{ route('product-category.create') }}" class="btn btn-sm btn-flat btn-primary"><i
                        class="fa fa-plus"></i> Tambah Data</a>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped mb-3">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($productCategories as $item)
                            <tr>
                                <td>{{ $loop->iteration + $productCategories->firstItem() - 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{!! $item->description !!}</td>
                                <td width="30%">
                                    <a href="{{ route('product-category.edit', $item) }}">Edit</a> |
                                    <a href="{{ route('product-category.destroy', $item) }}"
                                        onclick="event.preventDefault(); if(confirm('Yakin ingin menghapus?')) { document.getElementById('form-{{ $loop->index }}').submit() }"
                                        class="text-danger">Hapus</a>
                                    <form action="{{ route('product-category.destroy', $item) }}" method="POST"
                                        id="form-{{ $loop->index }}" style="display: none;">
                                        @csrf @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Data tidak ditemukan. Silahkan <a
                                        href="{{ route('product-category.create') }}">tambah kategori produk</a>.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $productCategories->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
