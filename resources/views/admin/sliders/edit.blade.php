@extends('layouts/admin')

@section('title')
    <title>Edit Slider</title>
@endsection

@section('css')
    <link href="{{ asset('adm1/slider/edit.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials/content-header',['name' => 'Slider', 'key' => 'Edit'])
        <!-- /.content-header -->

        <!-- Main content -->
        <form action="{{route('sliders.update',['id'=>$slider->id])}}" method="post" enctype="multipart/form-data">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tên slider</label>
                                <input type="text" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    placeholder="Nhập tên slider"
                                    name = "name"
                                    value = "{{ $slider->name }}"
                                > 
                                @error('name')
                                    <div class="alert alert-danger error">{{ $message }}</div>
                                @enderror                    
                            </div>
                            <div class="form-group">
                            <label>Ảnh</label>
                                <input type="file" class="form-control-file @error('image_path') is-invalid @enderror" name ="image_path"> 
                                <div class="col-md-6">
                                    <img src="{{$slider->iamge_path}}" alt="selected_img" class="slider_edit_img">
                                </div>
                                @error('image_path')
                                    <div class="alert alert-danger error">{{ $message }}</div>
                                @enderror                     
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="10">{{ $slider->description }}</textarea> 
                                @error('description')
                                    <div class="alert alert-danger error">{{ $message }}</div>
                                @enderror 
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div><!-- /.content -->
        </form>
    </div>
    <!-- /.content-wrapper -->
@endsection
