@extends('layouts.dashboard')

@section('all_requests','active')
@section("title") 


{{trans('lang.allreq')}}

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
@if(auth::user()->isSuperAdmin()== true)


@section('btn')

<div class="col-md-6 col-sm-12 text-right">
    <a class="btn btn-sm btn-primary ml-2 " href='#' data-toggle="modal" data-target="#addReuest_modal" title="{{trans('lang.add-req')}} ">
        <i class="fa fa-plus ml-2"></i> {{trans('lang.add-req')}}
    </a>
</div>




<br>


@endsection
@endif
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
                            <th class="text-center"> عنوان الطلبية </th>
                            <th class="text-center"> رقم التتبع </th>


                            <th width="13%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0 ?>
                        @foreach($all_requests as $req)


                        <tr>
                            <td class="text-center"><?= ++$i ?></td>
                            <td class="text-center">{{$req->name_request}}</td>

                            <td class="text-center">
                                {{$req->tracking_number}}
                                <!-- @if($req->type =='image/jpeg' ||$req->type=='image/png' ||$req->type=='image/jpg')
                                <a target="_blank" href="/storage/{{ $req->filePath }}">
                                    <img src="{{asset('storage/' . $req->filePath )}}" class="img" height="55" width="70">

                                </a>
                                @else
                                <a target="_blank" href="/storage/{{ $req->filePath }}">
                                    {{$req->original_name}}

                                </a>
                                @endif -->
                            </td>



                            <td>


                                <div class="btn-group" role="group" aria-label="Basic example">

                                    <a href="{{asset('storage/' . $req->filePath )}}" title="تحميل" download="{{ $req->filePath}}">
                                        <button type="button" class="btn btn-sm btn-info ml-2">
                                            <i class="fa fa-download"></i>
                                        </button>
                                    </a>

                                    @if(auth::user()->isSuperAdmin()== true)

                                    <span class='badge badge-success'>
                                        @if($req->isComplete ==1)
                                        تم تجهيز الطلب
                                        @endif
                                    </span>
                                    <a class="btn btn-sm bg-indigo ml-2" href='{{route("admin.requests.tshirt",["id"=> $req->id])}}' title=" إضافة تيشيرت">
                                        <i class='fa fa-suitcase'></i>
                                    </a>


                                    <a class="btn btn-sm bg-blush ml-2" href='{{route("admin.requests.vinyl", [ "id" => $req->id ])}}' title=" إضافة فينيل">
                                        <i class='fa fa-tasks'></i>
                                    </a>

                                    <a class="btn btn-sm btn-primary ml-2 editReq_modal" id='{{$req->id}}' href='#' title="تعديل الطلب">
                                        <i class='fa fa-edit'></i>
                                    </a>


                                    <button type="submit" class="btn btn-sm btn-danger ml-2 " onclick="deleteItem({{ $req->id }})" title="حذف الطلب">
                                        <i class='fa fa-trash'></i>
                                    </button>
                                    @else


                                    <button type="submit" class="btn btn-sm btn-danger ml-2 " onclick="deleteItem({{ $req->id }})" title="حذف الطلب">
                                        <i class='fa fa-trash'></i>
                                    </button>
                                    
                                    <a class="btn  btn-sm bg-blush    ml-2 reqTshirt" href="#" id='{{$req->id}}' data-toggle="tooltip" data-placement="bottom" title=" تيشيرتات الطلب ">
                                        <span class="sr-only">تيشيرتات الطلب</span>
                                        <i class="icon-briefcase"></i>
                                    </a>
                                    <a href="#" class=" btn btn-sm bg-warning ml-2 ReqVinyl" id='{{$req->id}}' data-toggle="tooltip" data-placement="bottom" title="فينيلات الطلب">
                                        <span class="sr-only"> فينيلات الطلب </span>
                                        <i class="icon-book-open"></i>
                                    </a>


                                    <label class="fancy-checkbox element-left ml-2">
                                        <input class="form-check-input" type="checkbox" name="complete" value="1" class="complete" onclick="ChangeStatusIsCompleted({{$req->id }})" id="complete" {{ old('isComplete', $req->isComplete)== 1 ? ' checked disabled' : ''  }} ">
                            <span>تجهيز الطلبية</span>
                        </label>
                                    @endif

                                </div>


                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>












            </div>
        </div>
    </div>
</div>







<!-- Add Req  modal -->
<div class=" modal fade" id="addReuest_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="POST" id="add_req_form" novalidate enctype="multipart/form-data">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"> {{trans('lang.add-req')}} </h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-success addTypeSuccess"></p>

                                                        @csrf
                                                        <div class="row clearfix">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="name_request" class="control-label">   {{trans('lang.name-req-ar')}}    </label>
                                                                    <input value="{{old('name_request')}}" type="text" class="form-control " id="name_request" name="name_request" required>
                                                                    <p class="text-danger error_name_request"></p>

                                                                </div>
                                                                
                                                                  <div class="form-group">
                                                                    <label for="name_request_en" class="control-label">   {{trans('lang.name-req-en')}}     </label>
                                                                    <input value="{{old('name_request_en')}}" type="text" class="form-control " id="name_request_en" name="name_request_en" required>
                                                                    <p class="text-danger error_name_request_en"></p>

                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="tracking_number" class="control-label">{{trans('lang.tracking-number')}}   </label>
                                                                    <input value="{{old('tracking_number')}}" type="text" class="form-control " id="tracking_number" name="tracking_number" required>
                                                                    <p class="text-danger error_tracking_number"></p>

                                                                </div>
                                                                 <div class="form-group">
                                                                    <label for="request_number" class="control-label">{{trans('lang.request_number')}}   </label>
                                                                    <input value="{{old('request_number')}}" type="text" class="form-control " id="request_number" name="request_number" required>
                                                                    <p class="text-danger error_request_number"></p>

                                                                </div>
                                                                	

                                                                <div class="form-group">

                                                                    <label class="control-label"> {{trans('lang.Photo')}} </label>
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="m-dropzone dropzone dz-clickable" action="{{ route('uploads.requests.file') }}" id="m-dropzone-one" class="dropzone">

                                                                            {{ csrf_field() }}
                                                                            <div class="m-dropzone__msg dz-message needsclick">
                                                                                <h3 class="m-dropzone__msg-title">  {{trans('lang.drag-file')}} </h3>

                                                                                <span class="m-dropzone__msg-desc"> {{trans('lang.drag-click')}}   </span>
                                                                            </div>
                                                                        </div>
                                                                        <input type="hidden" title="image" class="form-control custom-file-input " id="filePath" name="filePath">
                                                                        <input type="hidden" title="orignal_name" class="form-control custom-file-input " id="orignal_name" name="orignal_name">
                                                                        <input type="hidden" title="type_file" class="form-control custom-file-input " id="type_file" name="type_file">


                                                                        <p class="text-danger error_filePath"></p>

                                                                    </div>



                                                                </div>




                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary  add_requests"> {{trans('lang.Add')}}</button>
                                                            <button type="button" class="btn btn-secondary  ml-2" data-dismiss="modal">  {{trans('lang.Close')}} </button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                </div>
                                <!-- End Modal -->





                                <!-- Edit Req  modal -->

                                <div class="modal fade" id="editReq_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content" id="editReqModal">


                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->



                                <!-- Tshirt Requests modal -->

                                <div class="modal fade" id="TshirtRequests_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-mm">
                                        <div class="modal-content" id="TshirtRequestsModal">


                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->




                                <!-- Vinyl Requests modal -->

                                <div class="modal fade" id="VinylRequests_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content" id="VinylRequestsModal">


                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->







                                @endsection







                                @section("js")
                                <script src="{{asset('assets/vendor/jquery-validation/jquery.validate.js')}}"></script>

                                <!-- Jquery Validation Plugin Css -->
                                <!-- data table js -->
                                <script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
                                <script src="{{asset('assets/vendor/sweetalert/sweetalert.min.js')}}"></script>
                                <script src="{{asset('assets/js/pages/ui/dialogs.js')}}"></script>


                                <script>
                                    $(document).ready(function() {


                                        getAll();


                                        // var table = $('#m_table_1').DataTable({

                                        //     "language": {
                                        //         "url": "{{asset('assets/arabic.json')}}"
                                        //     },

                                        //     "columnDefs": [{
                                        //         "targets": 3,
                                        //         "orderable": false
                                        //     }]
                                        // });


                                        var add_requests = function() {


                                            $('.add_requests').on("click", function() {
                                                let form = $(this).closest("form");



                                                var name_request = $('#name_request').val();
                                                var name_request_en = $('#name_request_en').val();
                                                
                                                var tracking_number = $('#tracking_number').val(); // alert(name_request);
                                                var request_number= $('#request_number').val(); 
                                                var filePath = $('#filePath').val();
                                                var orignal_name = $('#orignal_name').val();
                                                var type_file = $('#type_file').val();
                                                // alert(orignal_name);




                                                $.ajax({
                                                    type: 'post',
                                                    url: "/admin/requests/store",

                                                    data: {
                                                        'name_request': name_request,
                                                        'name_request_en':name_request_en,
                                                        'filePath': filePath,
                                                        'orignal_name': orignal_name,
                                                        'type': type_file,
                                                        'tracking_number': tracking_number,
                                                        'request_number':request_number


                                                    },

                                                    headers: {
                                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                    },

                                                    success: function(response) {
                                                        var msg=""
                                                      
                                                     var lang='{{App::getLocale()}}';
                                                                        // alert(lang);
                                                      if(lang=='ar'){
                                                          
                                                         msg="  ! تم إضافة البيانات بنجاح";  
                                                           
                                                       }else
                                                       {
                                                          msg='Added successfully !';
                                
                                                       }
                                                        toastr.success(msg);                                                        // document.getElementById("add_req_form").reset();
                                                        // $('#m-dropzone-one').empty();


                                                        document.getElementById("add_req_form").reset();

                                                        $('#orignal_name').val('');
                                                        $('#filePath').val('');
                                                        $('#type_file').val('');




                                                        // , $("#add_req_form").validate().resetForm();
                                                        // $('#m-dropzone-one').empty();
                                                        //    $('#m-dropzone-one').empty();

                                                        // $("#add_req_form").trigger('reset'); 



                                                        $('#addReuest_modal').modal('hide');
                                                        getAll();

                                                    },

                                                    error: function(response) {
                                                        if (response.responseJSON.errors.name_request)
                                                            $('.error_name_request').text(response.responseJSON.errors.name_request);
                                                        
                                                         if (response.responseJSON.errors.name_request_en)
                                                            $('.error_name_request_en').text(response.responseJSON.errors.name_request_en);




                                                        if (response.responseJSON.errors.filePath)
                                                            $('.error_filePath').text(response.responseJSON.errors.filePath);


                                                        if (response.responseJSON.errors.tracking_number)
                                                            $('.error_tracking_number').text(response.responseJSON.errors.tracking_number);


                                                        if (response.responseJSON.errors.tracking_number)
                                                            $('.error_request_number').text(response.responseJSON.errors.tracking_number);




                                                    }


                                                });
                                            });

                                        }

                                        add_requests();

                                        // Start Fetch Data Requests
                                        $(document).on('click', '.editReq_modal', function(e) {
                                            e.preventDefault();
                                            //alert("editType");
                                            var item_id = this.id;
                                            //  alert(item_id);

                                            current_location = $(this);

                                            $.ajax({
                                                url: '/admin/requests/edit/' + item_id,
                                                type: 'get',
                                                success: function(data) {
                                                    //alert(data);
                                                    // $("#editModal").replaceWith(data);
                                                    $("#editReqModal").html(data);

                                                    $('#editReq_modal').modal('show');
                                                }
                                            });
                                        });
                                        // Start Fetch Data Requests


                                        // Start Edit Data Requests

                                        $(document).on('click', '.edit_requests_btn', function() {
                                            var id = $("#id").val();

                                            var name_request = $("input[name='name_requests']").val();
                                            var name_request_en=$('#name_requests_en').val();
                                            var tracking_number = $('#tracking_numbers').val();
                                            var request_number=$('#request_numbers').val();

                                            //   alert(name_request);
                                            var filePath = $('#filePaths').val();
                                            var orignal_name = $('#orignal_names').val();
                                            var type_file = $('#type_files').val();

                                            // alert(data);

                                            $.ajax({
                                                url: '/admin/requests/update/' + id,
                                                type: 'post',
                                                data: {
                                                    'name_request': name_request,
                                                    'name_request_en':name_request_en,
                                                    'filePath': filePath,
                                                    'orignal_name': orignal_name,
                                                    'type': type_file,
                                                    'id': id,
                                                    'tracking_number': tracking_number,
                                                    'request_number':request_number
                                                },
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                success: function(data) {
                                                    // console.log(data)
                                                      getAll();
                                                      var msg=""
                                                      
                                                      var lang='{{App::getLocale()}}';
                                                                        // alert(lang);
                                                      if(lang=='ar'){
                                                       msg="تم تعديل البيانات بنجاح !";
                                                       }else{
                                                          msg='Edited successfully !';
                                
                                                           
                                                           
                                                       }
                                                        toastr.success(msg);
                                                    

                                                    $('#editReq_modal').modal('hide');

                                                },
                                                error: function(response) {
                                                    if (response.responseJSON.errors.name_request)
                                                        $('.error_name_requests').text(response.responseJSON.errors.name_request);
                                                        
                                                          if (response.responseJSON.errors.name_request_en)
                                                        $('.error_name_requests_en').text(response.responseJSON.errors.name_request_en);




                                                    if (response.responseJSON.errors.filePath)
                                                        $('.error_filePaths').text(response.responseJSON.errors.filePath);

                                                    if (response.responseJSON.errors.tracking_number)
                                                        $('.error_tracking_numbers').text(response.responseJSON.errors.tracking_number);
                                                        
                                                        
                                                    if (response.responseJSON.errors.tracking_number)
                                                        $('.error_request_numbers').text(response.responseJSON.errors.tracking_number);


                                                }
                                            });
                                        });
                                        // End Edit Data Req



                                        // Start Fetch Data Tshirt Requests
                                        $(document).on('click', '.reqTshirt', function(e) {
                                            e.preventDefault();
                                            //alert("editType");
                                            var item_id = this.id;
                                            // alert(item_id);

                                            current_location = $(this);

                                            $.ajax({

                                                url: '/admin/requests/details/tshirtRequests/' + item_id,
                                                type: 'get',
                                                success: function(data) {

                                                    $("#TshirtRequestsModal").html(data);

                                                    $('#TshirtRequests_modal').modal('show');
                                                }
                                            });
                                        });
                                        // End Fetch Data User Maintenance Requests

                                        // Start Fetch Data Tshirt Requests
                                        $(document).on('click', '.ReqVinyl', function(e) {
                                            e.preventDefault();
                                            //alert("editType");
                                            var item_id = this.id;
                                            // alert(item_id);

                                            current_location = $(this);

                                            $.ajax({

                                                url: '/admin/requests/details/vinylRequests/' + item_id,
                                                type: 'get',
                                                success: function(data) {

                                                    $("#VinylRequestsModal").html(data);

                                                    $('#VinylRequests_modal').modal('show');
                                                }
                                            });
                                        });
                                        // End Fetch Data User Maintenance Requests




                                    });
                                </script>
                                <script>
                                    function deleteItem(id) {

                                        var url = '{{URL::to("/admin/requests")}}';
                                        var m_url = url + "/delete/" + id;

                                        swal({
                                            title: "هل أنت متأكد  ؟",
                                            text: " ",
                                            type: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#dc3545",
                                            confirmButtonText: "تأكيد",
                                            cancelButtonText: "إلغاء",
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
                                                            swal(" حذف !", "تم الحذف بنجاح", "success");
                                                            location.reload(true);
                                                        } else {
                                                            swal("خطأ !", "يرجى مراجعة الإدارة", "error");

                                                        }

                                                    },
                                                    error: function(er) {
                                                        swal("إلغاء", "يرجى مراجعة الإدارة", "error");
                                                    }
                                                })



                                            } else {}
                                        });
                                    }
                                    
                                    
                                    
                                    
                                    var superAdmin = "{{auth::user()->isSuperAdmin()}}";
                                    // alert(superAdmin);
                                    var url_vinyl = "{{URL::to('/admin/vinyl/')}}";
                                    var url_tshirt = "{{URL::to('/admin/tshirt/')}}";


                                    function getAll() {
                                        var urlLang="";
                                        var url = "{{URL::to('/')}}";
                                        var m_url = url + '/admin/requests/getAll';
                                        // alert(m_url);
                                        var count = 0;
                                        $('#m_table_1').html("");
                                        
                                        var lang='{{App::getLocale()}}';
                                        // alert(lang);
                                        if(lang=='ar'){
                                            urlLang="{{asset('assets/arabic.json')}}";
                                        }

                                        $('#m_table_1').DataTable({
                                            "language": {
                                                "url": urlLang,
                                            },

                                       "columnDefs": [{
                                                "targets": 3,
                                                "orderable": false
                                            }],


                                            destroy: true,
                                            "ajax": {
                                                url: m_url,
                                                type: 'GET',
                                                dataSrc: '',
                                                "data": function() {}
                                            },
                                            "columns": [
                                                
                                                
                                                { "data": "",
                                                    "sTitle": "#",
                                                    "sClass": "text-center",
                                                    "mRender": function(data, type, full) {

                                                        return ++count;

                                                    }
                                                },
                                                
                                                
                                                {
                                                    "data": "request_number",
                                                    "sTitle": "{{trans('lang.request_number')}}",
                                                    "sClass": "text-center",
                                                    // "mRender": function(data, type, full) {

                                                    //     return ++count;

                                                    // }
                                                },
                                                
                                                {
                                                    "data":(lang) == 'ar' ? 'name_request' : 'name_request_en',
                                                    "sTitle": "{{trans('lang.title-req')}}",
                                                    "sClass": "text-center"
                                                },
                                                {


                                                    "data": "tracking_number",
                                                    "sTitle": "{{trans('lang.tracking-number')}}",
                                                    "sClass": "text-center"

                                                },
                                                // {
                                                //     "data": "filePath",
                                                //     "sTitle": "صورة /ملف الطلبية",
                                                //     "sClass": "text-center",
                                                //     "mRender": function(data, type, full) {

                                                //         return (full.type == 'image/jpeg' || full.type == 'image/png' || full.type == 'image/jpg') ? '<a target="_blank" href="/storage/' + full.filePath + ' ">' +
                                                //             '<img src="/storage/' + full.filePath + '" class="img" height="55" width="70"></a>' :
                                                //             '<a target="_blank" href="/storage/' + full.filePath + '" >' +
                                                //             full.original_name

                                                //         '</a>';

                                                //     }
                                                // },


                                                {
                                                    "data": "",
                                                    "sWidth": '10',
                                                    "Sortable": true,
                                                    "sClass": "text-center",
                                                    "mRender": function(data, type, full) {

                                                        var checked = (full.isComplete) == 1 ? 'checked ' : '';
                                                        var complete = (full.isComplete) == 1 ? '{{trans("lang.complete")}}' : '';
                                                        var unComplete = (full.isComplete) == 0 ? '{{trans("lang.not-ready")}}' : '';
                                                        
                                                        
                                                          var Shipping_checked = (full.shipping_completed) == 1 ? 'checked ' : '';
                                                        var shipping_complete = (full.shipping_completed) == 1 ? '{{trans("lang.Shipping_complete")}}' : '';
                                                        var unComplete_Shipping = (full.shipping_completed) == 0 ? '{{trans("lang.not-ready_Shipping")}}' : '';
                                                        
                                                      
                                                        

                                                        //    var checked=(full.isComplete==1);
                                                    //  var Download={{trans('lang.Download')}};
                                                    //  alert(Download);


                                                        return (superAdmin == 1) ?
                                                            '<div class="btn-group" role="group" aria-label="Basic example">' +
                                                            '<span class="badge badge-success">' + complete + '</span>' +
                                                            '<span class="badge badge-danger">' + unComplete + '</span>' +
                                                            
                                                             '<span class="badge badge-success">' + shipping_complete + '</span>' +
                                                            '<span class="badge badge-danger">' + unComplete_Shipping + '</span>' +

                                                            '<a href="/storage/' + full.filePath + '" title="{{trans('lang.Download')}}" download="' + full.filePath + '">' +

                                                            '<button type="button" class="btn btn-sm btn-info ml-2">' +
                                                            '<i class="fa fa-download"></i></button> </a>' +

                                                            '<a class="btn btn-sm bg-indigo ml-2" href="' + url_tshirt + '/' + full.id + '" title="{{trans('lang.Add-tichart')}}">' +
                                                            '<i class="fa fa-suitcase"></i></a>' +

                                                            '<a class="btn btn-sm bg-blush ml-2" href="' + url_vinyl + '/' + full.id + '" title="{{trans('lang.Add-Vinyl')}} ">' +
                                                            '<i class="fa fa-tasks"></i> </a>' +

                                                            '<a class="btn btn-sm btn-primary ml-2 editReq_modal" id="' + full.id + ' " href="#" title="{{trans('lang.Editing-req')}}">' +
                                                            '<i class="fa fa-edit"></i></a>' +


                                                            '<button type="submit" class="btn btn-sm btn-danger ml-2 " onclick="deleteItem(' + full.id + ')" title="{{trans('lang.Delete-req')}}" > ' +
                                                            '<i class="fa fa-trash"></i> </button></div> ' :
                                                            '<div class="btn-group" role="group" aria-label="Basic example">' +

                                                            '<a href="/storage/' + full.filePath + '" title="{{trans('lang.Download')}}" download="' + full.filePath + '">' +

                                                            '<button type="button" class="btn btn-sm btn-info ml-2">' +
                                                            '<i class="fa fa-download"></i></button> </a>' +
                                                            '<a class="btn  btn-sm bg-blush    ml-2 reqTshirt" href="#" id=' + full.id + ' data-toggle="tooltip" data-placement="bottom" title="{{trans('lang.T-shirt')}}  ">' +
                                                            '<span class="sr-only">تيشيرتات الطلب</span> <i class="icon-briefcase"></i></a>' +


                                                            '<a href="#" class=" btn btn-sm bg-warning ml-2 ReqVinyl" id=' + full.id + ' data-toggle="tooltip" data-placement="bottom" title="فينيلات الطلب">' +
                                                            '<span class="sr-only"> فينيلات الطلب </span> <i class="icon-book-open"></i> </a>' +

                                                             '<button type="submit" class="btn btn-sm btn-danger ml-2 " onclick="deleteItem(' + full.id + ')" title="{{trans('lang.Delete-req')}}" > ' +
                                                            '<i class="fa fa-trash"></i> </button></div> '+

                                                            '<label class="fancy-checkbox element-left ml-2">' +
                                                            '<input class="form-check-input" type="checkbox" name="complete" value="1" class="complete"   ' + checked + '  onclick="ChangeStatusIsCompleted(' + full.id + ')" id="complete"   >' +
                                                            '<span>{{trans("lang.complete-req")}}</span></label>'+
                                                            
                                                            '<label class="fancy-checkbox element-left ml-2">' +
                                                            '<input class="form-check-input" type="checkbox" name="Shipping_complete" value="1" class="Shipping_complete"   ' + Shipping_checked + '  onclick="ChangeStatusShippingCompleted(' + full.id + ')" id="Shipping_complete"   >' +
                                                            '<span>{{trans("lang.Shipping_complete-req")}}</span></label>';






                                                    }

                                                },

                                            ]
                                            // "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {}

                                        });
                                    }


                                    function ChangeStatusIsCompleted(id) {
                                        var req_id = id;

                                        // alert(req_id)
                                        var isComplete = $('#complete').val();
                                        // alert(isComplete);
                                        var url = '{{URL::to('/')}}';
                                        var m_url = url + "/admin/requests/ChangeStatusIsCompleted/" + req_id;


                                        $.ajax({
                                            async: false,
                                            dataType: "json",
                                            url: m_url,
                                            type: 'GET',
                                            success: function(data) {
                                                // getAll();

                                            },

                                        })
                                    }
                                    
                                    
                                       function ChangeStatusShippingCompleted(id) {
                                        var req_id = id;

                                        // alert(req_id)
                                        var ShippingComplete = $('#Shipping_complete').val();
                                        // alert(isComplete);
                                        var url = '{{URL::to('/')}}';
                                        var m_url = url + "/admin/requests/ChangeStatusShippingCompleted/" + req_id;


                                        $.ajax({
                                            async: false,
                                            dataType: "json",
                                            url: m_url,
                                            type: 'GET',
                                            success: function(data) {
                                                // getAll();

                                            },

                                        })
                                    }
                                    
                                    
                                    
                                </script>

                                @endsection