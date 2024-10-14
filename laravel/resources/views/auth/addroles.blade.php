@extends('layouts.auth')
@section('title')
    <title>LARAVEL | Add Roles</title>
@endsection


@section('headertitle')
    <span>
        <h1>Roles
        </h1>
        Add User. <a href="{{ route('auth.roles') }}"><i class="fas fa-angle-double-left"></i>&nbsp;Back to all
            <span>Roles</span></a>
    </span>
@endsection

{{-- @section('navlist')
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('auth.users') }}" class="nav-link active">
                <i class="far fa-circle nav-icon"></i>
                <p>Users</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Roles</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Permission</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('auth.customers') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Customers</p>
            </a>
        </li>
    </ul>
@endsection --}}

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Home</a></li>
    <li class="breadcrumb-item">Authentication</li>
    <li class="breadcrumb-item"><a href="{{ route('auth.roles') }}">Roles</a></li>
    <li class="breadcrumb-item active">Add Roles</li>
@endsection

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-7">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Register New User</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('auth.actionregisterroles') }}">
                    @csrf
                    <div class="card-body">
                        {{-- NAMA ROLES --}}
                        <div class="form-group">
                            <label for="name">Masukan Nama Role</label>
                            <div class="input-group mb-3">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="role_name"
                                    value="{{ old('name') }}" placeholder="Nama Role" required autocomplete="name"
                                    autofocus>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="form-group">
                            <label for="name">Akses Menu</label>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select class="select2" multiple="multiple" data-placeholder="Pilih Menu"
                                        style="width: 100%;" name="data_menu[]">
                                        @foreach ($datamenu as $d)
                                            <option value="{{ $d->nama_menu }}">{{ $d->nama_menu }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div> --}}

                        {{-- HAK AKSES --}}
                        {{-- <div class="form-group">
                            <label for="role">Right of Access</label>
                            <div class="input-group mb-3">

                            </div>
                        </div> --}}
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-primary" data-value="save_and_back"><i
                                    class="fas fa-save"></i>&nbsp;Save and
                                back</button>
                            <button type="submit" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"></button>
                        </div>
                        <button type="submit" class="btn btn-default float-right"><i
                                class="fas fa-ban"></i>&nbsp;Cancel</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@section('jsbawah')
    <script defer>
        document.addEventListener('DOMContentLoaded', (event) => {
            //Initialize Select2 Elements
            $('.select2').select2();

            //Initialize Select2 Elements
            $('.select2bs4placeholderrole').select2({
                theme: 'bootstrap4',
                placeholder: "User Role",
                allowClear: false
            });
        });
    </script>
@endsection
