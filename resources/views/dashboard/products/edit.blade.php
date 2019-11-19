@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">

        <h1>@lang('site.products')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.products.index')}}"><i class="fa fa-users"></i> @lang('site.products')</a></li>
            <li class="active">@lang('site.edit')</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="box-title">
                            <h3>@lang('site.edit')</h3>
                        </div>
                    </div>
                    <div class="box-body">
                        @include('partials._errors')
                        <form action="{{ route('dashboard.products.update',$product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @Method('PUT')
                        <div class="form-group">
                          <select class="form-control" name="category_id">
                            <option>@lang('site.all_categories')</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                          </select>
                        </div>


                        @foreach(config('translatable.locales') as $locale)
                            <div class="form-group">
                                <label>@lang('site.' . $locale . '.name')</label>
                                <input type="text" name="{{$locale}}[name]" class="form-control" placeholder="{{ __('site.' . $locale . '.name') }}" value={{ $product->name }}>
                            </div>

                            <div class="form-group">
                                <label>@lang('site.' .$locale . '.description')</label>
                                <textarea name="{{$locale}}[description]" class="form-control ckeditor" placeholder="{{ __('site.' . $locale . '.description') }}">
                                    {{ $product->description }}
                                </textarea>
                            </div>
                        @endforeach

                        <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input type="file" class="form-control" name="image" />
                        </div>
                        <div class="form-group">
                            <img src="{{ $product->image_path }}" class="img-thumbnail image-preview" style="width:100px" alt="">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.purchase_price')</label>
                            <input type="number" class="form-control" step="0.01"  name="purchase_price" value={{ $product->purchase_price }} placeholder={{ __('site.purchase_price') }}>
                        </div>

                        <div class="form-group">
                            <label>@lang('site.sale_price')</label>
                            <input type="number" class="form-control" step="0.01"  name="sale_price" value={{ $product->sale_price }} placeholder={{ __('site.sale_price') }}>
                        </div>

                        <div class="form-group">
                            <label>@lang('site.stock')</label>
                            <input type="number" class="form-control" name="stock" value={{ $product->stock }} placeholder={{ __('site.stock') }}>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">@lang('site.edit')</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection