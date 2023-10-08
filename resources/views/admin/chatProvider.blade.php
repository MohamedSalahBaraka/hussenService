@extends('layouts.admin')

@section('content')
    <section style="background-color: #eee;">
        <div class="container py-5">

            <div class="row d-flex justify-content-center">
                <div class="col-md-10">

                    <div class="card " id="chat2">
                        <div class="card-header d-flex justify-content-between align-items-center p-3">
                            <h5 class="mb-0">محادثة مزود خدمة</h5>
                        </div>
                        <div class="card-body overflow-scroll" data-mdb-perfect-scrollbar="true"
                            style="position: relative; height: 400px">
                            @foreach ($messages as $message)
                                @if ($message->direction == 1)
                                    <div class="d-flex flex-row justify-content-start">
                                        <div>
                                            <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">
                                                {{ $message->content }}
                                            </p>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex flex-row justify-content-end mb-4 pt-1">
                                        <div>
                                            <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">
                                                {{ $message->content }}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                        <div class="card-footer">
                            <form action="{{ route('admin.send.provider.message') }} "
                                class=" text-muted d-flex justify-content-start align-items-center p-3" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <input type="text" name="content" class="form-control form-control-lg"
                                    id="exampleFormControlInput1" placeholder="ارسل رسالة">
                                <button class="ms-1 btn text-muted" href="#!"><svg xmlns="http://www.w3.org/2000/svg"
                                        class="bi" width="24" hight="24" viewBox="0 0 512 512">
                                        <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                        <path
                                            d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480V396.4c0-4 1.5-7.8 4.2-10.7L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z" />
                                    </svg></button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection
