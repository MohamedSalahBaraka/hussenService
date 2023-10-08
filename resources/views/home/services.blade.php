@extends('layouts.home')

@section('content')
    <div class="container pb-5 pt-3 d-flex justify-content-around align-items-center">
        <div class="input-group w-75">
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
        <button type="button" class="btn" type="button" data-bs-toggle="modal" data-bs-target="#filter">
            <svg class="bi" width="34" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                <path
                    d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM64 256c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H96c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
            </svg>
        </button>
    </div>
    <div class="modal modal-sheet bg-secondary py-5" tabindex="-1" role="dialog" id="filter">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header border-bottom-0">
                    <h1 class="modal-title fs-5">فلتر النتائج</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-0">
                    <form action="" id="filter" method="get">
                        <div class="form-group mb-3">
                            <label for="" class="headding mb-2">التصنيف</label>
                            <ul class="ks-cboxtags">
                                @foreach ($categorys as $category)
                                    <li>
                                        <input type="checkbox" name="categories[]" id="checkbox{{ $category->id }}"
                                            value="{{ $category->id }}" /><label
                                            for="checkbox{{ $category->id }}">{{ $category->name }}</label>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="headding mb-2">السعر</label>
                            <section class="btn-group d-block">
                                <div class="m-2">
                                    <input type="radio" class="btn-check" name="price" id="gfg" value="1" />
                                    <label class="btn btn-outline-primary" for="gfg">
                                        أقل من 100 ريال يمني
                                    </label>
                                </div>
                                <div class="m-2">
                                    <input type="radio" class="btn-check" name="price" id="gfg2" value="2" />
                                    <label class="btn btn-outline-primary" for="gfg2">
                                        من 100 ريال يمني الي 300 ريال يمني
                                    </label>
                                </div>
                                <div class="m-2">
                                    <input type="radio" class="btn-check" name="price" id="gfg3" value="3" />
                                    <label class="btn btn-outline-primary" for="gfg3">
                                        من 300 ريال يمني الي 1000 ريال يمني
                                    </label>
                                </div>
                                <div class="m-2">
                                    <input type="radio" class="btn-check" name="price" id="gfg4" value="4" />
                                    <label class="btn btn-outline-primary" for="gfg4">
                                        أكثر من 1000 ريال يمني
                                    </label>
                                </div>
                            </section>
                        </div>
                        <button type="submit" class="btn btn-lg btn-primary w-100 mx-0 mb-2">
                            فلتر
                        </button>
                        <button type="button" class="btn btn-lg btn-light w-100 mx-0" data-bs-dismiss="modal">
                            Close
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container d-flex flex-row flex-wrap">
        @foreach ($services as $service)
            <div class="col-md-4 col-12 p-2 mt-3">
                <div class="text-bg-primary product me-md-3 pt-2 px-3 rounded text-center" price="{{ $service->price }}ريال يمني">
                    <a class="my-4 py-5 text-bg-primary text-decoration-none" href="{{ route('service', $service->id) }}">
                        <h2 class="h5 pt-5">{{ $service->title }}</h2>
                    </a>
                    <div class="bg-light shadow-sm mx-auto" style="width: 80%; border-radius: 21px 21px 0 0">
                        <img src="{{ asset('images/' . $service->photo) }}" class="w-100" style="height: 200px"
                            alt="" />
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
