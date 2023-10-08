@extends('layouts.home')

@section('content')
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-7 text-center text-lg-start">
                <h1 class="display-4 fw-bold lh-1 mb-3">تسجيل دخول {{ $title ?? '' }}</h1>
                <img src="{{ asset('images/undraw_fingerprint_re_uf3f.svg') }}" alt="" class="w-75">
            </div>
            <div class="col-md-10 mx-auto col-lg-5">
                @isset($url)
                    <form method="POST" action='{{ url("login/$url") }}' aria-label="{{ __('Login') }}"
                        class="p-4 p-md-5 border rounded-3 bg-light">
                    @else
                        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}"
                            class="p-4 p-md-5 border rounded-3 bg-light">
                        @endisset
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                name="username" value="{{ old('username') }}" required autofocus>
                            <label for="floatingInput">اسم المستخدم</label>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" value="{{ old('password') }}" required autofocus>
                            <label for="floatingPassword">كلمة السر</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                تذكرني
                            </label>
                        </div>
                        <button class="w-100 btn btn-lg btn-primary" type="submit">سجل دخولك</button>

                    </form>
            </div>
        </div>
    </div>
@endsection
