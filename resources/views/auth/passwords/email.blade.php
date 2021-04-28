@extends('layouts.layout')
@section('title','Canvas-Login')
@section('content')
    <div class="container-fluid p-0 m-0">
        <div class="row justify-content-end h-100 m-0">
            <div class="col-md-6 bg-white">
                <div class="px-10 py-10">
                    <div class="row pt-4">
                        <div class="col-md-12 ">

                            @if($errors->all())
                                <div class="alert alert-warning alert-dismissible">
                                    @foreach($errors->all() as $error)
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><br>
                                        {{$error}}
                                    @endforeach
                                </div>
                            @endif
                            @if(session()->has('success'))
                                <div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{session()->get('success')}}
                                </div>
                            @endif
                            @if(session()->has('error'))
                                <div class="alert alert-warning alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{session()->get('error')}}
                                </div>
                            @endif

                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif


                            <div class="nav nav-tabs nav-fill w-75" id="nav-tab" role="tablist">
                                <h3>Password Reset</h3>
                            </div>
                            <div class="tab-content py-3 px-3 px-sm-0 mt-2 bg-white" id="nav-tabContent">
                                <div class="tab-pane fade active show " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <form method="post" action="{{route('password.email')}}">
                                        @csrf

                                        <div class="form-group position-relative">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            <span class="position-absolute custom-append"><i class="fas fa-user"></i></span>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-secondary btn-block hvr-white my-3">
                                            Password Reset Send Link
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('js')
    <script>
        function openNav() {
            document.getElementById("myNav").style.width = "100%";
        }

        function closeNav() {


            document.getElementById("myNav").style.width = "0%";
        }
    </script>
@endpush






























