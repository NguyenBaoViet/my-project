@extends('layouts/admin')

@section('title')
    <title>Add Role</title>
@endsection

@section('css')
    <link href="{{ asset('adm1/role/create.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials/content-header',['name' => 'Role', 'key' => 'Add'])
        <!-- /.content-header -->

        <!-- Main content -->
        <form action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Tên slider</label>
                                <input type="text" 
                                    class="form-control " 
                                    placeholder="Nhập tên slider"
                                    name = "name"
                                    value = "{{old('name')}}"
                                > 
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea name="display_name"  class="form-control " rows="5"></textarea> 
                            </div>
                            
                        </div>
                        <div class="col-md-12 text-primary">
                            <label>
                                <input type="checkbox" class="checkall">
                                Check all
                            </label>
                        </div>
                        @foreach($permissionParents as $permissionParent)
                            <div class="card border-primary mb-3 col-md-12">
                                <div class="card-header">
                                    <label>
                                        <input type="checkbox" class="checkbox_wrapper" value="{{ $permissionParent->id }}">
                                    </label>
                                    Module {{ $permissionParent->display_name }}
                                </div>
                                <div class="row">
                                    @foreach($permissionParent->permissionChildren as $permissionChildren)
                                        <div class="card-body text-primary col-md-3">
                                            <h5 class="card-title">
                                                <label>
                                                    <input type="checkbox" class="checkbox_children" name="permission_id[]" value="{{ $permissionChildren->id }}">
                                                </label>
                                                {{ $permissionChildren->display_name }}
                                            </h5>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div><!-- /.content -->
        </form>
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js')
    <script src="{{ asset('adm1/role/create.js') }}"></script>
@endsection