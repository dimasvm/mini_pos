@extends('layouts.master')

@section('title', 'Tambah Produk')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
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
                    <form id="main-form" action="{{ route('product.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Nama Produk</label>
                                <input type="text" class="form-control rounded-0" name="name" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea class="ckeditor form-control rounded-0" name="description">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Harga Produk</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" name="price" class="form-control rounded-0" value="{{ old('price') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Kategori Produk</label>
                                <select name="product_category_id" class="form-control select2bs4 rounded-0 ">
                                    <option disabled selected>Pilih...</option>
                                    @foreach ($product_categories as $item)
                                        <option value="{{ $item->id }}" {{ old('product_category_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Upload Foto Produk</label>
                                <input type="file" name="photo" class="form-control" accept=".jpg, .jpeg, .png"
                                    onchange="readURL(this)">
                                <img src="#" class="mt-3" alt="Product Photo" id="photo"
                                    style="display: none;">
                            </div>
                            <div class="form-group">
                                <div class="progress progress-sm">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                        role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                        style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" value="Simpan" class="btn btn-flat btn-info">
                            <a href="{{ route('product.index') }}" class="btn btn-flat btn-default float-right">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/select2-bootstrap4.min.css') }}">
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="product_category_id"]').select2({theme: 'bootstrap4'});
            $('.ckeditor').ckeditor();

        });

        function upload(input) {

            $('#upload-form').ajaxForm({
                beforeSend: function(event) {
                    event.preventDefault();
                    var percentage = '0';
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentage = percentComplete;
                    $('.progress .progress-bar').css("width", percentage + '%', function() {
                        return $(this).attr("aria-valuenow", percentage) + "%";
                    })
                },
                error: function(err) {
                    console.error(err)
                },
                success: function(xhr) {
                    readURL(input)
                }
            });
        }


        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#photo').show();
                    $('#photo')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(150);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
