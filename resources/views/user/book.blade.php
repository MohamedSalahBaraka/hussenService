@extends('layouts.user')
<?php use Carbon\Carbon;?>
@section('content')
    <div class="container d-flex flex-column flex-grow-1 flex-wrap justify-content-center align-items-center">
        <div class="container pt-3">
            <div class="d-flex gap-3">
                <form action="" method="GET" class="form-control d-flex flex-row rounded-pill ps-5">
                    @csrf
                    <input type="text" class="form-control-plaintext" placeholder="ابحث..." name="keyword" />
                    <button type="submit" class="btn">
                        <svg class="bi" width="34" height="24" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 320 512">
                            <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352c79.5 0 144-64.5 144-144s-64.5-144-144-144S64 128.5 64 208s64.5 144 144 144z" />
                        </svg>
                    </button>
                </form>


            </div>
        </div>
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
        <div class="container pt-3">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="table-responsive bg-white" data-mdb-perfect-scrollbar="true"
                        style="position: relative; height: 100% ">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">اسم الخدمة</th>
                                    <th scope="col">غرض الحجز</th>
                                    <th scope="col">تاريخ الحجز</th>
                                    <th scope="col">حجز يوم</th>
                                    <th scope="col">الحالة</th>
                                    <th scope="col">عدل</th>
                                    <th scope="col">طباعة الفاتورة</th>
                                    <th scope="col">الغاء الحجز</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                    <tr>
                                        @if (!is_null($book->service))
                                            <th scope="row" style="color: #666666">
                                                {{ $book->service->title }}
                                            </th>
                                        @else
                                            <th scope="row" style="color: #666666">
                                                لا تتوفر البيانات
                                            </th>
                                        @endif
                                        @if (!is_null($book->perpose))
                                        <td> {{ $book->perpose->name }}</td>
                                        @else
                                        <th>
                                            لا تتوفر البيانات
                                        </th>
                                        @endif
                                        <td> {{ $book->year . '/' . $book->month . '/' . $book->day }}</td>
                                        <td> {{ $book->created_at }}</td>
                                        <td>{{$book->is_deleted == 1 ? 'ملغي': ($book->is_deleted ==0 ?'ساري':'تم تعديل التاريخ')}}</td>
                                        <td>
                                            @if ($book->created_at->addDays(3) > Carbon::today() )
                                            <a href="{{route('user.updatebook',$book->id)}}" class="btn btn-warning">عدل</a>@else
                                            للتعديل تواصل مع مزود الخدمة
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('user.invoice', $book->id) }}" target="blanck"
                                                class="btn btn-secondary">الفاتورة
                                                <svg xmlns="http://www.w3.org/2000/svg" class="bi" width="18"
                                                    height="18" viewBox="0 0 512 512">
                                                    <path
                                                        d="M14 2.2C22.5-1.7 32.5-.3 39.6 5.8L80 40.4 120.4 5.8c9-7.7 22.3-7.7 31.2 0L192 40.4 232.4 5.8c9-7.7 22.2-7.7 31.2 0L304 40.4 344.4 5.8c7.1-6.1 17.1-7.5 25.6-3.6s14 12.4 14 21.8V488c0 9.4-5.5 17.9-14 21.8s-18.5 2.5-25.6-3.6L304 471.6l-40.4 34.6c-9 7.7-22.2 7.7-31.2 0L192 471.6l-40.4 34.6c-9 7.7-22.3 7.7-31.2 0L80 471.6 39.6 506.2c-7.1 6.1-17.1 7.5-25.6 3.6S0 497.4 0 488V24C0 14.6 5.5 6.1 14 2.2zM96 144c-8.8 0-16 7.2-16 16s7.2 16 16 16H288c8.8 0 16-7.2 16-16s-7.2-16-16-16H96zM80 352c0 8.8 7.2 16 16 16H288c8.8 0 16-7.2 16-16s-7.2-16-16-16H96c-8.8 0-16 7.2-16 16zM96 240c-8.8 0-16 7.2-16 16s7.2 16 16 16H288c8.8 0 16-7.2 16-16s-7.2-16-16-16H96z" />
                                                </svg>
                                            </a>
                                        </td>
                                        <td>

                                            @if ($book->created_at->addDays(3) > Carbon::today() )
                                                <a href="{{ route('user.book.delete', $book->id) }}" class="btn btn-danger">إلغاء
                                                <svg xmlns="http://www.w3.org/2000/svg" class="bi" width="18"
                                                    height="18" viewBox="0 0 512 512">
                                                    <path
                                                        d="M367.2 412.5L99.5 144.8C77.1 176.1 64 214.5 64 256c0 106 86 192 192 192c41.5 0 79.9-13.1 111.2-35.5zm45.3-45.3C434.9 335.9 448 297.5 448 256c0-106-86-192-192-192c-41.5 0-79.9 13.1-111.2 35.5L412.5 367.2zM512 256c0 141.4-114.6 256-256 256S0 397.4 0 256S114.6 0 256 0S512 114.6 512 256z" />
                                                </svg>
                                            </a>
                                            @else
                                                للإلغاء تواصل مع مزود الخدمة
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
