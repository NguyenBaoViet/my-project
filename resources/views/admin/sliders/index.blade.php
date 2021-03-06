@extends('layouts/admin')

@section('title')
    <title>Slider</title>
@endsection

@section('css')
    <link href="{{ asset('adm1/slider/index.css')}}" rel="stylesheet">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials/content-header',['name' => 'Slider', 'key' => 'List'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @can('add-slider')
                        <a href="{{ route('sliders.create') }}" class="btn btn-success float-right m-2">Add</a> 
                    @endcan
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên slier</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($sliders as $slider)
                        <tr>
                            <th scope="row">{{$slider->id}}</th>
                            <td>{{$slider->name}}</td>
                            <td>{{$slider->description}}</td>
                            <td>
                                <img src="{{ $slider->iamge_path }}" alt="image" class = "img">
                            </td>
                            <td>
                                @can('edit-slider')
                                    <a href="{{ route('sliders.edit',['id'=>$slider->id]) }}" class="btn btn-default">Edit</a>
                                @endcan
                                @can('delete-slider')
                                    <a href=""
                                        data-url="{{ route('sliders.delete',['id'=>$slider->id]) }}"
                                        class="btn btn-danger action_delete">Delete</a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    {{ $sliders->links() }}
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js')
    <script src="{{ asset('js/sweetalert2@10.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
@endsection