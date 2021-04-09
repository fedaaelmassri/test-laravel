@extends('layouts.dashboard')
@section('title','Update Product')
@section('products','active')






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

                <form method="POST" action="{{route('products.update',['id'=>$product->id])}}" id="basic-form" novalidate enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-4">
                                <label for="color_t" class="control-label"> Product Name</label>
                                <input value="{{old('name', $product->name)}}" type="text" class="form-control @if ($errors->has('name'))is-invalid @endif" id="name" name="name" required>
                                @if ($errors->has('name'))
                                <p class="text-danger">{{$errors->first('name')}}</p>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12"> 
                            <div class="form-group mb-4"> 
                            <label for="code_v" class="control-label">Product Price</label>
                           <input value="{{old('price', $product->price)}}" type="number" class="form-control @if ($errors->has('price'))is-invalid @endif" id="price" name="price" required>
                                @if ($errors->has('price'))
                                  <p class="text-danger">{{$errors->first('price')}}</p>
                                  @endif
                            </div>
                           </div>

                   
                    
                    </div>

                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label for="description" class="control-label">   Product Details</label>
                            <textarea rows="4" cols="50" type="text" class="form-control  " id="details" name="details" required> {{old('details', $product->details)}} </textarea>
                             @if ($errors->has('details'))
                                    <p class="text-danger">{{$errors->first('details')}}</p>
                                @endif
                        </div>
                    </div>
                </div>

                 <div class="row clearfix">

                    <div class="col-lg-6  col-md-12">
                        <label for="image" class="control-label">  </label>

                        <div class="input-group mb-4">

                            <div class="input-group-prepend">

                                <span class="input-group-text"> Product image</span>

                            </div>
                            <div class="custom-file">
                                <input name="image" type="file"  value="{{old('image', $product->image)}}"  class="  @if ($errors->has('image'))is-invalid @endif " multiple="" id="image"  >
                                <label class="custom-file-label" for="image"></label>
                              
                            </div>
                           
                         </div>
                         <br>
                         <img src="{{asset('storage/'.$product->image)}}" alt="" width="150" height="150">


                    </div>
                    <div class="col-lg-6  col-md-12">
                        <div class="form-group">
                              <label for="status" class="control-label">Status</label>
                              <select class="form-control" id="status" name="status" required>
                                <option value="">اختر تصنيف</option>
                                <option value="1" {{$product->status=='1'?"selected" :""}}> Avaliable</option>
                                <option value="0" {{$product->status=='0'?"selected" :""}}> Unavaliable</option>
                            </select>
                             @if ($errors->has('status'))
                             <p class="text-danger">{{$errors->first('status')}}</p>
                        @endif
                         </div>
                      </div>
               
            </div>
           

                       


                        <br>
              
                        
<br>
<br>

                        <div class="col-md-12 col-lg-12">
                            <a class="btn btn-dark mb-3" href="{{route('products')}}">Back</a>
                            <button type="submit" class="btn btn-primary mb-3">Save</button>

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

