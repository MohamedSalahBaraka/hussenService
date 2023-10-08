@extends('layouts.home')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="headding color-orange my-3">عملية دفع</div>
    </div>
    <div class="border container my-3">
        <div class="my-3">
            <div class="headding d-inline">اسم المستخدم</div>
            <div class="ms-2 normal d-inline">{{ $user->name }}</div>
        </div>
        <div class="my-3">
            <div class="headding d-inline">اسم الخدمة</div>
            <div class="ms-2 normal d-inline">{{ $service->title }}</div>
        </div>
        <div class="my-3">
            <div class="headding d-inline">المبلغ الكلي</div>
            <div class="ms-2 normal d-inline">{{ $service->price }}</div>
        </div>
    </div>
    <div class="normal ms-3">استعمل احد الحسابات التالية في الدفع وأدخل <strong class="color-orange"> اسم المستخدم في
            التعليق</strong></div>
    @foreach ($banks as $bank)
        <div class="border container my-3">
            <div class="my-3">
                <div class="headding d-inline">رقم الحساب</div>
                <div class="ms-2 normal d-inline">{{ $bank->number }}</div>
            </div>
            <div class="my-3">
                <div class="headding d-inline">اسم صاحب الحساب</div>
                <div class="ms-2 normal d-inline">{{ $bank->owner }}</div>
            </div>
            <div class="my-3">
                <div class="headding d-inline">البنك</div>
                <div class="ms-2 normal d-inline">{{ $bank->bank }}</div>
            </div>
        </div>
    @endforeach
    <form action="{{ route('payment') }}" class="container" method="POST" enctype="multipart/form-data">
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
        @csrf
        <div class="form-group">
            <label for="" class="headding mb-2">صورة الاشعار</label>
            <input type="file" class="form-control" name='photo' required>
            <input type="hidden" class="form-control" value="{{ $service->price }}" name='amout'>
            <input type="hidden" class="form-control" value="{{ $service->id }}" name='service'>
            <input type="hidden" class="form-control" value="{{ $year }}" name='year'>
            <input type="hidden" class="form-control" value="{{ $month }}" name='month'>
            <input type="hidden" class="form-control" value="{{ $day }}" name='day'>
            <input type="hidden" class="form-control" value="{{ $perpose_id }}" name='perpose_id'>
        </div>
        <button class="btn mt-3 btn-primary">ارسل</button>
    </form>
@endsection
