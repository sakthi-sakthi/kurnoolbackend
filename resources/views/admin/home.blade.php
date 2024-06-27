@extends('admin.layouts.master') @section('title') {{ __('main.Dashboard') }} @endsection @section('content')

<div class="content-wrapper">
    <div class="container">
        <div class="row mt-3">
            <!-- User Card -->
            <!-- User Count Card -->
            <div class="col-md-3">
                <a href="{{ route('admin.vicariate.index') }}" class="text-decoration-none">
                <div class="card bg-primary-gradient text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-building nav-icon fa-3x"></i>
                            </div>
                            <div class="text-right">
                                <h5 class="card-title">Vicariates</h5>
                                <br>
                                {{-- <p class="card-text">Total Vicariates:</p> --}}
                                <strong>{{ $vicariate }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            </div>
            <!-- Product Card -->
            <div class="col-md-3">
                <a href="{{ route('admin.parish.index') }}" class="text-decoration-none">
                <div class="card bg-info-gradient text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-church nav-icon fa-3x"></i>
                            </div>
                            <div class="text-right">
                                <h5 class="card-title">Parishes</h5>
                                {{-- <p class="card-text">Total parishes:</p> --}}
                                <br>
                                <strong>{{ $parish }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            </div>

            <!-- Additional Card (Replace with your data) -->
            <div class="col-md-3">
                <a href="{{ route('admin.priest.index') }}" class="text-decoration-none">
                <div class="card bg-warning-gradient text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                {{-- <i class="fas fa-cross nav-icon fa-3x"></i> --}}
                                <img src={{asset('admin/img/3188383.png')}} width="30%" alt="">
                                
                            </div>
                            <div class="text-right">
                                <h5 class="card-title">Priests</h5>
                                <br>
                                {{-- <p class="card-text">Diocesan Priest:</p> --}}
                                <strong>{{ $priest }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            </div>

            <!-- Additional Card (Replace with your data) -->
            <div class="col-md-3">
                <a href="{{ route('admin.contact.index') }}" class="text-decoration-none">
                <div class="card bg-danger-gradient text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                {{-- <i class="fas fa-chart-bar fa-3x"></i> --}}
                                <i class="fas fa-address-book fa-3x"></i>

                            </div>
                            <div class="text-right">
                                <h5 class="card-title">Contact Request</h5>
                                {{-- <p class="card-text">Total count:</p> --}}
                                <br>
                                <strong>{{ $contact }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            </div>
        </div>
        <br>
        <br>
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('admin.user.create') }}" class="btn btn-success btn-sm">{{ __('main.Add New') }}</a>
                        <a href="{{ route('admin.user.trash') }}" class="btn btn-warning btn-sm float-right"><i class="fas fa-trash-alt"></i>{{ __('main.Recycle') }}</a>
                    </div>
                    <div class="card-body">
                        <table id="table1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('main.Name') }}</th>
                                    <th>{{ __('main.E-mail') }}</th>
                                    <th>{{ __('main.Role') }}</th>
                                    <th>{{ __('main.Statu') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <a href="{{ route('admin.user.edit',$user->id) }}" title="{{ __('main.Edit') }}" class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="{{ route('admin.user.delete',$user->id) }}" onclick="validate({{$user->id}})" title="{{ __('main.Delete') }}" class="btn btn-danger btn-xs"><i class="far fa-times-circle"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection @section('script') @endsection
