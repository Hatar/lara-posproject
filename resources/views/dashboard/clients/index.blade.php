@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.clients') <small></small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active">@lang('site.clients')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header">

                <form action="{{ route('dashboard.clients.index') }}" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="search" class="form-control" value="{{ request()->search  }}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>@lang('site.search')</button>
                            @if(Auth()->user()->hasPermission('create_clients'))
                                <a href="{{ route('dashboard.clients.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> @lang('site.add')</a>
                            @else
                                <a href="#" class="btn btn-primary btn-sm disabled">@lang('site.add')</a>
                            @endif
                        </div>
                    </div>
                </form>

            <h3 class="box-title">@lang('site.clients')</h3>
            </div>
            <div class="box-body">
                @if($clients->count() >0)
                    <table class="table table-hover">
                        <thead>
                            <th>#</th>
                            <th>@lang('site.name')</th>
                            <th>@lang('site.address')</th>
                            <th>@lang('site.phone')</th>
                            <th>@lang('site.action')</th>
                        </thead>
                        <tbody>
                            @foreach($clients as $index=>$client)
                               <tr>
                                    <th>{{ $index + 1 }}</th>
                                    <th>{{ $client->name }}</th>
                                    <th>{{ $client->address }}</th>
                                    <th>{{ implode($client->phone,'-') }}</th>
                                    <th>
                                        @if(Auth()->user()->hasPermission('update_clients'))
                                            <a href="{{ route('dashboard.clients.edit',$client->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>  @lang('site.edit')</a>
                                        @else
                                            <button class="btn btn-success btn-sm disabled">@lang('site.edit')</button>
                                        @endif
                                        @if(Auth()->user()->hasPermission('delete_clients'))
                                            <form action="{{ route('dashboard.clients.destroy',$client->id) }}" method="post" style="display:inline-block">
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

                    {{ $clients->appends(request()->query())->links()  }}
                @else
                    <h2>@lang('site.no_data_found')</h2>
                @endif
            </div><!-- end of box body -->
        </div><!-- end of box -->
    </section><!-- end of content -->
</div><!-- end of content wrapper -->


@endsection