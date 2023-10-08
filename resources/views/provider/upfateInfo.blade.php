@extends('layouts.provider')

@section('content')
    <div class="container d-flex flex-row flex-wrap flex-grow-1 justify-content-center align-items-center">
        <div class="col-md-6 col-12 row p-md-5 p-2">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
            <form method="POST" action="{{ route('provider.upfate.info.action') }}"
                class="p-md-4 p-md-5 border rounded-3 bg-light">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ $provider->name }}" required autofocus>
                    <label for="floatingInput">الأسم</label>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                    value="{{ $provider->username }}" required autofocus>
                <label for="floatingInput">اسم المستخدم</label>
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ $provider->email }}" required autofocus>
                    <label for="floatingInput">البريد الالكتروني</label>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone"
                        value="{{ $provider->phone }}" required autofocus>
                    <label for="floatingInput">رقم الهاتف</label>
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        <input id="inputPassword" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password"/>
                        <label for="inputPassword" class="normal">كلمة السر</label>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                         />
                        <label for="inputPasswordConfirm" class="normal">أكد كلمة السر</label>
                    </div>
                </div>
            </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">حفظ التغيرات</button>

            </form>
        </div>
        <div class="col-md-6 col-12">
            <img src="{{ asset('images/undraw_updated_resume_re_7r9j.svg') }}" alt="" class="w-100" />
        </div>
    </div>
@endsection
