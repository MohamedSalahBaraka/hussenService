@extends('layouts.provider')

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
                                    <th scope="col">صورة الاشعار</th>
                                    <th scope="col">قبول</th>
                                    <th scope="col">رفض</th>
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
                                        @endif
                                        <td><a href="{{ asset('images/' . $book->payment->photo) }}" target="_blank"
                                                rel="noopener noreferrer"><img
                                                    src="{{ asset('images/' . $book->payment->photo) }}"
                                                    class=" img top-0 start-0 " alt="" width="150" height="150"></a>
                                        </td>
                                        <td><a href="{{ route('provider.book.accept', $book->payment->id) }}"
                                                class="btn btn-success">
                                                تأكيد</a>
                                        </td>
                                        <td><a href="{{ route('provider.book.refues', $book->payment->id) }}"
                                                class="btn btn-danger">رفض</a>
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
