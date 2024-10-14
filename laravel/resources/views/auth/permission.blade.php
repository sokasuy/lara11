@php
    use App\Models\Permission;
@endphp
@extends('layouts.auth')
@section('title')
    <title>LARAVEL | Data Permission</title>
@endsection

@section('headertitle')
    <h1>DATA PERMISSION</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Home</a></li>
    <li class="breadcrumb-item">permission</li>
    <li class="breadcrumb-item active">Users</li>
@endsection

{{-- @section('cssatas')
    <style>
        img .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
        }
    </style>
@endsection --}}

@section('content')
    <!-- /.row -->
    <div class="row">
        <!-- /.col -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Permission</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="showinfo"></div>
                    @if (session('message-success'))
                        <div class="alert alert-success">
                            {{ session('message-success') }}
                        </div>
                    @endif
                    @if (session('message-failed'))
                        <div class="alert alert-danger">
                            {{ session('message-failed') }}
                        </div>
                    @endif
                    @if (Permission::where('role', Auth::user()->role)->where('view', 'permission')->where('create', true)->exists())
                        <div class="row mb-0">
                            <div class="col-md-3" style="margin-bottom: 23px;">
                                {{-- <button type="submit" class="btn btn-primary" id="btn_adduser">Add User</button> --}}
                                <a class="btn btn-primary btn-sm" href="{{ route('auth.addpermissions') }}"
                                    id="btn_adduser">
                                    <i class="fas fa-plus">&nbsp Add Permission</i></a>
                            </div>
                        </div>
                    @endif
                    <div class="row mb-0">
                        <div class="col-md-3" style="margin-bottom: 23px;">
                            {{-- <button type="submit" class="btn btn-primary" id="btn_adduser">Add User</button> --}}
                            {{-- <a class="btn btn-primary btn-sm" href=" route('auth.addpermission') " id="btn_adduser">
                                <i class="fas fa-plus">&nbsp Add permission</i></a> --}}
                        </div>
                    </div>
                    <table id="tbl_permission" class="table table-bordered table-striped">
                        <thead>
                            <tr style="text-align: center;">
                                <th>ID</th>
                                <th>ROLE</th>
                                <th>MENU GROUP</th>
                                <th>VIEW</th>
                                <th>CREATE</th>
                                <th>READ</th>
                                <th>UPDATE</th>
                                <th>DELETE</th>
                                <th>CREATED AT</th>
                                <th>UPDATED AT</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <!-- Modal -->
                        <div class="modal fade" id="modal_container" tabindex="-1" role="dialog"
                            aria-labelledby="modal_containerlabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                <div class="modal-content" id="modal_content">
                                    <div class="overlay">
                                        <i class="fas fa-2x fa-sync fa-spin"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>ROLE</th>
                                <th>MENU GROUP</th>
                                <th>VIEW</th>
                                <th>CREATE</th>
                                <th>READ</th>
                                <th>UPDATE</th>
                                <th>DELETE</th>
                                <th>CREATED AT</th>
                                <th>UPDATED AT</th>
                                <th>ACTION</th>
                            </tr>
                        </tfoot> --}}
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection

@section('jsbawah')
    <script defer>
        // var userRole = @json($userRole);
        var hasUpdatePermission = @json($hasUpdatePermission);
        document.addEventListener('DOMContentLoaded', (event) => {
            var tblUser = $("#tbl_permission").DataTable({
                "dom": 'Bfrtip',
                "paging": true,
                "pageLength": 100,
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "deferRender": true,
                "processing": true,
                "ajax": {
                    "url": '{{ route('auth.getpermission') }}',
                    "type": "POST",
                    "data": {
                        _token: "{{ csrf_token() }}"
                    },
                    "xhrFields": {
                        withCredentials: true
                    }
                },
                "columns": [{
                    "data": "id"
                }, {
                    "data": "role"
                }, {
                    "data": "menu_group"
                }, {
                    "data": "view"
                }, {
                    "data": "create",
                    render: function(data, type, row) {
                        if (row.create === true) {
                            return '<i style="color: green" class="fas fa-check"></i>';
                        } else {
                            return '<i style="color: red" class="fas fa-times"></i>';
                        }
                    }
                }, {
                    "data": "read",
                    render: function(data, type, row) {
                        if (row.read === true) {
                            return '<i style="color: green" class="fas fa-check"></i>';
                        } else {
                            return '<i style="color: red" class="fas fa-times"></i>';
                        }
                    }
                }, {
                    "data": "update",
                    render: function(data, type, row) {
                        if (row.update === true) {
                            return '<i style="color: green" class="fas fa-check"></i>';
                        } else {
                            return '<i style="color: red" class="fas fa-times"></i>';
                        }
                    }
                }, {
                    "data": "delete",
                    render: function(data, type, row) {
                        if (row.delete === true) {
                            return '<i style="color: green" class="fas fa-check"></i>';
                        } else {
                            return '<i style="color: red" class="fas fa-times"></i>';
                        }
                    }
                }, {
                    "data": "created_at",
                    render: $.fn.dataTable.render.moment('YYYY-MM-DDTHH:mm:ss.SSSSZ',
                        'D MMM YYYY HH:mm:ss')
                }, {
                    "data": "updated_at",
                    render: $.fn.dataTable.render.moment('YYYY-MM-DDTHH:mm:ss.SSSSZ',
                        'D MMM YYYY HH:mm:ss')
                }, {
                    "data": null,
                    // render: function(data, type, row) {
                    //     return '<a class="btn_changepermission btn btn-primary btn-sm" data-toggle="modal" href="#editusermodal"><i class="fas fa-user-edit">&nbsp Edit</i></a> <a class="btn btn-danger btn-sm" data-toggle="modal" href="#deleteusermodal"><i class="fas fa-trash-alt">&nbsp Delete</i></a>';
                    // }
                    render: function(data, type, row) {
                        if (hasUpdatePermission) {
                            return '<a class="btn_changepermission btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_container"><i class="fas fa-user-edit">&nbsp Edit</i></a>';
                        } else {
                            return '';
                        }
                    }
                }],
                select: true
                // fnInitComplete: function(oSettings, json) {
                //     //CHANGE PASSWORD BUTTON
                //     const btnChangePassword = document.querySelector('.btn_changepermission');
                //     btnChangePassword.addEventListener('click', changePassword);
                // },
            })
        });

        $('#tbl_permission').on('click', '.btn_changepermission', function() {
            let row = $(this).closest('tr');

            let data = $("#tbl_permission").DataTable().row(row).data().id;
            changePermission(data);
        });

        function changePermission(id) {
            $.ajax({
                type: 'POST',
                url: "{{ route('permission.changepermission') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    'id': id
                },
                success: function(data) {
                    $("#modal_content").html(data.msg);
                },
                error: function(data, textStatus, errorThrown) {
                    console.log(data);
                }
            });
        };

        $('#tbl_permission').on('click', '.btn_delete', function() {
            let row = $(this).closest('tr');

            let data = $("#tbl_permission").DataTable().row(row).data().email;
            alert(data);
        });

        function actionUpdatePermission(id) {
            let role = $("#role").val();
            let view = $("#view").val();
            let create = $("#create").prop('checked') ? 1 : 0;
            let read = $("#read").prop('checked') ? 1 : 0;
            let update = $("#update").prop('checked') ? 1 : 0;
            let checkboxdelete = $("#delete").prop('checked') ? 1 : 0;

            $.ajax({
                type: 'POST',
                url: "{{ route('permission.actionChangePermission') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    role: role,
                    view: view,
                    create: create,
                    read: read,
                    update: update,
                    delete: checkboxdelete
                },
                success: function(data) {
                    if (data.status == 'ok') {
                        $('#showinfo').html(data.msg);
                    }
                    location.reload();
                },
                error: function(data, textStatus, errorThrown) {
                    console.log(data);
                }
            });
        }
    </script>
@endsection
