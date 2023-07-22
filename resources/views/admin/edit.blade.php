@extends('admin.layouts.master')

@section('content')

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12  mb-4">

            <div class="mb-4">
                <div class="font-weight-bold">ویژایش برند</div>
            </div>
            <br>
            @include('admin.section.errors')
            <form action="{{route('admin.brands.update',['brand' => $brand->id])}}" method="post">
                @csrf
                @method('put')
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">نام محصول</label>
                        <input class="form-control" id="name" name="name" type="text" value="{{ $brand->name }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="is_active">وضعیت </label>
                        <select class="form-control" id="is_active" name="is_active">
                            <option value="1"   {{ $brand->getRawOriginal('is_active') ? 'selected' : ''}}>فعال</option>
                            <option value="0"  {{ $brand->getRawOriginal('is_active') ? '' : 'selected'}}>غیر فعال</option>
                        </select>
                    </div>

                </div>

                <button type="submit" class="btn btn-outline-primary">ثبت محصول</button>
                <a href="{{route('admin.brands.index')}}" class=" btn btn-outline-primary pr-2">بازگشت</a>
            </form>
        </div>
    </div>
@endsection
