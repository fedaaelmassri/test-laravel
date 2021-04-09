@extends('layouts.dashboard')
@section('title')
{{trans('lang.edit-design-file')}}
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<!-- MAIN CSS -->
@endsection




@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">

            <div class="body">
              

                <form method="POST" action="{{route('admin.uploadfile.update',['id'=> $file->id])}}" id="basic-form" novalidate enctype="multipart/form-data">
                @method('PUT')
                @csrf
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-4">
                                 <label class="control-label">{{trans('lang.File-title-ar')}} </label>

                                <input type="text" value="{{$file->title_file}}" class="form-control @if ($errors->has('title_file'))is-invalid @endif" id="title_file" name="title_file" required />

                                @if ($errors->has('title_file'))
                                <p class="text-danger">{{$errors->first('title_file')}}</p>
                                @endif
                            </div>
                        </div>
                        
                        
                          <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-4">
                               <label class="control-label">{{trans('lang.File-title-en')}} </label>
                                <input type="text" value="{{$file->title_file_en}}" class="form-control @if ($errors->has('title_file_en'))is-invalid @endif" id="title_file_en" name="title_file_en" required />

                                @if ($errors->has('title_file_en'))
                                <p class="text-danger">{{$errors->first('title_file_en')}}</p>
                                @endif
                            </div>
                        </div>





                        <!--<div class="col-lg-6  col-md-12">-->

                        <!--    <div class="input-group mb-4">-->
                        <!--    </div>-->
                        <!--</div>-->







                        <br>


                        <div class=" col-lg-6 col-md-12">

                            <div class="input-group mb-4">

                                <div class="input-group-prepend">
                              <span class="input-group-text">{{trans('lang.design-file')}} </span>
                                </div>
                                <div class="custom-file">
                                    <input   name="fileupload" value='{{$file->fileupload}}' type="file" class="custom-file-input  @if ($errors->has('fileupload'))is-invalid @endif " id="fileupload" required>
                                    <label class="custom-file-label" for="fileupload"></label>
                                   
                                   
                                     @if ($errors->has('fileupload'))
                                <p class="text-danger">{{$errors->first('fileupload')}}</p>
                                @endif
                                </div>

                            </div>

                        </div>



                        <div class=" col-lg-6 col-md-12">

                                <div class="input-group " style="margin-top:7px">

                                 @if ($errors->has('fileupload'))
                                    <p class="text-danger">{{$errors->first('fileupload')}}</p>
                                    @endif
                                 <a href="{{asset('storage/DesignFile/' . $file->fileupload )}}"
                                       download="{{$file->original_name}}" id="upload">
                                       {{$file->original_name}}
                                    </a>
                        </div>

</div>


                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-4">

                              <label for="description" class="control-label"> {{trans('lang.description-ar')}}</label>
                                <textarea rows="4" cols="50" value="" type="text" class="form-control  @if ($errors->has('description'))is-invalid @endif  " id="description" name="description" required>{{$file->description}}  </textarea>

                                @if ($errors->has('description'))
                                <p class="text-danger">{{$errors->first('description')}}</p>
                                @endif
                            </div>
                        </div>

                         <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-4">

                              <label for="description_en" class="control-label"> {{trans('lang.description-en')}}</label>
                                <textarea rows="4" cols="50" value="" type="text" class="form-control  @if ($errors->has('description_en'))is-invalid @endif  " id="description_en" name="description_en" required>{{$file->description_en}}  </textarea>

                                @if ($errors->has('description_en'))
                                <p class="text-danger">{{$errors->first('description_en')}}</p>
                                @endif
                            </div>
                        </div>



                        <br>
                        <br>

                        <div class="col-md-12 col-lg-12">
                            <button type="submit" class="btn btn-primary mb-3">{{trans('lang.Editing')}}</button>
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


