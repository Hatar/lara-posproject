@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">

        <h1>@lang('site.products')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.products.index')}}"><i class="fa fa-users"></i> @lang('site.products')</a></li>
            <li class="active">@lang('site.add')</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="box-title">
                            <h3>@lang('site.add')</h3>
                        </div>
                    </div>
                    <div class="box-body">
                        @include('partials._errors')
                        <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>@lang('site.categories')</label>
                                <select class="form-control" name="category_id" >
                                    <option>@lang('site.all_categories')</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @foreach( config('translatable.locales') as $locale)
                                <div class="form-group">
                                    <label>@lang('site.' . $locale .'.name')</label>
                                    <input type="text" name="{{$locale}}[name]" class="form-control" value={{ old($locale.'.name') }} >
                                </div>
                                <div class="form-group">
                                    <label>@lang('site.' .$locale . '.description')</label>
                                    <textarea name="{{ $locale }}[description]" class="form-control ckeditor">
                                        {{ old($locale . '.description') }}
                                    </textarea>
                                </div>
                            @endforeach

                            <div class="form-group">
                                <label>@lang('site.image')</label>
                                <input type="file" name="image" class="form-control image">
                            </div>

                            <div class="form-group">
                                <img src="{{ asset('uploads/product_images/default.png')}}" style="width: 100px" class="img-thumbnail image-preview" alt="" alt="">
                            </div>
                            <div class="form-group">
                                <label>@lang('site.purchase_price')</label>
                                <input type="number" name="purchase_price" step="0.01"  class="form-control" value={{ old('purchase_price') }}  />
                            </div>
                            <div class="form-group">
                                <label>@lang('site.sale_price')</label>
                                <input type="number" name="sale_price" step="0.01"  class="form-control" value={{ old('sale_price') }}  />
                            </div>
                            <div class="form-group">
                                <label>@lang('site.stock')</label>
                                <input type="number" name="stock" class="form-control" value={{ old('stock') }}  />
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">@lang('site.add')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection