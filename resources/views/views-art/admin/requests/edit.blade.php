@extends('layouts.dashboard')
@section('title','تعديل طلب')






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
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<!-- MAIN CSS -->
@endsection








@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>تعديل طلب</h2>
            </div>
            <div class="body">
                @if(session('message_flash'))
                <div class="alert alert-success">
                    {{session('message_flash')}}
                </div>
                @endif

                <form method="POST" action="{{route('admin.requests.update',['id'=> $request->id] )}}" id="basic-form" novalidate enctype="multipart/form-data">
                @method('PUT')
                @csrf
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-4">
                                <label for="color_t" class="control-label">لون التيشيرت</label>
                                <input value="{{old('color_t',$request->color_t)}}" type="text" class="form-control @if ($errors->has('color_t'))is-invalid @endif" id="color_t" name="color_t" required>
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
                                    <option value="S"  {{ old('size', $request->size)== "S" ? ' selected' : ''  }} > S</option>
                                    <option value="M" {{ old('size', $request->size)== "M" ? ' selected' : ''  }}> M</option>
                                    <option value="L" {{ old('size', $request->size)== "L" ? ' selected' : ''  }}> L</option>
                                    <option value="XL" {{ old('size', $request->size)== "XL" ? ' selected' : ''  }}> XL</option>
                                    <option value="XXL" {{ old('size', $request->size)== "2XL" ? ' selected' : ''  }}> 2XL</option>
                                    <option value="XXXL" {{ old('size', $request->size)== "3XL" ? ' selected' : ''  }}> 3XL</option>
                                    <option value="XXXXL" {{ old('size', $request->size)== "4XL" ? ' selected' : ''  }}> 4XL</option>
                                    <option value="XXXXL" {{ old('size', $request->size)== "5XL" ? ' selected' : ''  }}> 5XL</option>
                                    <option value="XXXXL" {{ old('size', $request->size)== "6XL" ? ' selected' : ''  }}> 6XL</option>

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
                                    <input name="image" type="file" onchange="readURL(this);" class="custom-file-input  @if ($errors->has('image'))is-invalid @endif " multiple="" id="image" required>
                                    <label class="custom-file-label" for="image"></label>
                                  
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6  col-md-12">

                            <div class="input-group pb-4">
                                    @if ($errors->has('image'))
                                    <p class="text-danger">{{$errors->first('image')}}</p>
                                    @endif
                                <img src="{{asset('storage/' . $request->image )}}"  id="blah"  class="img" height="38" width="66">

                            </div>
                        </div>
                        <!--<div class="col-lg-4 col-md-12">-->
                        <!--    <div class="form-group">-->
                        <!--        <label for="color_v" class="control-label">لون الفينيل</label>-->
                        <!--        <input value="{{old('color_v',$request->color_v )}}" type="text" class="form-control @if ($errors->has('color_v'))is-invalid @endif" id="color_v" name="color_v" required>-->
                        <!--        @if ($errors->has('color_v'))-->
                        <!--        <p class="text-danger">{{$errors->first('color_v')}}</p>-->
                        <!--        @endif-->
                        <!--    </div>-->
                        <!--</div>-->




                        <!--<div class="col-lg-4 col-md-12">-->
                        <!--    <div class="form-group mb-4">-->
                        <!--        <label for="code_v" class="control-label">رمز الفينيل</label>-->
                        <!--        <input value="{{old('code_v',$request->code_v)}}" type="text" class="form-control @if ($errors->has('code_v'))is-invalid @endif" id="code_v" name="code_v" required>-->
                        <!--        @if ($errors->has('code_v'))-->
                        <!--        <p class="text-danger">{{$errors->first('code_v')}}</p>-->
                        <!--        @endif-->
                        <!--    </div>-->
                        <!--</div>-->

                        <!--<div class="col-lg-4 col-md-12">-->
                        <!--    <div class="form-group mb-4">-->
                        <!--        <label for="type_v" class="control-label">نوع الفينيل</label>-->
                        <!--        <input value="{{old('type_v',$request->type_v)}}" type="text" class="form-control @if ($errors->has('type_v'))is-invalid @endif" id="type_v" name="type_v" required>-->
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
                                    <input name="fileupload" type="file" class="custom-file-input  @if ($errors->has('fileupload'))is-invalid @endif " id="fileupload" >
                                    <label class="custom-file-label" for="fileupload"></label>
                                    @if ($errors->has('fileupload'))
                                    <p class="text-danger">{{$errors->first('fileupload')}}</p>
                                    @endif
                                </div>
                            </div>

                        </div>



                        <div class=" col-lg-6 col-md-12">

                            <div class="input-group " style="margin-top:7px">
                                
                              
                
                                
                                 <a href="{{asset('storage/files/' . $request->filePath )}}"
                                       download="{{$request->original_name}}" id="upload">
                                       {{$request->original_name}}
                                    </a>
                            </div>
                        </div>


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
                        .attr('src', e.target.result);
                        
                };

                reader.readAsDataURL(input.files[0]);
                
          
            }
        }
    
    
</script>
@endsection

