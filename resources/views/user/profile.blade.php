@extends('layouts.user')

@section('content')
    <div class="container d-flex flex-column">
        <div class="container d-flex flex-row flex-wrap flex-grow-1 justify-content-center align-items-center">
            <div class="col-md-6 col-12 row p-5">
                <div class="col-xl-10">
                    <p>الاسم</p>
                </div>
                <div class="col-xl-2">
                    <p class="float-end">{{ $user->name }}</p>
                </div>
                <hr />
                <div class="col-xl-10">
                    <p>البريد الالكتروني</p>
                </div>
                <div class="col-xl-2">
                    <p class="float-end">{{ $user->email }}</p>
                </div>
                <hr />
                <div class="col-xl-10">
                    <p>رقم الهاتف</p>
                </div>
                <div class="col-xl-2">
                    <p class="float-end">{{ $user->phone }}</p>
                </div>
                <hr />
            </div>
            <div class="col-md-6 col-12">
                <img src="{{ asset('images/undraw_profile_re_4a55.svg') }}" alt="" class="w-100" />
            </div>
        </div>
    </div>
@endsection
