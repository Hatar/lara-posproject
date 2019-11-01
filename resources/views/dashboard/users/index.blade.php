@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.userss') <small>{{ $users->total() }}</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active">@lang('site.userss')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header">

                <form action="{{ route('dashboard.users.index') }}" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="search" class="form-control" value="{{ request()->search  }}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>   @lang('site.search')</button>
                            @if(Auth()->user()->hasPermission('create_users'))
                                <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> @lang('site.add')</a>
                            @else
                                <a href="#" class="btn btn-primary btn-sm disabled">@lang('site.add')</a>
                            @endif
                        </div>
                    </div>
                </form>

            <h3 class="box-title">@lang('site.userss')</h3>
            </div>
            <div class="box-body">
                @if($users->count() >0)
                    <table class="table table-hover">
                        <thead>
                            <th>#</th>
                            <th>@lang('site.first_name')</th>
                            <th>@lang('site.last_name')</th>
                            <th>@lang('site.email')</th>
                            <th>@lang('site.image')</th>
                            <th>@lang('site.action')</th>
                        </thead>
                        <tbody>
                            @foreach($users as $index=>$user)
                               <tr>
                                    <th>{{ $index + 1 }}</th>
                                    <th>{{ $user->first_name }}</th>
                                    <th>{{ $user->last_name }}</th>
                                    <th>{{ $user->email }}</th>
                                    <th><img src="{{ $user->image_path  }}" style="width:80px" class="img-thumbnail" alt=""></th>
                                    <th>
                                        @if(Auth()->user()->hasPermission('update_users'))
                                            <a href="{{ route('dashboard.users.edit',$user->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>  @lang('site.edit')</a>
                                        @else
                                            <button class="btn btn-success btn-sm disabled">@lang('site.edit')</button>
                                        @endif
                                        @if(Auth()->user()->hasPermission('delete_users'))
                                            <form action="{{ route('dashboard.users.destroy',$user->id) }}" method="post" style="display:inline-block">
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

                    {{ $users->appends(request()->query())->links()  }}
                @else
                    <h2>@lang('site.no_data_found')</h2>
                @endif
            </div><!-- end of box body -->
        </div><!-- end of box -->
    </section><!-- end of content -->
</div><!-- end of content wrapper -->


@endsection