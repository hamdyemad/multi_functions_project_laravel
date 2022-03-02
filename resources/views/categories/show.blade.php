@extends('layouts.master')

@section('title')
معلومات عن ({{ $category->name }})
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('title') الأصناف @endslot
        @slot('li1') لوحة التحكم @endslot
        @slot('li2') الأصناف @endslot
        @slot('route1') {{ route('dashboard') }} @endslot
        @slot('route2') {{ route('categories.index') }} @endslot
        @slot('li3') معلومات عن {{ $category->name }} @endslot
    @endcomponent
    <div class="show_category">
        <div class="card">
            <div class="card-header text-center text-md-left flex-column-reverse d-flex flex-md-row justify-content-between">
                <div class="text-left">
                    <h1>معلومات عن ({{ $category->name }})</h1>
                    @if ($category->photo !== null)
                        <img class="mt-2" src="{{ asset($category->photo) }}" alt="">
                    @else
                        <img class="mt-2" src="{{ asset('/images/product_avatar.png') }}" alt="">
                    @endif
                </div>
                <div>
                    <a class="btn btn-info" href="{{ route('categories.index') }}">
                        الرجوع الى الأصناف
                    </a>
                </div>
            </div>
            <div class="card-body category_products">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex flex-column flex-md-row text-center text-md-right justify-content-between">
                            <h2>الأكلات</h2>
                            <div>
                                <a href="{{ route('products.create') }}" class="btn btn-primary mb-2">أنشاء أكلة جديدة</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>أسم الأكلة</th>
                                        <th>الصنف</th>
                                        <th>الوصف</th>
                                        <th>السعر</th>
                                        <th>الخصم</th>
                                        <th>السعر بعد الخصم</th>
                                        <th>مرئى</th>
                                        <th>رقم الظهور</th>
                                        <th>وقت الأنشاء</th>
                                        <th>وقت أخر تعديل</th>
                                        <th>الأعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($category->products as $product)
                                        <tr>
                                            <th scope="row">{{ $product->id }}</th>
                                            <td>
                                                <div>
                                                    <h4 class="mr-2">
                                                        @if (strlen($product->name) > 20)
                                                            {{ substr($product->name, 0, 20) . '...' }}
                                                        @else
                                                            {{ $product->name }}
                                                        @endif
                                                    </h4>
                                                    @if ($product->photos !== null)
                                                        <img class="mt-2"
                                                            src="{{ asset(json_decode($product->photos)[0]) }}" alt="">
                                                    @else
                                                        <img class="mt-2"
                                                            src="{{ asset('/images/product_avatar.png') }}" alt="">
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <h4>{{ $product->category->name }}</h4>
                                                @if ($product->category->photo !== null)
                                                    <img class="mt-2"
                                                        src="{{ asset($product->category->photo) }}" alt="">
                                                @else
                                                    <img class="mt-2"
                                                        src="{{ asset('/images/product_avatar.png') }}" alt="">
                                                @endif
                                            </td>
                                            <td>
                                                @if (strlen($product->description) > 20)
                                                    {{ substr($product->description, 0, 20) . '...' }}
                                                @else
                                                    {{ $product->description }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ $product->price }}
                                            </td>
                                            <td>
                                                {{ $product->discount }}
                                            </td>
                                            <td>
                                                {{ $product->price - $product->discount }}
                                            </td>
                                            <td>
                                                @if ($product->active)
                                                    <div class="badge badge-success w-100 p-2">نعم</div>
                                                @else
                                                    <div class="badge badge-secondary w-100">لا</div>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $product->viewed_number }}
                                            </td>
                                            <td>
                                                {{ $product->created_at->diffForHumans() }}
                                            </td>
                                            <td>
                                                {{ $product->updated_at->diffForHumans() }}
                                            </td>
                                            <td>
                                                <div class="options d-flex">
                                                    <a class="btn btn-success mr-1"
                                                        href="{{ route('products.show', $product) }}">
                                                        <span>اظهار</span>
                                                        <span class="mdi mdi-eye"></span>
                                                    </a>
                                                    <a class="btn btn-info mr-1"
                                                        href="{{ route('products.edit', $product) }}">
                                                        <span>تعديل</span>
                                                        <span class="mdi mdi-circle-edit-outline"></span>
                                                    </a>
                                                    <button class="btn btn-danger" data-toggle="modal"
                                                        data-target="#modal_{{ $product->id }}">
                                                        <span>ازالة</span>
                                                        <span class="mdi mdi-delete-outline"></span>
                                                    </button>
                                                    <!-- Modal -->
                                                    @include('layouts.partials.modal', [
                                                    'id' => $product->id,
                                                    'route' => route('products.destroy', $product->id)
                                                    ])
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- {{ $category->products->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection