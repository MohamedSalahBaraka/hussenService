@extends('layouts.provider')
<?php use Carbon\Carbon;?>
@section('content')
    <div class="container d-flex flex-column flex-grow-1 flex-wrap justify-content-center align-items-center">
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
                                    <th scope="col">اسم الحاجز</th>
                                    <th scope="col">الحالة</th>
                                    <th scope="col">الغاء الحجز</th>
                                    <th scope="col">عدل</th>
                                    <th scope="col">طباعة الفاتورة</th>
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
                                        @if (!is_null($book->user))
                                            <td>{{ $book->user->name }}</td>
                                        @else
                                            <th>
                                                لا تتوفر البيانات
                                            </th>
                                        @endif<td>{{$book->is_deleted == 1 ? 'ملغي': ($book->is_deleted ==0 ?'ساري':'تم تعديل التاريخ')}}</td>
                                        <td>
                                            <a href="{{ route('provider.book.delete', $book->id) }}" class="btn btn-danger">إلغاء
                                                <svg xmlns="http://www.w3.org/2000/svg" class="bi" width="18" height="18" viewBox="0 0 512 512">
                                                    <path
                                                        d="M367.2 412.5L99.5 144.8C77.1 176.1 64 214.5 64 256c0 106 86 192 192 192c41.5 0 79.9-13.1 111.2-35.5zm45.3-45.3C434.9 335.9 448 297.5 448 256c0-106-86-192-192-192c-41.5 0-79.9 13.1-111.2 35.5L412.5 367.2zM512 256c0 141.4-114.6 256-256 256S0 397.4 0 256S114.6 0 256 0S512 114.6 512 256z" />
                                                </svg>
                                            </a>

                                        </td>
                                        <td>
                                            <a href="{{route('provider.updatebook',$book->id)}}" class="btn btn-warning">عدل</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('invoice', $book->id) }}" target="blanck" class="btn btn-secondary">الفاتورة
                                                <svg xmlns="http://www.w3.org/2000/svg" class="bi" width="18" height="18" viewBox="0 0 512 512">
                                                    <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                                    <path
                                                        d="M14 2.2C22.5-1.7 32.5-.3 39.6 5.8L80 40.4 120.4 5.8c9-7.7 22.3-7.7 31.2 0L192 40.4 232.4 5.8c9-7.7 22.2-7.7 31.2 0L304 40.4 344.4 5.8c7.1-6.1 17.1-7.5 25.6-3.6s14 12.4 14 21.8V488c0 9.4-5.5 17.9-14 21.8s-18.5 2.5-25.6-3.6L304 471.6l-40.4 34.6c-9 7.7-22.2 7.7-31.2 0L192 471.6l-40.4 34.6c-9 7.7-22.3 7.7-31.2 0L80 471.6 39.6 506.2c-7.1 6.1-17.1 7.5-25.6 3.6S0 497.4 0 488V24C0 14.6 5.5 6.1 14 2.2zM96 144c-8.8 0-16 7.2-16 16s7.2 16 16 16H288c8.8 0 16-7.2 16-16s-7.2-16-16-16H96zM80 352c0 8.8 7.2 16 16 16H288c8.8 0 16-7.2 16-16s-7.2-16-16-16H96c-8.8 0-16 7.2-16 16zM96 240c-8.8 0-16 7.2-16 16s7.2 16 16 16H288c8.8 0 16-7.2 16-16s-7.2-16-16-16H96z" />
                                                </svg>
                                            </a>
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
