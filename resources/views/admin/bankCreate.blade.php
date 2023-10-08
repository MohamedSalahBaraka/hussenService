@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-column w-50">
        <div class="headding color-orange">اضافة تصنيف </div>
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
        <form method="POST" action="{{ route('admin.bank.create.action') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-floating mb-3">
                <input type="number" class="form-control @error('number') is-invalid @enderror" name="number"
                    value="{{ old('number') }}" required autofocus>
                <label for="floatingInput">رقم الحساب</label>
                @error('number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('owner') is-invalid @enderror" name="owner"
                    value="{{ old('owner') }}" required autofocus>
                <label for="floatingInput">اسم صاحب الحساب </label>
                @error('owner')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('bank') is-invalid @enderror" name="bank"
                    value="{{ old('bank') }}" required autofocus>
                <label for="floatingInput">اسم البنك</label>
                @error('bank')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mt-4 mb-0">
                <div class="d-grid"><button class="btn btn-primary btn-block headding" type="submit">أنشئ
                        تصنيف</button>
                </div>
            </div>
        </form>
    </div>
@endsection
