@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">

        <h1>@lang('site.edit_order')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.clients.index')}}"><i class="fa fa-users"></i> @lang('site.clients')</a></li>
            <li class="active">@lang('site.edit_order')</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="box-title"><h3>@lang('site.categories')</h3></div>
                    </div>
                    <div class="box-body">
                        @foreach($categories as $category)
                            <div class="panel-group">
                                <div class="panel-info">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <a href="#{{ str_replace(' ','-',$category->name) }}" data-toggle="collapse">{{$category->name}}</a>
                                        </div>
                                    </div>
                                </div>
                                <div id="{{ str_replace(' ', '-', $category->name) }}" class="panel-collaps collapse">
                                    <div class="panel-body">
                                        @if($category->products->count()>0)
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>@lang('site.name')</th>
                                                        <th>@lang('site.stock')</th>
                                                        <th>@lang('site.price')</th>
                                                        <th>@lang('site.add')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($category->products as $product)
                                                        <tr>
                                                            <td>{{ $product->name }}</td>
                                                            <td>{{$product->stock}}</td>
                                                            <td>{{ number_format($product->sale_price,2)}}</td>
                                                            <td>
                                                            <a  href=""
                                                                id="product-{{$product->id}}"
                                                                data-name="{{$product->name}}"
                                                                data-id="{{$product->id}}"
                                                                data-price="{{ $product->sale_price }}"
                                                                class="btn {{ in_array( $product->id,$order->products->pluck('id')->toArray()) ? 'btn-default disabled ' : 'btn-success add-product-btn' }} btn-sm">
                                                                <i class="fa fa-plus"></i></a></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table><!-- end of table -->
                                        @else
                                            <h5>@lang('site.no_records')</h5>
                                        @endif
                                    </div><!-- end of panel body -->
                                </div><!-- end of panel collapse -->
                            </div><!-- end of panel group -->
                        @endforeach
                    </div><!-- end of box body -->
                </div><!-- End box-primary -->
            </div><!-- End col-md-6 -->

            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="box-title"><h3>@lang('site.orders')</h3></div>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('dashboard.clients.orders.update',['order'=>$order->id,'client'=>$client->id]) }}" method="post">
                            @include('partials._errors')
                            @csrf
                            @Method('put')
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>@lang('site.product')</th>
                                        <th>@lang('site.quantity')</th>
                                        <th>@lang('site.price')</th>
                                    </tr>
                                </thead>
                                <tbody class="order-list">
                                    @foreach($order->products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>
                                            <input
                                            type="number"
                                            name="products[{{ $product->id }}][quantity]"
                                            data-price="{{ number_format($product->sale_price,2) }}}"
                                            class="form-control input-sm product-quantity"
                                            min="1"
                                            value="{{ $product->pivot->quantity }}"
                                            />
                                        </td>
                                        <td class="product-price">{{ number_format($product->sale_price * $product->pivot->quantity,2) }}</td>
                                        <td><button data-id="{{ $product->id }}" class="btn btn-danger btn-sm remove-product-btn"><span class="fa fa-trash"></span></button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table><!-- end of table -->

                            <h4>@lang('site.total') : <span class="total-price">{{ number_format($order->total_price,2) }}</span></h4>
                            <button
                                class="btn btn-primary btn-block"
                                id="add-order-form-btn"
                                >
                                <i class="fa fa-plus"></i> @lang('site.edit_order')
                            </button>
                        </form>
                    </div><!-- end of box body -->
                </div><!-- end of box -->
            </div>

        </div><!-- End of row -->
    </section>


@endsection