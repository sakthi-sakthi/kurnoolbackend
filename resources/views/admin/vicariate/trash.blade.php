@extends('admin.layouts.master')

@section('title')
    {{ __('main.recyclevicariate') }}
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0 text-dark">{{ __('main.recyclevicariate') }}</h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admin.vicariate.index') }}">{{ __('main.vicariates') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('main.recyclevicariate') }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <table id="table1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('main.vicariatename') }}</th>
                                    <th>{{ __('main.patron') }}</th>
                                    <th>{{ __('main.esatablishment_date') }}</th>
                                    <th>{{ __('main.Deletion Date') }}</th>
                                    <th>{{ __('main.Statu') }}</th>
                                    <th>{{ __('main.Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($articles as $article)
                                    <tr>
                                        
                                        <td>{{ $article->name }}</td>
                                        <td>{{ $article->patron }}</td>
                                        <td>{{ $article->establishment_date }}</td>
                                        <td>{{ $article->deleted_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('admin.vicariate.recover', $article->id) }}"
                                                title="{{ __('main.Recover') }}" class="btn btn-warning btn-xs"><i
                                                    class="fas fa-recycle"></i></a>
                                            <form id="delete_{{ $article->id }}"
                                                action="{{ route('admin.vicariate.destroy', $article->id) }}" method="post"
                                                class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <a href="javascript:void(0)" onclick="validate({{ $article->id }})"
                                                    title="{{ __('main.Destroy') }}" class="btn btn-danger btn-xs"><i
                                                        class="far fa-times-circle"></i></a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div><!-- /.content -->
    </div>
@endsection

@section('script')

@endsection
