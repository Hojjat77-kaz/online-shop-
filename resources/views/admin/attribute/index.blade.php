@extends('admin.layouts.master')

@section('content')

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12  mb-4">

            <div class="d-flex justify-content-between mb-4">
                <div class="font-weight-bold">لیست ویژگی ها ({{ $attributes->total() }})</div>
                <a class="btn btn-sm btn-outline-primary" href="{{route('admin.attributes.create')}}">
                    <i class="fa fa-plus"></i>
                    ایجاد لیست ویژگی
                </a>
            </div>
            <div>
                <table class="table table-bordered table-striped text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($attributes as $key => $attribute)
                        <tr>
                            <th>
                                {{$attributes ->firstItem() + $key}}
                            </th>
                            <th>
                                {{$attribute->name}}
                            </th>
                            <th>
                                <a href="{{route('admin.attributes.show' , ['attribute' => $attribute->id] )}}" class="btn btn-outline-primary">نمایش</a>
                                <a href="{{route('admin.attributes.edit' , ['attribute' => $attribute->id] )}}" class="btn btn-outline-info">ویژایش</a>
                            </th>

                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <div class="d-flex justify-content-center mt-5">
                {{ $attributes->render() }}
            </div>
        </div>

        </div>
@endsection
