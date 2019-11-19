@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">

        <h1>@lang('site.clients')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.clients.index')}}"><i class="fa fa-users"></i> @lang('site.clients')</a></li>
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
                        <form action="{{ route('dashboard.clients.update',$client->id) }}" method="post" >
                        @csrf
                        {{ method_field('put') }}
                        <div class="form-group">
                            <label>@lang('site.name')</label>
                            <input type="text" name="name" class='form-control' value="{{ $client->name }}">
                        </div>

                        @for($i =0 ;$i< 2 ;$i++)
                            <label>@lang('site.phone')</label>
                            <input type="text" name="phone[]" class='form-control' value="{{ $client->phone[$i] ?? '' }}">
                        @endfor

                        <div class="form-group">
                            <label>@lang('site.address')</label>
                            <input type="text" name="address" class='form-control' value="{{ $client->address  }}">
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