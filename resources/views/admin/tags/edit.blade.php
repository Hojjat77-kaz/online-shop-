@extends('admin.layouts.master')

@section('content')

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12  mb-4">

            <div class="mb-4">
                <div class="font-weight-bold">ویژایش تگ</div>
            </div>
            <br>
            @include('admin.section.errors')
            <form action="{{route('admin.tags.update',['tag' => $tag->id])}}" method="post">
                @csrf
                @method('put')
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">نام تگ</label>
                        <input class="form-control" id="name" name="name" type="text" value="{{ $tag->name }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-outline-primary">ثبت تگ</button>
                <a href="{{route('admin.tags.index')}}" class=" btn btn-outline-primary pr-2">بازگشت</a>
            </form>
        </div>
    </div>
@endsection
