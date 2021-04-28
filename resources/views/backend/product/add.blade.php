@extends('layouts.app')
@section('title', 'Add Product')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Add Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="clearfix"></div>
                    <div style="float: right;margin-top: 10px">
                        <a href="{{route('product.list')}}" class="btn btn-primary">Back</a>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-body">
                            @if($errors->all())
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger">
                                        {{$error}}
                                    </div>
                                @endforeach
                            @endif
                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{session()->get('success')}}
                                </div>
                            @endif
                            @if(session()->has('error'))
                                <div class="alert alert-danger">
                                    {{session()->get('error')}}
                                </div>
                            @endif
                            <form role="form" method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="form-group">
                                    <label for="title">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{old('name')}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="title">Code</label>
                                    <input type="text" name="code" class="form-control" id="code" placeholder="Code" value="{{old('code')}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="title">Price</label>
                                    <input type="number" step='any' name="price" class="form-control" id="price" placeholder="Price" value="{{old('price')}}" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
