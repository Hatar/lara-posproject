@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.products') <small></small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active">@lang('site.products')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header">

                <form action="{{ route('dashboard.products.index') }}" method="get">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="search" placeholder="{{ __('site.search') }}" class="form-control" value="{{ request()->search  }}" />
                            </div>
                        </div><!--End of Search-->

                        <div class="col-md-4">
                            <div class="form-group">
                              <select class="form-control" name="category_id">
                                <option>@lang('site.all_categories')</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>   @lang('site.search')</button>
                            @if(Auth()->user()->hasPermission('create_products'))
                                <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> @lang('site.add')</a>
                            @else
                                <a href="#" class="btn btn-primary btn-sm disabled">@lang('site.add')</a>
                            @endif
                        </div>
                    </div>
                </form>

            <h3 class="box-title">@lang('site.products')</h3>
            </div>
            <div class="box-body">
                @if($products->count() >0)
                    <table class="table table-hover">
                        <thead>
                            <th>#</th>
                            <th>@lang('site.name')</th>
                            <th>@lang('site.description')</th>
                            <th>@lang('site.category')</th>
                            <th>@lang('site.image')</th>
                            <th>@lang('site.purchase_price')</th>
                            <th>@lang('site.sale_price')</th>
                            <th>@lang('site.profit_percent') %</th>
                            <th>@lang('site.stock')</th>
                            <th>@lang('site.action')</th>
                        </thead>
                        <tbody>
                            @foreach($products as $index=>$product)
                               <tr>
                                    <th>{{ $index + 1 }}</th>
                                    <th>{{ $product->name }}</th>
                                    <th>{!! $product->description  !!}</th>
                                    <th>{{ $product->category->name }}</th>
                                    <th><img src="{{ $product->image_path  }}" style="width:80px" class="img-thumbnail" alt=""></th>
                                    <th>{{ $product->purchase_price }}</th>
                                    <th>{{ $product->sale_price }}</th>
                                    <th>{{ $product->profit_percent }} %</th>
                                    <th>{{ $product->stock }}</th>
                                    <th>
                                        @if(Auth()->user()->hasPermission('update_products'))
                                            <a href="{{ route('dashboard.products.edit',$product->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>  @lang('site.edit')</a>
                                        @else
                                            <button class="btn btn-success btn-sm disabled">@lang('site.edit')</button>
                                        @endif
                                        @if(Auth()->user()->hasPermission('delete_products'))
                                            <form action="{{ route('dashboard.products.destroy',$product->id) }}" method="post" style="display:inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                            </form>
                                        @else
                                            <button class="btn btn-danger btn-sm disabled">@lang('site.delete')</button>
                                        @endif
                                    </th>
                               </tr>
                            @endforeach
                        </tbody>
                    </table><!-- End of Table -->

                    {{ $products->appends(request()->query())->links()  }}
                @else
                    <h2>@lang('site.no_data_found')</h2>
                @endif
            </div><!-- end of box body -->
        </div><!-- end of box -->
    </section><!-- end of content -->
</div><!-- end of content wrapper -->


@endsection