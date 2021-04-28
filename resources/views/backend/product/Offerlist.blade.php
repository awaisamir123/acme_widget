@extends('layouts.app')
@section('title', 'Product List')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Product Offer List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="clearfix"></div>
                    <div style="float: right;margin-top: 10px">
                        <a href="{{route('product.add.offer')}}" class="btn btn-primary">Add Product Offer</a>

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

                    <table class="table table-striped">
                        <thead>
                        <th>Sr.No</th>
                        <th>Offer</th>
                        <th>Status</th>
                        </thead>
                        <tbody>
                        @php
                            $c=1;
                        @endphp
                        @foreach($products as $product)
                            <tr>
                                <td>{{$c}}</td>
                                <td>{{$product->offer}}</td>
                                <td>{{isset($product->is_active) && $product->is_active == 1 ? 'Active':'Un Active'}}</td>
                            </tr>
                            @php $c++; @endphp
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
@endsection
@push('js')
    <script>
        function deleteRow(url){
            var checkstr =  confirm('are you sure you want to delete it?');
            if(checkstr == true){
                window.location.href = url;
            }else{
                return false;
            }
        }
    </script>
@endpush
