@extends('layouts/admin')

@section('title')
    <title>Setting</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('adm1/setting/create.css') }}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials/content-header',['name' => 'Setting', 'key' => 'Add'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('settings.store').'?type='.request()->type }}" method="post">
                        @csrf
                            <div class="form-group">
                                <label>Config Key</label>
                                <input type="text" 
                                    class="form-control @error('config_key') is-invalid @enderror" 
                                    placeholder="Nhập config key"
                                    name = "config_key"
                                >  
                                @error('config_key')
                                    <div class="alert alert-danger error">{{ $message }}</div>
                                @enderror                  
                            </div>
                            @if(request()->type === 'Text')
                            <div class="form-group">
                                <label>Config Value</label>
                                <input type="text" 
                                    class="form-control @error('config_value') is-invalid @enderror" 
                                    placeholder="Nhập config value"
                                    name = "config_value"
                                >   
                                @error('config_value')
                                    <div class="alert alert-danger error">{{ $message }}</div>
                                @enderror 
                            </div>
                            @elseif(request()->type === 'Textarea')
                            <div class="form-group">
                                <label>Config Value</label>
                                <textarea 
                                    class="form-control @error('config_value') is-invalid @enderror" 
                                    placeholder="Nhập config value"
                                    name = "config_value"
                                    rows ="5"
                                ></textarea>
                                @error('config_value')
                                    <div class="alert alert-danger error">{{ $message }}</div>
                                @enderror 
                            </div>
                            @endif
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection