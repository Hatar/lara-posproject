@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">

        <h1>@lang('site.categories')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.categories.index')}}"><i class="fa fa-users"></i> @lang('site.categories')</a></li>
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
                        <form action="{{ route('dashboard.categories.store') }}" method="post" >
                        @csrf

                        @foreach( config('translatable.locales') as $locale)
                            <div class="form-group">
                                <label>@lang('site.' . $locale .'.name')</label>
                                <input type="text" name="{{$locale}}[name]" class="form-control" value={{ old($locale.'.name') }} >
                            </div>
                        @endforeach

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