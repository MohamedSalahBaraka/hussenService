@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-column w-50">
        <div class="headding color-orange">تعديل حساب بنكي </div>
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
        <form method="POST" action="{{ route('admin.bank.update.action') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $bank->id }}">
            <div class="form-floating mb-3">
                <input type="number" class="form-control @error('number') is-invalid @enderror" name="number"
                    value="{{ $bank->number }}" required autofocus>
                <label for="floatingInput">رقم الحساب</label>
                @error('number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('owner') is-invalid @enderror" name="owner"
                    value="{{ $bank->owner }}" required autofocus>
                <label for="floatingInput">اسم صاحب الحساب </label>
                @error('owner')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('bank') is-invalid @enderror" name="bank"
                    value="{{ $bank->bank }}" required autofocus>
                <label for="floatingInput">اسم البنك</label>
                @error('bank')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mt-4 mb-0">
                <div class="d-grid"><button class="btn btn-warning btn-block headding" type="submit">عدل
                        الحساب بنكي </button>
                </div>
            </div>
        </form>
    </div>
@endsection
