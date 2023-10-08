@extends('layouts.provider')

@section('content')
    <div class="container d-flex flex-row flex-grow-1 flex-wrap justify-content-center align-items-center">
        <div class="col-md-6 col-12 row p-5">
            <p class="lead mb-4">
                حزينون لرؤيتك تفكر في حذف حسابك هل أنت واثق؟
            </p>
            <button class="w-100 btn btn-lg btn-danger bg-danger" type="button" data-bs-toggle="modal" data-bs-target="#delete"
                type="submit">
                حذف
                <svg class="bi" width="24" height="24" role="img" aria-label="Orders" viewBox="0 0 448 512">
                    <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path
                        d="M160 400C160 408.8 152.8 416 144 416C135.2 416 128 408.8 128 400V192C128 183.2 135.2 176 144 176C152.8 176 160 183.2 160 192V400zM240 400C240 408.8 232.8 416 224 416C215.2 416 208 408.8 208 400V192C208 183.2 215.2 176 224 176C232.8 176 240 183.2 240 192V400zM320 400C320 408.8 312.8 416 304 416C295.2 416 288 408.8 288 400V192C288 183.2 295.2 176 304 176C312.8 176 320 183.2 320 192V400zM317.5 24.94L354.2 80H424C437.3 80 448 90.75 448 104C448 117.3 437.3 128 424 128H416V432C416 476.2 380.2 512 336 512H112C67.82 512 32 476.2 32 432V128H24C10.75 128 0 117.3 0 104C0 90.75 10.75 80 24 80H93.82L130.5 24.94C140.9 9.357 158.4 0 177.1 0H270.9C289.6 0 307.1 9.358 317.5 24.94H317.5zM151.5 80H296.5L277.5 51.56C276 49.34 273.5 48 270.9 48H177.1C174.5 48 171.1 49.34 170.5 51.56L151.5 80zM80 432C80 449.7 94.33 464 112 464H336C353.7 464 368 449.7 368 432V128H80V432z" />
                </svg>
            </button>
            <div class="modal modal-sheet bg-secondary py-5" tabindex="-1" role="dialog" id="delete">
                <div class="modal-dialog" role="document">
                    <div class="modal-content rounded-4 shadow">
                        <div class="modal-header border-bottom-0">
                            <h1 class="modal-title fs-5">فكر مجدداً</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body py-0">
                            <p class="lead">هل أنت متأكد من رغبتك بحذف حسابك؟</p>
                        </div>
                        <div class="modal-footer flex-column border-top-0">
                            <a href="{{ route('provider.account.delete.action') }}"
                                class="btn btn-lg btn-danger w-100 mx-0 mb-2">
                                حذف
                            </a>
                            <button type="button" class="btn btn-lg btn-light w-100 mx-0" data-bs-dismiss="modal">
                                تراجع
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <img src="{{ asset('images/undraw_throw_away_re_x60k.svg') }}" alt="" class="w-100" />
        </div>
    </div>
@endsection
