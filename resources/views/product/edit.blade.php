@extends('layouts.master')

@section('title', 'Edit Produk')

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
                    <form id="form" action="{{ route('product.update', $product) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Nama Produk</label>
                                <input type="text" class="form-control rounded-0" name="name" value="{{ $product->name }}">
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea class="ckeditor form-control rounded-0"
                                    name="description">{{ $product->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Harga Produk</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" name="price" class="form-control rounded-0"
                                        value="{{ $product->price }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Kategori Produk</label>
                                <select name="product_category_id" class="form-control rounded-0 product_category_select2">
                                    <option disabled selected>Pilih...</option>
                                    @foreach ($product_categories as $item)
                                        <option {{ $product->product_category_id == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Upload Foto Produk</label>
                                <input type="file" name="photo" class="form-control" accept=".jpg, .jpeg, .png"
                                    onchange="readURL(this)">
                                @if ($product->photo)
                                    <img src="{{ Storage::url($product->photo) }}" class="mt-3"
                                        alt="Product Photo" id="photo" style="width: 150px; height: 150px;">
                                @else
                                    <img src="#" alt="" id="photo">
                                @endif
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
                            <button type="submit" class="btn btn-flat btn-info">Simpan</button>
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
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
            $('.product_category_select2').select2();

            $('#form').ajaxForm({
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
                success: function(xhr) {
                    location.href = '{{ route('product.index') }}'
                }
            });
        });


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
