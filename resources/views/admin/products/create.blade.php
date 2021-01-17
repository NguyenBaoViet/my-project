@extends('layouts/admin')

@section('title')
    <title>Add Product</title>
@endsection
     
@section('css')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/productcreate.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials/content-header',['name' => 'Product', 'key' => 'Add'])
        <!-- /.content-header -->
        <!-- Main content -->
        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                    @csrf
                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                placeholder="Nhập tên sản phẩm"
                                name = "name"
                                value = "{{old('name')}}"
                            >      
                            @error('name')
                                <div class="alert alert-danger error">{{ $message }}</div>
                            @enderror              
                        </div>
                        <div class="form-group">
                            <label>Giá sản phẩm</label>
                            <input type="text" 
                                class="form-control @error('price') is-invalid @enderror" 
                                placeholder="Nhập giá sản phẩm"
                                name = "price"
                                value = "{{old('price')}}"
                            >              
                            @error('price')
                                <div class="alert alert-danger error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Ảnh đại diện</label>
                            <input type="file" 
                                class="form-control-file" 
                                name = "feature_image_path"
                            >                     
                        </div>
                        <div class="form-group">
                            <label>Ảnh chi tiết</label>
                            <input type="file" 
                                multiple
                                class="form-control-file" 
                                name = "image_path[]"
                            >                     
                        </div>
                        <div class="form-group">
                            <label>Chọn danh mục</label>
                            <select class="form-control categories-select2-choose @error('category_id') is-invalid @enderror" name="category_id">
                                <option value="">Chọn danh mục</option>
                                {!!$htmlOptionsCategory!!}
                            </select>
                            @error('category_id')
                                <div class="alert alert-danger error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tags</label>
                            <select name="tags[]" class="form-control tags-select-choose @error('tags') is-invalid @enderror" multiple="multiple">
                                {!!$htmlOptionsTags!!}
                            </select>
                            @error('tags')
                                <div class="alert alert-danger error">{{ $message }}</div>
                            @enderror
                        </div>                   
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea name="contents"  class="form-control my-editor @error('contents') is-invalid @enderror" rows="16">{{old('contents')}}</textarea>                 
                            @error('contents')
                                <div class="alert alert-danger error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /.content -->
    </div>
    </form>
    <!-- /.content-wrapper -->
@endsection

@section('js')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="{{ asset('adm1/product/create.js') }}"></script>
@endsection