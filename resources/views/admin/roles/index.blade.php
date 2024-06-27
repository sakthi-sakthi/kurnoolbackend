@extends('admin.layouts.master')

@section('title')
    {{ __('main.roles') }}
@endsection

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0 text-dark">{{ __('main.roles') }}</h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('main.role') }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                    <form action="{{ route('admin.role.store') }}" method="post" id="form">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <label for="title" id="label">{{ __('main.addrole') }}</label>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">{{ __('main.role') }}</label>
                                                <input type="text" hidden name="type" value="store" id="typedata">
                                                <input type="text" hidden name="id" value="" id="id" hidden>
                                                <input type="text"
                                                    class="form-control form-control-sm @error('title') is-invalid @enderror"
                                                    id="title" name="title" value="{{ old('title') }}">
                                                @error('title') <small class="ml-auto text-danger">{{ __('main.titleError') }}</small> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mt-4">
                                            <a href="javascript:void(0);" class="btn btn-success btn-sm float-right"
                                        id="submitmainmenu">{{ __('main.Save') }}</a>
                                        <a href="{{ route('admin.role.index') }}" class="btn btn-danger btn-sm float-right mr-2">Cancel</a>
                                        </div>
                                    </div>
                                    </div>  
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                    </form>
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        
                        <table id="table1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('main.role') }}</th>
                                    <th>{{ __('main.Creation Date') }}</th>
                                    <th>{{ __('main.Statu') }}</th>
                                    <th>{{ __('main.Action') }}</th>
                                </tr>
                            </thead>
                            <tbody id="maincontent">
                                @foreach ($roles as $role)
                                    <tr class="row1" >
                                        <td>{{ $role->role_name }}</td>
                                        <td>{{ $role->created_at->diffForHumans() }}</td>
                                        <td><input class="switch" type="checkbox" name="my-checkbox"
                                                data-id="{{ $role->id }}" @if ($role->status == 1) checked @endif
                                                data-toggle="toggle" data-size="mini"
                                                data-on="{{ __('main.Published') }}" data-off="{{ __('main.Draft') }}"
                                                data-onstyle="success" data-offstyle="danger"></td>
                                        <td> 
                                            <button
                                              id="editmainmenu"  data-id="{{ $role->id }}" title="{{ __('main.Edit') }}" class="btn btn-primary btn-xs editmainmenu"><i
                                                    class="fas fa-pencil-alt"></i></button>
                                            <a href="javascript::void(0)"
                                            onclick="confirmDelete({{ $role->id }})" title="{{ __('main.Delete') }}"
                                                class="btn btn-danger btn-xs"><i class="far fa-times-circle"></i></a>
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


    <script>
        $('.switch').change(function() {
        id = $(this).attr('data-id');
        status = $(this).prop('checked');
        $.get("{{ secure_url(route('admin.role.statusdata')) }}", {
            id: id,
            status: status
        });
    });

    $('.editmainmenu').click(function() {
    var id = $(this).data('id'); 
    $.get("{{ secure_url(route('admin.role.editrole')) }}", {
        id: id,
    })
    .done(function(response) {
        var title = response.data.role_name;
        $('#label').text('Edit Role'); 
        $('#title').val(title); $('#submitmainmenu').text('Update'); 
        $('#typedata').val('update'); $('#id').val(response.data.id)
    })
    .fail(function(error) {
        console.error(error); 
        
    });
});

function confirmDelete(id) {
    var result = window.confirm("Are you sure you want to delete?");
    if (result) {
        window.location.href = "{{ route('admin.role.delete', ['id' => ':id']) }}".replace(':id', id);
    } else {
        
    }
}

    </script>
@endsection
