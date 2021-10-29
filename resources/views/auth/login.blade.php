@extends('auth.app')

@section('title', 'Login')

@section('content')
    @error('email')
        <p class="text-danger">{{ $message }}</p>
    @enderror

    <form action="/login" method="post">
        @csrf
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Email" name="email">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- /.col -->
            <div class="col">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
            </div>
            <!-- /.col -->
        </div>
    </form>
@endsection
