<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.rtl.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body>
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="card mb-5">
            <div class="card-body mx-4">
                <div class="container">
                    <div class="d-flex justify-content-between w-100">
                        <p class="my-5 mx-5" style="font-size: 30px">ايصال عملية الحجز</p>
                        <a href="{{route('home')}}" class="d-flex align-items-center text-dark text-decoration-none">
                            <img class="bi me-2" width="40" height="32" src="{{ asset('images/R.png') }}"
                                alt="" width="720" />
                            <span class="fs-4">{{ config('app.name', 'Laravel') }}</span>
                        </a>
                    </div>

                    <div class="row">
                        <ul class="list-unstyled">
                            <li class="text-muted mt-1">
                                <span class="text-black">فاتورة رقم</span> #{{ $book->id }}
                            </li>
                            <li class="text-black mt-1">{{ $book->year . '/' . $book->month . '/' . $book->day }}</li>
                        </ul>
                        <hr />

                        <div class="col-xl-10">
                            <p>اسم طالب الخدمة</p>
                        </div>
                        <div class="col-xl-2">

                            <p class="float-end">
                                @if (!is_null($book->user))
                                    {{ $book->user->name }}
                                @else
                                    لا تتوفر البيانات
                                @endif
                            </p>
                        </div>
                        <hr />
                        <div class="col-xl-10">
                            <p>اسم مقدم الخدمة</p>
                        </div>
                        <div class="col-xl-2">
                            <p class="float-end">
                                @if (!is_null($book->service))
                                    @if (!is_null($book->service->provider))
                                        {{ $book->service->provider->name }}
                                    @else
                                        لا تتوفر البيانات
                                    @endif
                                @else
                                    لا تتوفر البيانات
                                @endif
                            </p>
                        </div>
                        <hr />
                        <div class="col-xl-10">
                            <p>اسم الخدمة</p>
                        </div>
                        <div class="col-xl-2">
                            <p class="float-end">
                                @if (!is_null($book->service))
                                    {{ $book->service->title }}
                                @else
                                    لا تتوفر البيانات
                                @endif
                            </p>
                        </div>
                        <hr />
                        <div class="col-xl-10">
                            <p>تاريخ الحجز</p>
                        </div>
                        <div class="col-xl-2">
                            <p class="float-end"> {{ $book->created_at }}</p>
                        </div>
                        <hr />
                    </div>
                    <div class="row text-black">
                        <div class="col-xl-12">
                            <p class="float-end fw-bold">المبلغ الكلي: ريال يمني @if (!is_null($book->service))
                                    {{ $book->service->price }}
                                @else
                                    لا تتوفر البيانات
                                @endif
                            </p>
                        </div>
                        <hr style="border: 2px solid black" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        window.print();
    </script>
</body>

</html>
