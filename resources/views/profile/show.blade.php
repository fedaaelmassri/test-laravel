@extends('layouts.dashboard')
@section('profile','active')
@section("title")
My Profile

@endsection
@section("css")
@endsection

@section("content")

    @if(session('message_flash'))
        <div class="alert alert-success">
            {{session('message_flash')}}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card social">
                <div class="profile-header d-flex justify-content-between justify-content-center">
                    <div class="d-flex">
                        <div class="mr-3">
                        <img src="{{ Auth::user()->avater?asset('storage/'. Auth::user()->avater):asset('assets/images/user-small.png') }}" class="rounded" alt="صورة المستخدم">


                        </div>
                        <div class="details">
                            <h5 class="mb-2">{{ $user->name }}  </h5>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-8 col-md-7">
            <div class="card">
                <div class="header">
                    <h2> Basic Info</h2>
                </div>
                <div class="body">
                    <form method="POST" action="#" id="basic-form"
                          novalidate enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label class="control-label"> Name</label>
                                    <input type="text" value="{{ $user->name }}"  name="name" required
                                           class="form-control" placeholder="name">
                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{$errors->first('name')}}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input value="{{ $user->email }}" type="email" name="email" required
                                           class="form-control"  placeholder="email ">  
                                    @if ($errors->has('email'))
                                        <p class="text-danger">{{$errors->first('email')}}</p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-lg-12 col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">Save</button> &nbsp;&nbsp;
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
        <div class="col-xl-4 col-lg-4 col-md-5">
            <div class="card">
                <div class="header">
                    <h2>Change Password  </h2>
                </div>
                <div class="body">
                    <form method="POST" action="{{route('changePassword')}}" id="basic-form-pass" novalidate
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <input type="email" value="{{ $user->email }}" class="form-control" disabled>
                                </div>

                                <div class="form-group">
                                    <input type="password" name="current-password"
                                           class="form-control @error('current-password') is-invalid @enderror" required
                                           placeholder="Current Password">
                                    @error('current-password')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" name="new-password"
                                           class="form-control @error('new-password') is-invalid @enderror" required
                                           placeholder="New Password">
                                    @error('new-password')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" name="new-password_confirmation" class="form-control"
                                           placeholder="Confirm Password">
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary">Change Password</button> &nbsp;&nbsp;
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection


@section("js")
<script src="{{asset('assets/vendor/jquery-validation/jquery.validate.js')}}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.0.6/parsley.min.js"></script>

<!-- Jquery Validation Plugin Css -->
<!-- data table js -->
<script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
<script src="{{asset('assets/vendor/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/js/pages/ui/dialogs.js')}}"></script>


<script>

    
    $(function () {
        $('#basic-form').parsley();
    });
    
      $(function () {
        $('#basic-form-pass').parsley();
    });
</script>

@endsection
