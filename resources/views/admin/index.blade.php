@extends('admin.layouts.master')

@section('content')

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12  mb-4">

            <div class="d-flex justify-content-between mb-4">
                <div class="font-weight-bold">لیست برند ها ({{ $brands->total() }})</div>
                <a class="btn btn-sm btn-outline-primary" href="{{route('admin.brands.create')}}">
                    <i class="fa fa-plus"></i>
                    ایجاد برند
                </a>
            </div>
            <div>
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brands as $key => $brand)
                        <tr>
                            <th>
                                {{$brands ->firstItem() + $key}}
                            </th>
                            <th>
                                {{$brand->name}}
                            </th>
                            <th>
                                <span class="{{$brand->getRawOriginal('is_active') ? 'text-success' : 'text-danger' }}">
                                    {{$brand->is_active}}
                                </span>
                            </th>
                            <th>
                                <a href="{{route('admin.brands.show' , ['brand' => $brand->id] )}}" class="btn btn-outline-primary">نمایش</a>
                                <a href="{{route('admin.brands.edit' , ['brand' => $brand->id] )}}" class="btn btn-outline-info">ویژایش</a>
                            </th>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-5">
                {{ $brands->render() }}
            </div>

        </div>

    </div>
@endsection
