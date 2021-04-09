@extends('layouts.dashboard')

@section('products','active')
@section("title") 

Products


@endsection

@section('css')

<style>
    .img {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
        display: block;
        margin-left: auto;
        margin-right: auto;

    }

    .badge {
        padding: 9px 8px !important;

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
 

@section('btn')

<div class="col-md-6 col-sm-12 text-right">
    <a class="btn btn-sm btn-primary ml-2 " href="{{route('products.create')}}"  title="New Product">
        <i class="fa fa-plus ml-2"></i> New Product
    </a>
</div>




<br>


@endsection
 @section("content")


@if (session('message'))
<div class="alert alert-success">

    {{session('message')}}
</div>
@endif


<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="table-responsive">

                <table class="table table-hover js-basic-example dataTable table-custom spacing8" id="m_table_1">

                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center"> Product Name</th>
                            <th class="text-center"> price </th>
                            <th class="text-center"> status </th>
                            <th class="text-center"> image </th>
 
                            <th width="13%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0 ?>
                        @foreach($products as $product)


                        <tr>
                            <td class="text-center"><?= ++$i ?></td>
                            <td class="text-center">{{$product->name}}</td>
                            <td class="text-center">{{$product->price}}</td>
                            <td class="text-center">
                            @if ($product->status==1)
                                
                           
                                
                                <span class='badge badge-success'>
                                    avaliable                                 
                            </span>  @else
                            <span class='badge badge-warning'>
                                unavaliable                                 
                        </span>
                        @endif
  
                            </td>

                            <td class="text-center">
                                <img src="{{asset('storage/'.$product->image)}}" alt="" width="70" height="70">
                            </td>



                            <td>


                                <div class="btn-group" role="group" aria-label="Basic example">

                                    

                                    
                                    <a class="btn btn-sm btn-info ml-2 details_modal" 
                                    id='{{$product->id}}'  href="javascript:;" data-toggle="modal" data-target="#details_modal{{$product->id}}" title="Details">
                                        <i class="icon-eye"></i>
                                    
                                    </a>

                                 

                                    <a class="btn btn-sm btn-primary ml-2 " href='{{route('products.edit',['id'=>$product->id])}}' title="Update Product">
                                        <i class='fa fa-edit'></i>
                                    </a>


                                    <button type="submit" class="btn btn-sm btn-danger ml-2 " onclick="deleteItem({{ $product->id }})" title="Delete Product">
                                        <i class='fa fa-trash'></i>
                                    </button>
                                 
                                </div>


                            </td>

                        </tr>
                             <!-- Details Product  modal -->

                             <div class="modal fade" id="details_modal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" id="details_Pmodal{{$product->id}}">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Details Product</h5>
                                        </div>
                                        <div class="modal-body">
                                        <p>{{$product->details}} </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      </div>
                                
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                        @endforeach
                    </tbody>
                </table>












            </div>
        </div>
    </div>
</div>











                           


=

 




                                @endsection







                                @section("js")
                                <script src="{{asset('assets/vendor/jquery-validation/jquery.validate.js')}}"></script>

                                <!-- Jquery Validation Plugin Css -->
                                <!-- data table js -->
                                <script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
                                <script src="{{asset('assets/vendor/sweetalert/sweetalert.min.js')}}"></script>
                                <script src="{{asset('assets/js/pages/ui/dialogs.js')}}"></script>


                            
                                <script>
                                    function deleteItem(id) {

                                        var url = '{{URL::to("/products")}}';
                                        var m_url = url + "/delete/" + id;

                                        swal({
                                            title: "Are You Sure?",
                                            text: " ",
                                            type: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#dc3545",
                                            confirmButtonText: "Confirm",
                                            cancelButtonText: "Cancle",
                                            closeOnConfirm: false,
                                            closeOnCancel: true
                                        }, function(isConfirm) {
                                            if (isConfirm) {

                                                $.ajax({
                                                    async: false,
                                                    dataType: "json",
                                                    url: m_url,
                                                    type: 'GET',
                                                    success: function(data) {
                                                        //getAll();
                                                        if (data.msg == 'success') {
                                                            swal(" Delete !", "Deleted Done .", "success");
                                                            location.reload(true);
                                                        } else {
                                                            swal("Error!", "Sorry Can't Delete.", "error");

                                                        }

                                                    },
                                                    error: function(er) {
                                                        swal("Cancle", "Cancled.", "error");
                                                    }
                                                })



                                            } else {}
                                        });
                                    }
                                    
                                    
                                    
                                    
                                   
                                    
                                </script>

                                @endsection