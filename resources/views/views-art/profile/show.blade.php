@extends('layouts.dashboard')
@section('profile','active')
@section("title")
{{trans('lang.my-profile')}}

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
                            <h5 class="mb-2">{{ $user->name }} {{ $user->lname }}</h5>
                            @if($user->isAdmin ==1)
                            <span class="text-light">{{trans('lang.Designer')}} </span>
                            @else
                            <span class="text-light"> {{trans('lang.worker')}}</span>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-8 col-md-7">
            <div class="card">
                <div class="header">
                    <h2> {{trans('lang.basic-info')}}</h2>
                </div>
                <div class="body">
                    <form method="POST" action="{{route('update_basic_proile',['id'=>$user->id])}}" id="basic-form"
                          novalidate enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label class="control-label"> {{trans('lang.fname')}}</label>
                                    <input type="text" value="{{ $user->name }}"  name="name" required
                                           class="form-control" placeholder=" {{trans('lang.fname')}}">
                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{$errors->first('name')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label class="control-label"> {{trans('lang.lname')}} </label>
                                    <input type="text" value="{{ $user->lname }}" name="lname" required
                                           class="form-control" placeholder="{{trans('lang.lname')}}">
                                    @if ($errors->has('lname'))
                                        <p class="text-danger">{{$errors->first('lname')}}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label class="control-label">  {{trans('lang.phone')}}</label>
                                    <input type="text" class="form-control" value="{{$user->phone}}" required
                                           name="phone" placeholder="{{trans('lang.phone')}}">
                                    @if ($errors->has('phone'))
                                        <p class="text-danger">{{$errors->first('phone')}}</p>
                                    @endif
                                </div>
                            </div>




                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label class="control-label">{{trans('lang.address')}}</label>
                                    <input value="{{ $user->address }}" type="text" name="address" required
                                           class="form-control"  placeholder="{{trans('lang.address')}} ">  
                                    @if ($errors->has('address'))
                                        <p class="text-danger">{{$errors->first('address')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{trans('lang.avater')}}  </span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file"
                                               class="form-control custom-file-input @if ($errors->has('avater'))is-invalid @endif"
                                               id="avater" name="avater" value="{{$user->avater}}">
                                        <label class="custom-file-label" for="avater"> {{trans('lang.choose-file')}} </label>
                                        @if ($errors->has('avater'))
                                            <p class="text-danger">{{$errors->first('avater')}}</p>
                                        @endif
                                    </div>

                                </div>

                            </div>
                            <div class="col-lg-12 col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">{{trans('lang.Editing')}}</button> &nbsp;&nbsp;
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
        <div class="col-xl-4 col-lg-4 col-md-5">
            <div class="card">
                <div class="header">
                    <h2>{{trans('lang.edit-password')}}  </h2>
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
                                           placeholder="{{trans('lang.Current-password')}}">
                                    @error('current-password')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" name="new-password"
                                           class="form-control @error('new-password') is-invalid @enderror" required
                                           placeholder="{{trans('lang.New-password')}}">
                                    @error('new-password')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" name="new-password_confirmation" class="form-control"
                                           placeholder="{{trans('lang.Confirm-password')}}">
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary">{{trans('lang.Change-password')}}</button> &nbsp;&nbsp;
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
