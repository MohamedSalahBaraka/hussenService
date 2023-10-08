@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-column w-50">
        <div class="headding color-orange">تعديل مستخدم</div>
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
        <form method="POST" action="{{ route('admin.user.update.action') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $user->id }}">
            <div class="form-floating mb-3">

                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ $user->name }}" required autofocus>
                <label for="floatingInput">الأسم</label>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                    value="{{ $user->username }}" required autofocus>
                <label for="floatingInput">اسم المستخدم</label>
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ $user->email }}" required autofocus>
                <label for="floatingInput">البريد الالكتروني</label>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone"
                    value="{{ $user->phone }}" required autofocus>
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
            <div class="mt-4 mb-0">
                <div class="d-grid"><button class="btn btn-warning btn-block headding" type="submit">عدل
                        المستخدم</button>
                </div>
            </div>
        </form>
    </div>
@endsection
