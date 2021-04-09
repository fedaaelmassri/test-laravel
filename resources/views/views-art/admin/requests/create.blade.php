@extends('layouts.dashboard')
@section('title','إضافة طلب')
@section('createRequest','active')






@section('css')

<style>
  article, aside, figure, footer, header, hgroup, 
  menu, nav, section { display: block; }



.img {
    border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  display: block;
  margin-left: auto;

}

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

                <form method="POST" action="{{route('admin.requests.store')}}" id="basic-form" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-4">
                                <label for="color_t" class="control-label">لون التيشيرت</label>
                                <input value="{{old('color_t')}}" type="text" class="form-control @if ($errors->has('color_t'))is-invalid @endif" id="color_t" name="color_t" required>
                                @if ($errors->has('color_t'))
                                <p class="text-danger">{{$errors->first('color_t')}}</p>
                                @endif
                            </div>
                        </div>



                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-4">
                                <label for="size" class="control-label">المقاس </label>
                                <select class="form-control @if ($errors->has('size'))is-invalid @endif size" id="size" name="size" required>
                                    <option value="">الرجاء اختيار المقاس</option>
                                    <option {{ old("size")}} value="S"> S</option>
                                    <option {{ old("size")}} value="M"> M</option>
                                    <option {{ old("size")}} value="L"> L</option>
                                    <option {{ old("size")}} value="XL"> XL</option>
                                    <option {{ old("size")}} value="2XL"> 2XL</option>
                                    <option {{ old("size")}} value="3XL"> 3XL</option>
                                    <option {{ old("size")}} value="4XL"> 4XL</option>
                                    <option {{ old("size")}} value="5XL"> 5XL</option>
                                    <option {{ old("size")}} value="6XL"> 6XL</option>

                                </select>
                                @if ($errors->has('size'))
                                <p class="text-danger">{{$errors->first('size')}}</p>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="col-lg-6  col-md-12">

                            <div class="input-group mb-4">

                                <div class="input-group-prepend">
                                    <span class="input-group-text">صورة المنتج</span>
                                </div>
                                

                                
                                
                                <div class="custom-file">
                                    <input name="image" type="file"  onchange="readURL(this);" class="custom-file-input  @if ($errors->has('image'))is-invalid @endif " multiple="" id="image" required>
                                    <label class="custom-file-label" for="image"></label>
                                  
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6  col-md-12">

                            <div class="input-group mb-4">
                                   @if ($errors->has('image'))
                                    <p class="text-danger">{{$errors->first('image')}}</p>
                                    @endif
                                 <img id="blah" src="#" alt=" صورة المنتج " />
                                
                            </div>
                        </div>
                        <!--<div class="col-lg-4 col-md-12">-->
                        <!--    <div class="form-group">-->
                        <!--        <label for="color_v" class="control-label">لون الفينيل</label>-->
                        <!--        <input value="{{old('color_v')}}" type="text" class="form-control @if ($errors->has('color_v'))is-invalid @endif" id="color_v" name="color_v" required>-->
                        <!--        @if ($errors->has('color_v'))-->
                        <!--        <p class="text-danger">{{$errors->first('color_v')}}</p>-->
                        <!--        @endif-->
                        <!--    </div>-->
                        <!--</div>-->




                        <!--<div class="col-lg-4 col-md-12">-->
                        <!--    <div class="form-group mb-4">-->
                        <!--        <label for="code_v" class="control-label">رمز الفينيل</label>-->
                        <!--        <input value="{{old('code_v')}}" type="text" class="form-control @if ($errors->has('code_v'))is-invalid @endif" id="code_v" name="code_v" required>-->
                        <!--        @if ($errors->has('code_v'))-->
                        <!--        <p class="text-danger">{{$errors->first('code_v')}}</p>-->
                        <!--        @endif-->
                        <!--    </div>-->
                        <!--</div>-->

                        <!--<div class="col-lg-4 col-md-12">-->
                        <!--    <div class="form-group mb-4">-->
                        <!--        <label for="type_v" class="control-label">نوع الفينيل</label>-->
                        <!--        <input value="{{old('type_v')}}" type="text" class="form-control @if ($errors->has('type_v'))is-invalid @endif" id="type_v" name="type_v" required>-->
                        <!--        @if ($errors->has('type_v'))-->
                        <!--        <p class="text-danger">{{$errors->first('type_v')}}</p>-->
                        <!--        @endif-->
                        <!--    </div>-->
                        <!--</div>-->


                        <br>


                        <div class=" col-lg-6 col-md-12">

                            <div class="input-group mb-4">

                                <div class="input-group-prepend">
                                    <span class="input-group-text">ملف التصميم</span>
                                </div>
                                <div class="custom-file">
                                    <input name="fileupload" type="file"  class="custom-file-input  @if ($errors->has('fileupload'))is-invalid @endif "  id="fileupload" >
                                    <label class="custom-file-label" for="fileupload"></label>
                                    @if ($errors->has('fileupload'))
                                    <p class="text-danger">{{$errors->first('fileupload')}}</p>
                                    @endif
                                </div>
                            </div>

                        </div>



                        <div class=" col-lg-6 col-md-12">

                            <div class="input-group  style="margin-top:7px"">
                                <p id="upload"></p>
                                
                            </div>
                        </div>





                        <!--
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label for="description" class="control-label"> وصف الطلب</label>
                                <textarea rows="4" cols="50" value="" type="text" class="form-control  " id="description" name="description" required>  </textarea>
                                 @if ($errors->has('description'))
                                        <p class="text-danger">{{$errors->first('description')}}</p>
                                    @endif
                            </div>
                        </div> -->
<br>
<br>

                        <div class="col-md-12 col-lg-12">
                            <button type="submit" class="btn btn-primary mb-3">تم</button>
                            <a class="btn btn-dark mb-3" href="{{route('admin.requests')}}">الرجوع</a>
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
         function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                       
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(66)
                        .height(38);
                };

                reader.readAsDataURL(input.files[0]);
                
          
            }
        }
        
    
        
        
        
    
    
</script>
@endsection

