@extends('admin.layouts.master')

@section('content')

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12  mb-4">

            <div class="mb-4">
                <div class="font-weight-bold">ویژگی</div>
            </div>
            <br>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="name">نام ویژگی</label>
                    <input class="form-control" id="name" value="{{ $attribute->name }}" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="time">تاریخ ایجاد</label>
                    <input class="form-control" id="time" value="{{  verta($attribute->created_at)->formatWord('l dS F')}}" disabled>
                </div>
            </div>
            <a href="{{route('admin.attributes.index')}}" class=" btn btn-outline-primary pr-2">بازگشت</a>
        </div>
    </div>
@endsection
