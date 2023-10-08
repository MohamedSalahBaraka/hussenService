@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-column w-50">
        <div class="headding color-orange">تعديل غرض </div>
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
        <form method="POST" action="{{ route('admin.perpose.update.action') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $perpose->id }}">
            <div class="form-floating mb-3">

                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ $perpose->name }}" required autofocus>
                <label for="floatingInput">الأسم</label>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mt-4 mb-0">
                <div class="d-grid"><button class="btn btn-warning btn-block headding" type="submit">عدل
                        الغرض </button>
                </div>
            </div>
        </form>
    </div>
@endsection
