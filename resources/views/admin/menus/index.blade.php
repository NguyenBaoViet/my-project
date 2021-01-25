@extends('layouts/admin')

@section('title')
    <title>Menu</title>
@endsection

@section('js')
    <script src="{{ asset('js/sweetalert2@10.js') }}"></script>
    <script src="{{ asset('adm1/menu/index.js')}}"></script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials/content-header',['name' => 'Menu', 'key' => 'List'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @can('add-menu')
                        <a href="{{ route('menus.create') }}" class="btn btn-success float-right m-2">Add</a> 
                    @endcan
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên menu</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($menu as $value)
                        <tr>
                            <th scope="row">{{ $value->id }}</th>
                            <td>{{ $value->name }}</td>
                            <td>
                                @can('edit-menu')
                                    <a href="{{ route('menus.edit',['id' => $value->id] )}}" class="btn btn-default">Edit</a>
                                @endcan
                                @can('delete-menu')
                                    <a href="{{ route('menus.delete', ['id' => $value->id] )}}" 
                                        data-url = "{{ route('menus.delete', ['id' => $value->id] )}}"
                                        class="btn btn-danger action_delete">Delete</a>
                                @endcan
                            </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    {{ $menu->links() }}
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection