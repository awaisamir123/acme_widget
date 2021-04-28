@extends('layouts.app')
@section('title', 'Add Product')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Product Item</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="clearfix"></div>
                    <div style="float: right;margin-top: 10px">

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
                            {{-- <form role="form" method="post" action="{{route('product.store.offer')}}" enctype="multipart/form-data">
                                {{csrf_field()}} --}}

                                <div class="form-group">
                                    <label for="title">Offer</label>
                                    <br>
                                    “buy one red widget,
get the second half price”.
                                     <br>
                                     <br>
                                     <div class="row">
                                       @foreach($products as $p)
                                       <div class="col-md-4 mt-3">
                                          <img src="{{asset('/product_image/img.jpg')}}"/>
                                          <br>
                                          <span>{{$p->name}}</span>
                                          <br>
                                          <span>${{$p->price}}</span>
                                          <br>
                                          <input type="text" class="quantity" name="quantity" value="1" palceholder="1" maxlength="2"/>
                                            <br>
                                          <button class="btn btn-primary addToCart" value="{{$p->id}}" style="margin-top:10px">Add To Cart</button>
                                       </div>
                                        @endforeach
                                     </div>






                                </div>
                                {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                            {{-- </form> --}}
                        </div>
                    </div>
                </div>
            </div>
    </section>

@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
  $(document).ready(function(){
    $(".addToCart").click(function(){
      var productid =$(this).val();
      var productquantity =$('.quantity').val();
      var token = "{{ csrf_token() }}";
              $.ajax({
                url: "{{ route('productDetail') }}",
                data:{productid:productid,productquantity:productquantity, _token:token},
                type: 'POST',
                success: function(result) {
                  alert("Successfully Item Into Cart");
        }
      });
    });
  });
  </script>
@endsection
