@extends('layouts.provider')

@section('content')
    <div class="d-flex flex-column">


        <div class="headding color-orange">اضافة خدمة</div>
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
        <form method="POST" action="{{ route('provider.services.create.action') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-floating mb-3">
                <input id="inputFirstName" type="text" placeholder="Enter your first name"
                    class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}"
                    required autocomplete="title" autofocus />
                <label for="inputFirstName" class="headding">اسم الخدمة</label>
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input id="inputFirstName" type="text" placeholder="Enter your first name"
                    class="form-control @error('adress') is-invalid @enderror" name="adress" value="{{ old('adress') }}"
                    required autocomplete="adress" autofocus />
                <label for="inputFirstName" class="headding">عنوان الخدمة</label>
                @error('adress')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input id="inputFirstName" type="number" placeholder="Enter your first name"
                    class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}"
                    required autocomplete="price" autofocus />
                <label for="inputFirstName" class="headding">سعر الخدمة</label>
                @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="" class="headding mb-2">تصنيف</label>
                <ul class="ks-cboxtags">
                    @foreach ($categories as $category)
                        <li><input type="checkbox" name="categories[]" id="checkbox{{ $category->id }}"
                                value="{{ $category->id }}"><label
                                for="checkbox{{ $category->id }}">{{ $category->name }}</label>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="form-floating mb-3">
                <div class="form-group mb-3">
                    <label for="" class="headding mb-2">تفاصيل الخدمة</label>
                    <textarea class="form-control w-100 tinymce @error('details') is-invalid @enderror" name="details"
                        value="{{ old('details') }}" autocomplete="details" autofocus rows="3"></textarea>
                    @error('details')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="inputEmail" class="headding">صورة الخدمة المصغرة</label>
                    <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo"
                        value="{{ old('photo') }}" required autocomplete="photo" autofocus />
                    @error('photo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="inputEmail" class="headding">صور اضافية الخدمة</label>
                    <input type="file" class="form-control @error('files') is-invalid @enderror" name="files[]"
                        value="{{ old('files') }}" autocomplete="files" multiple autofocus />
                    @error('files')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mt-4 mb-0">
                    <div class="d-grid"><button class="btn btn-primary btn-block headding" type="submit">أنشئ
                            الخدمة</button>
                    </div>
                </div>
        </form>
    </div>
@endsection
