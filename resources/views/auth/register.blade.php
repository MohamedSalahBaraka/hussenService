@extends('layouts.home')

@section('content')
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-7 text-center text-lg-start">
                <h1 class="display-4 fw-bold mb-3">انشئ حساب {{ $title ?? '' }}</h1>
                <img src="{{ asset('images/undraw_welcome_cats_thqn.svg') }}" alt="" class="w-75">
            </div>
            <div class="col-md-10 mx-auto col-lg-5">
                <form method="POST" action='{{ url("register/$url") }}' class="p-4 p-md-5 border rounded-3 bg-light">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required autofocus>
                        <label for="floatingInput">الأسم</label>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                            value="{{ old('username') }}" required autofocus>
                        <label for="floatingInput">اسم المستخدم</label>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autofocus>
                        <label for="floatingInput">البريد الالكتروني</label>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone"
                            value="{{ old('phone') }}" required autofocus>
                        <label for="floatingInput">رقم الهاتف</label>
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                            value="{{ old('password') }}" required autofocus>
                        <label for="floatingPassword">كلمة السر</label>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                            name="password_confirmation" value="{{ old('password_confirmation') }}" required autofocus>
                        <label for="floatingPassword">أكد كلمة السر</label>
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">انشئ حسابك</button>

                </form>
            </div>
        </div>
    </div>
@endsection
