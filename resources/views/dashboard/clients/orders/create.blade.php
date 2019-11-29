@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">

        <h1>@lang('site.clients')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.clients.index')}}"><i class="fa fa-users"></i> @lang('site.clients')</a></li>
            <li class="active">@lang('site.add_order')</li>
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
                                                                class="btn btn-success btn-sm add-product-btn">
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
                        <form action="{{ route('dashboard.clients.orders.store',$client->id) }}" method="post">
                            @include('partials._errors')
                            @csrf
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>@lang('site.product')</th>
                                        <th>@lang('site.quantity')</th>
                                        <th>@lang('site.price')</th>
                                    </tr>
                                </thead>
                                <tbody class="order-list">

                                </tbody>
                            </table><!-- end of table -->

                            <h4>@lang('site.total') : <span class="total-price">0</span></h4>
                            <button
                                class="btn btn-primary btn-block disabled"
                                id="add-order-form-btn"
                                >
                                <i class="fa fa-plus"></i> @lang('site.add_order')
                            </button>
                        </form>
                    </div><!-- end of box body -->
                </div><!-- end of box -->
            </div>

            <div class="col-md-6">
                @if( $client->orders->count() >0 )
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title" style="margin-bottom: 10px">
                                @lang('site.previous_orders')
                                <small>{{ $orders->total() }}</small>
                            </h3>
                        </div><!-- end of box header -->

                        <div class="box-body">
                            @foreach($orders as $order)
                                <div class="panel-group">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" href="#{{$order->created_at->format('d-m-Y-s')}}">{{ $order->created_at->toFormattedDateString() }}</a>
                                                </h4>
                                            </div>

                                            <div id="{{ $order->created_at->format('d-m-Y-s') }}" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <ul class="list-group">
                                                        @foreach ($order->products as $product)
                                                            <li class="list-group-item">{{ $product->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div><!-- end of panel body -->
                                            </div><!-- end of panel collapse -->

                                        </div>
                                    </div>
                                </div><!-- end of panel primary -->
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>


        </div><!-- End of row -->
    </section>


@endsection