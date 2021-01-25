@extends('layouts/admin')

@section('title')
    <title>Edit User</title>
@endsection

@section('css')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('adm1/user/create.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials/content-header',['name' => 'User', 'key' => 'Edit'])
        <!-- /.content-header -->

        <!-- Main content --> 
        <form action="{{ route('users.update',['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tên</label>
                                <input type="text" 
                                    class="form-control" 
                                    placeholder="Nhập tên"
                                    name = "name"
                                    value = "{{ $user->name }}"
                                >                                                    
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" 
                                    class="form-control" 
                                    placeholder="Nhập email"
                                    name = "email"
                                    value = "{{ $user->email }}"
                                >                                                    
                            </div>  
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" 
                                    class="form-control" 
                                    placeholder="Nhập password"
                                    name = "password"
                                >                                                        
                            </div> 
                            <div class="form-group">
                                <label>Chọn vai trò</label>
                                <select name="role_id[]" class="form-control select2_init" multiple="multiple">
                                    <option value=""></option>
                                    @foreach($roles as $role)
                                        <option
                                        {{ $roleOfUser->contains('id',$role->id) ? 'selected' : '' }}
                                        value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach

                                </select>
                                                                                    
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

@section('js')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('adm1/user/create.js') }}"></script>
@endsection