@extends('layouts.user')

@section('content')
   <div class="container">
    <form action="{{ route('user.updatebook.action') }}" method="POST">
        @csrf
        <div id="replace">
            <input type="hidden" name="year" value="{{ $books[0]->year }}">
            <input type="hidden" name="month" value="{{ $books[0]->month }}">
            <div class="row justify-content-center align-items-center">
                <div class="col-2 row justify-content-center align-items-center">
                    <div class="btn front" onclick="front()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="bi" width="24px" hight="24px"
                            viewBox="0 0 384 512">
                            <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M3.4 81.7c-7.9 15.8-1.5 35 14.3 42.9L280.5 256 17.7 387.4C1.9 395.3-4.5 414.5 3.4 430.3s27.1 22.2 42.9 14.3l320-160c10.8-5.4 17.7-16.5 17.7-28.6s-6.8-23.2-17.7-28.6l-320-160c-15.8-7.9-35-1.5-42.9 14.3z" />
                        </svg>
                    </div>
                </div>
                <div class="col-8 row justify-content-center align-items-center">
                    <p class="lead" style="width: fit-content;">{{ $books[0]->year }} /{{ $books[0]->month }}</p>
                </div>
                <div class="col-2 row justify-content-center align-items-center">
                    <div class="btn back" onclick="back()"><svg xmlns="http://www.w3.org/2000/svg" class="bi"
                            width="24px" hight="24px" viewBox="0 0 384 512">
                            <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M380.6 81.7c7.9 15.8 1.5 35-14.3 42.9L103.6 256 366.3 387.4c15.8 7.9 22.2 27.1 14.3 42.9s-27.1 22.2-42.9 14.3l-320-160C6.8 279.2 0 268.1 0 256s6.8-23.2 17.7-28.6l320-160c15.8-7.9 35-1.5 42.9 14.3z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column justify-content-center mb-3 align-items-center">
                <div class="col-md-6 col-12 table-responsive">
                    <table class="calender-table table">
                        <thead>
                            <th scope="col" class="text-center">الأحد</th>
                            <th scope="col" class="text-center">الإثنين</th>
                            <th scope="col" class="text-center">الثلاثاء</th>
                            <th scope="col" class="text-center">الاربعاء</th>
                            <th scope="col" class="text-center">الخميس</th>
                            <th scope="col" class="text-center">الجمعة</th>
                            <th scope="col" class="text-center">السبت</th>
                        </thead>
                        <tbody id="calender">
                            <?php $day=1 ?>
                            @for ($i = 0; $i < 6; $i++) <tr>
                                @for ($d = 0; $d < 7; $d++) @if ($i==0 && $d < $books[0]->startDay)
                                    <td></td>
                                    @else
                                    @if ($day <= count($books[0]->days))
                                        <td scope="col" class="text-center"><input type="radio" class="btn-check" {{
                                                $books[0]->days[$day]->isBooked() ? 'disabled' : '' }}
                                            value="{{ $books[0]->days[$day]->day }}" name="day"
                                            id="gfg{{ $books[0]->days[$day]->day }}" />
                                            <label
                                                class="btn {{ $books[0]->days[$day]->isBooked() ? 'btn-outline-danger' : 'btn-outline-primary' }}"
                                                for="gfg{{ $books[0]->days[$day]->day }}">
                                                {{ $books[0]->days[$day]->day }}
                                            </label>
                                        </td>
                                        <?php $day++?>
                                        @endif
                                        @endif


                                        @endfor
                                        </tr>
                                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="d-flex flex-column justify-content-center mb-3 align-items-center">
            <input type="hidden" name="book_id" value="{{$book->id}}">
            <button class="col-md-6 col-8 btn btn-lg btn-success" type="submit">عدل الحجز
                <svg xmlns="http://www.w3.org/2000/svg" class="bi" width="18px" hight="18px" viewBox="0 0 448 512">
                    <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path
                        d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zM329 305c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-95 95-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L329 305z" />
                </svg>
            </button>
        </div>
    </form>
</div>
@endsection
@section('js')
<script>
    const month = [
    @foreach ($books as $book )
       `
    <input type="hidden" name="year" value="{{ $book->year }}">
    <input type="hidden" name="month" value="{{ $book->month }}">
    <div class="row justify-content-center align-items-center">
        <div class="col-2 row justify-content-center align-items-center">
            <div class="btn front" onclick="front()">
                <svg xmlns="http://www.w3.org/2000/svg" class="bi" width="24px" hight="24px" viewBox="0 0 384 512">
                    <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path
                        d="M3.4 81.7c-7.9 15.8-1.5 35 14.3 42.9L280.5 256 17.7 387.4C1.9 395.3-4.5 414.5 3.4 430.3s27.1 22.2 42.9 14.3l320-160c10.8-5.4 17.7-16.5 17.7-28.6s-6.8-23.2-17.7-28.6l-320-160c-15.8-7.9-35-1.5-42.9 14.3z" />
                </svg>
            </div>
        </div>
        <div class="col-8 row justify-content-center align-items-center">
            <p class="lead" style="width: fit-content;">{{ $book->year }} /{{ $book->month }}</p>
        </div>
        <div class="col-2 row justify-content-center align-items-center">
            <div class="btn back" onclick="back()"><svg xmlns="http://www.w3.org/2000/svg" class="bi" width="24px" hight="24px"
                    viewBox="0 0 384 512">
                    <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path
                        d="M380.6 81.7c7.9 15.8 1.5 35-14.3 42.9L103.6 256 366.3 387.4c15.8 7.9 22.2 27.1 14.3 42.9s-27.1 22.2-42.9 14.3l-320-160C6.8 279.2 0 268.1 0 256s6.8-23.2 17.7-28.6l320-160c15.8-7.9 35-1.5 42.9 14.3z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="d-flex flex-column justify-content-center mb-3 align-items-center">
        <div class="col-md-6 col-12 table-responsive">
            <table class="calender-table table">
                <thead>
                    <th scope="col" class="text-center">الأحد</th>
                    <th scope="col" class="text-center">الإثنين</th>
                    <th scope="col" class="text-center">الثلاثاء</th>
                    <th scope="col" class="text-center">الاربعاء</th>
                    <th scope="col" class="text-center">الخميس</th>
                    <th scope="col" class="text-center">الجمعة</th>
                    <th scope="col" class="text-center">السبت</th>
                </thead>
                <tbody id="calender">
       <?php $day=1 ?>
        @for ($i = 0; $i < 6; $i++)
        <tr>
            @for ($d = 0; $d < 7; $d++) @if ($i==0 && $d < $book->startDay)
                <td></td>
                @else
                @if ($day <= count($book->days))
                    <td scope="col" class="text-center"><input type="radio" class="btn-check" {{
                            $book->days[$day]->isBooked() ? 'disabled' : '' }}
                        value="{{ $book->days[$day]->day }}" name="day"
                        id="gfg{{ $book->days[$day]->day }}" />
                        <label
                            class="btn {{ $book->days[$day]->isBooked() ? 'btn-outline-danger' : 'btn-outline-primary' }}"
                            for="gfg{{ $book->days[$day]->day }}">
                            {{ $book->days[$day]->day }}
                        </label>
                    </td>
                    <?php $day++?>
                    @endif
                    @endif


            @endfor
        </tr>
        @endfor
        </tbody>
        </table>
        </div>
        </div>` ,
    @endforeach
]
let selectedMonth = 0;
let front = ()=>{
console.log(selectedMonth);
if(selectedMonth != 6 ){
selectedMonth++;
$('#replace').html(month[selectedMonth]);
}
}
let back = ()=>{
console.log(selectedMonth);
if(selectedMonth != 0 ){
selectedMonth--;
$('#replace').html(month[selectedMonth]);
}
}
</script>
@endsection
