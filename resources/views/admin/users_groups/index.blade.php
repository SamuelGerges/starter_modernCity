@extends('admin/layout')


@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Users Groups Data</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">DataTables</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="width: 70%">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Users Groups</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <a class="btn btn-success btn-sm mb-3" href="{{ route('admin.user_group.edit')}}"><i class="fas fa-plus"></i>  Add New User Group</a>

                                <table id="example2" class="table table-bordered table-hover" >
                                    <thead class="thead-dark" style=" font-size: larger">
                                    <tr>
                                        <th style="width: 4%" class="text-center">#</th>
                                        <th style="width: 60%" class="text-center">User Group Name</th>
                                        <th style="width: 37%" class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tbody>
                                        @foreach($users_groups->all() as $user_group)
                                            <tr>
                                                <td scope="row" class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $user_group->user_group_name }}</td>


                                                <td class="project-actions text-center">
                                                    <a class="btn btn-info btn-sm" href="{{ route('admin.user_group.edit', $user_group->user_group_id) }}">
                                                        <i class="fas fa-pencil-alt">
                                                        </i>
                                                        Edit
                                                    </a>
                                                    <a class="btn btn-danger btn-sm" href="{{ route('admin.user_group.delete', $user_group->user_group_id) }}">
                                                        <i class="fas fa-trash">
                                                        </i>
                                                        Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection