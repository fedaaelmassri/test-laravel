@extends('layouts.dashboard')
@section('title')
{{trans('lang.Add-design-file')}}
@endsection


@section('css')

<style>
 

</style>
<link rel="stylesheet" href="{{ asset('assets/vendor/animate-css/vivify.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/vendor/light-gallery/css/lightgallery.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/sweetalert/sweetalert.css')}}" />
<link href="{{ asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}" rel="stylesheet">
<!-- MAIN CSS -->
@endsection


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">

            <div class="body">
                @if(session('message_flash'))
                <div class="alert alert-success">
                    {{session('message_flash')}}
                </div>
                @endif

                <form method="POST" action="{{route('admin.uploadfile.store')}}" id="basic-form" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-4">
                                <label class="control-label">{{trans('lang.File-title-ar')}} </label>
                                <input type="text" value="{{old('title_file')}}" class="form-control @if ($errors->has('title_file'))is-invalid @endif" id="title_file" name="title_file" required />

                                @if ($errors->has('title_file'))
                                <p class="text-danger">{{$errors->first('title_file')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-4">
                                <label class="control-label"> {{trans('lang.File-title-en')}} </label>
                                <input type="text" value="{{old('title_file_en')}}" class="form-control @if ($errors->has('title_file_en'))is-invalid @endif" id="title_file_en" name="title_file_en" required />

                                @if ($errors->has('title_file_en'))
                                <p class="text-danger">{{$errors->first('title_file_en')}}</p>
                                @endif
                            </div>
                        </div>





                        <!--<div class="col-lg-6  col-md-12">-->
                        <!--     <div class="input-group mb-4">-->
                          
                                
                        <!--    </div>-->
                        <!--</div>-->







                        <br>


                        <div class=" col-lg-6 col-md-12">

                            <div class="input-group mb-4">

                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{trans('lang.design-file')}} </span>
                                </div>
                                <div class="custom-file">
                                    <input name="fileupload" type="file" class="custom-file-input  @if ($errors->has('fileupload'))is-invalid @endif " id="fileupload" required>
                                    <label class="custom-file-label" for="fileupload"></label>
                                  
                                </div>
                            </div>

                        </div>



                        <div class=" col-lg-6 col-md-12">

                             <div class="input-group " style="margin-top:7px">
                                   @if ($errors->has('fileupload'))
                                    <p class="text-danger">{{$errors->first('fileupload')}}</p>
                                    @endif
                                <p id="upload"></p>
                            </div>
                        </div>




                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-4">

                                <label for="description" class="control-label"> {{trans('lang.description-ar')}}</label>
                                <textarea rows="4" cols="50" value="{{old('description')}}" type="text" class="form-control @if ($errors->has('description'))is-invalid @endif " id="description" name="description" required>  </textarea>

                                @if ($errors->has('description'))
                                <p class="text-danger">{{$errors->first('description')}}</p>
                                @endif
                            </div>
                        </div>
                            <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-4">

                                <label for="description_en" class="control-label"> {{trans('lang.description-en')}}</label>
                                <textarea rows="4" cols="50" value="{{old('description_en')}}" type="text" class="form-control @if ($errors->has('description_en'))is-invalid @endif " id="description_en" name="description_en" required>  </textarea>

                                @if ($errors->has('description_en'))
                                <p class="text-danger">{{$errors->first('description_en')}}</p>
                                @endif
                            </div>
                        </div>



                        <br>
                        <br>

                        <div class="col-md-12 col-lg-12">
                            <button type="submit" class="btn btn-primary mb-3">{{trans('lang.Add')}}</button>
                            <a class="btn btn-dark mb-3" href="{{route('admin.uploadfile')}}">{{trans('lang.back')}}</a>
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
</script>
<script>
    
    
    
    
    
    
    
    
      $(document).ready(function() {
    
    
    $('#fileupload').change(function() {

  var file = $('#fileupload')[0].files[0].name;
 $("#upload").text(file);
 
});
      });  
       
        
        
        
    
    
</script>
@endsection


