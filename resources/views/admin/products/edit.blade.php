@extends('layouts/admin')

@section('title')
    <title>Edit Product</title>
@endsection
    
@section('css')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" /> 
    <link href="{{ asset('adm1/product/edit.css')}}"/>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials/content-header',['name' => 'Product', 'key' => 'Edit'])
        <!-- /.content-header -->

        <!-- Main content -->
        <form action="{{ route('products.update',['id'=> $products->id]) }}" method="post" enctype="multipart/form-data">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                    @csrf
                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input type="text" 
                                class="form-control" 
                                placeholder="Nhập tên sản phẩm"
                                name = "name"
                                value = "{{ $products->name }}"
                            >                    
                        </div>
                        <div class="form-group">
                            <label>Giá sản phẩm</label>
                            <input type="text" 
                                class="form-control" 
                                placeholder="Nhập giá sản phẩm"
                                name = "price"
                                value = "{{ $products->price }}"
                            >              
                        </div>
                        <div class="form-group">
                            <label>Ảnh đại diện</label>
                            <input type="file" 
                                class="form-control-file" 
                                name = "feature_image_path"
                            >   
                            <div class="col-md-12">
                                <div class="row">
                                    <img class="container_image_detail" src="{{ $products->feature_image_path }}" alt="">
                                </div>
                            </div>                  
                        </div>
                        <div class="form-group">
                            <label>Ảnh chi tiết</label>
                            <input type="file" 
                                multiple
                                class="form-control-file" 
                                name = "image_path[]"
                            > 
                            <div class="col-md-12">
                                <div class="row">
                                    @foreach ($products->productImage as $item)
                                        <div class="col-md-3">
                                            <img class="image_detail_product container_image_detail" src="{{ $item->image_path }}" alt="">
                                        </div>
                                    @endforeach
                                </div>
                            </div>                   
                        </div>
                        <div class="form-group">
                            <label>Chọn danh mục</label>
                            <select class="form-control categories-select2-choose" name="category_id">
                                <option value="">Chọn danh mục</option>
                                {!!$htmlOptions!!}
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tags</label>
                            <select name="tags[]" class="form-control tags-select-choose" multiple="multiple">
                                @foreach ($products->tags as $tagItem)
                                    <option value="{{$tagItem->id}}" selected>{{$tagItem->name}}</option>
                                @endforeach
                            </select>
                        </div>                   
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea name="contents"  class="form-control my-editor" rows="16">{{ $products->content }}</textarea>                 
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