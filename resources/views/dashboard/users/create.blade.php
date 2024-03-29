@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">

        <h1>@lang('site.users')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.users.index')}}"><i class="fa fa-users"></i> @lang('site.users')</a></li>
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
                        <form action="{{ route('dashboard.users.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>@lang('site.first_name')</label>
                            <input type="text" name="first_name" class="form-control" value={{ old('first_name') }} >
                        </div>
                        <div class="form-group">
                            <label>@lang('site.last_name')</label>
                            <input type="text" name="last_name" class="form-control" value={{ old('last_name') }} >
                        </div>
                        <div class="form-group">
                            <label>@lang('site.email')</label>
                            <input type="email" name="email" class="form-control" >
                        </div>

                        <div class="from-group">
                            <label>@lang('site.image')</label>
                            <input type="file" name="image" class="form-control image" />
                            <img src="{{ asset('uploads/user_images/default.png')  }}" style="width:100px;margin-top:15px;" class="img-thumbnail image-preview" alt="">
                        </div>
                        <div class="form-group">
                            <label>@lang('site.password')</label>
                            <input type="password" name="password" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label>@lang('site.password_confirmation')</label>
                            <input type="password" name="password_confirmation" class="form-control" >
                        </div>

                        <div class="form-group">
                             <!-- Custom Tabs -->
                                <div class="card">
                                <div class="card-header d-flex p-0">
                                    <h3 class="card-title p-3">@lang('site.permissions')</h3>
                                    @php
                                        $models =['users','categories','products','clients','orders'];
                                        $maps =['create','read','update','delete'];
                                    @endphp
                                    <ul class="nav nav-pills ml-auto p-2">
                                        @foreach($models as $index=>$model)
                                            <li class="nav-item {{ $index == 0 ? 'active'  :''  }} "><a class="nav-link" href="#{{$model}}" data-toggle="tab">@lang('site.'.$model)</a></li>
                                        @endforeach
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        @foreach($models as $index=>$model)
                                            <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="{{ $model  }}">
                                                <div class="form-check">
                                                    @foreach($maps as $index=>$map)
                                                        <input type="checkbox" value="{{ $map . '_' . $model  }}" name="permissions[]" class="form-check-input" id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1">@lang('site.'.$map)</label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div><!-- /.card-body -->
                                </div>
                                <!-- ./card -->
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