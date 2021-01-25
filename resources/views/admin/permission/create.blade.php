@extends('layouts/admin')

@section('title')
    <title>Trang Chủ</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials/content-header',['name' => 'Menu', 'key' => 'Add'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('permissions.store')}}" method="post">
                        @csrf
                            <div class="form-group">
                                <label>Chọn tên module</label>
                                <select class="form-control" name="module_parent">
                                    <option value="">Chọn tên module</option>
                                    @foreach(config('permissions.table_module') as $moduleItem)
                                        <option value="{{ $moduleItem[0] }}">{{ $moduleItem[1] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class = "row">
                                    @foreach(config('permissions.module_children') as $moduleChildren)
                                    <div class="col-md-3">
                                        <label>
                                            <input type="checkbox" value="{{ $moduleChildren[0] }}" name="module_children[]">
                                            {{ $moduleChildren[1] }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection