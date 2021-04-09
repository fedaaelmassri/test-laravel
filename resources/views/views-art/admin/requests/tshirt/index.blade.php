@extends('layouts.dashboard')
<meta name="csrf-token" content="{{ csrf_token() }}">



@section("title")
{{trans('lang.T-shirt')}}
@endsection
@section('css')


<link rel="stylesheet" href="{{asset('assets/vendor/sweetalert/sweetalert.css')}}" />
<link href="{{ asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}" rel="stylesheet">
<style>
    h6 {
        color: #8ec449;
        font-weight: 400 !important;
    }
</style>

@endsection


@section('btn')

<div class="col-md-6 col-sm-12 text-right">
    <a class="btn btn-sm btn-primary ml-2 " href='#' data-toggle="modal" data-target="#addReqTshirt_modal" title="{{trans('lang.Add-Tshirt')}} ">
        <i class="fa fa-plus"></i> {{trans('lang.Add-Tshirt')}}
    </a>
</div>

@endsection
@section('content')


<input type="hidden" class="req_id" id="req_id" name="req_id" value="{{$req_id}}">


<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover js-basic-example dataTable table-custom spacing8" id="tshirt_table">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>صورة المنتج </th>
                            <th> المقاس </th>
                            <th> لون التيشرت</th>
                            <th>عدد </th>

                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0 ?>
                        @foreach($tshirt as $req)
                        <tr class="text-center">
                            <td><?= ++$i ?></td>
                            <td class="text-center"><a target="_blank" href="/storage/{{ $req->image }}">
                                    <img src="{{asset('storage/' . $req->image )}}" class="img" height="55" width="70">

                                </a>
                            </td>

                            <td class="text-center">{{$req->size}}</td>
                            <td class="text-center">{{$req->color_t}}</td>
                            <td class="text-center">{{$req->count_t}}</td>
                            <td>

                                <a class="btn  btn-sm btn-primary editReqTshirt_modal" href='#' id="{{$req->id}}">
                                    <i class='fa fa-edit'></i>
                                </a>
                                <div class="btn-group" role="group" aria-label="Basic example">


                                    <button type="submit" class="btn btn-sm btn-danger ml-2" onclick="deleteItem({{$req->id}})"><i class='fa fa-trash'></i></button>

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

<br>






@endsection
<!-- Add vinyl  modal -->
<div class="modal fade" id="addReqTshirt_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="basic-form" novalidate enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">{{trans('lang.Add-Tshirt')}} </h5>
                </div>
                <div class="modal-body">

                    @csrf
                    <div class="row clearfix">
                        <div class="col-md-12">

                            <div class="form-group ">
                                <label for="color_t" class="control-label">{{trans('lang.Color-tshirt')}}  </label>
                                <input value="{{old('color_t')}}" type="text" class="form-control" id="color_t" name="color_t" required>

                                <p class="text-danger errors_color_t"></p>

                            </div>
                            
                              <div class="form-group ">
                                <label for="color_t_en" class="control-label">{{trans('lang.Color-tshirt-en')}}  </label>
                                <input value="{{old('color_t_en')}}" type="text" class="form-control" id="color_t_en" name="color_t_en" required>

                                <p class="text-danger errors_color_t_en"></p>

                            </div>


                            <div class="form-group">
                                <label for="size" class="control-label">{{trans('lang.Size')}}  </label>
                                <select class="form-control @if ($errors->has('size'))is-invalid @endif size" id="size" name="size" required>
                                    <option value="">{{trans('lang.choose-size')}}</option>
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
                                <p class="text-danger errors_size"></p>

                            </div>


                            <div class="form-group">
                                <label for="count_t" class="control-label">{{trans('lang.Number')}}  </label>
                                <input value="{{old('count_t')}}" type="text" class="form-control" id="count_t" name="count_t" required>

                                <p class="text-danger errors_count_t"></p>

                            </div>


                            <div class="form-group">

                                <label class="control-label">{{trans('lang.Product-mage')}}   </label>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="m-dropzone dropzone dz-clickable" action="{{ route('uploads.requests.file') }}" id="m-dropzone-Tishirt" class="dropzone">

                                        {{ csrf_field() }}
                                        <div class="m-dropzone__msg dz-message needsclick">
                                           <h3 class="m-dropzone__msg-title">  {{trans('lang.drag-file')}} </h3>

                                    <span class="m-dropzone__msg-desc"> {{trans('lang.drag-click')}}   </span>
                                        </div>
                                    </div>
                                    <input type="hidden" title="image_t" class="form-control custom-file-input " id="image" name="image">



                                    <p class="text-danger errors_image"></p>

                                </div>



                            </div>


                        </div>

                        <div class="modal-footer">
                          
                              <button type="button" class="btn btn-primary  add_tshirt"> {{trans('lang.Add')}}</button>
                             <button type="button" class="btn btn-secondary  ml-2" data-dismiss="modal">  {{trans('lang.Close')}} </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- End Modal -->


<!-- Edit vinyl  modal -->

<div class="modal fade" id="editReqTshirt_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="editReqTshirtModal">


        </div>
    </div>
</div>
<!-- End Modal -->



@section('js')

<script src="{{asset('assets/vendor/jquery-validation/jquery.validate.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.0.6/parsley.min.js"></script>

<script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
<script src="{{asset('assets/vendor/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/js/pages/ui/dialogs.js')}}"></script>


<script>
    $(function() {
        $('#basic-form').parsley();
    });
</script>

<script>
    $(document).ready(function() {


        getAll();
        // $('#tshirt_table').DataTable({
        //     "language": {
        //         "url": "{{asset('assets/arabic.json')}}"
        //     },
            
        //     "columnDefs": [{
        //         "targets": 4,
        //         "orderable": false
        //     }]
        // });


        var url = "{{URL::to('/')}}";


        var add_tshirt = function() {

            $('.add_tshirt').on("click", function() {

                // alert("hhhh");
                // alert(url+'/admin/requests/vinyl/store');

                var req_id = $('.req_id').val();
                var color_t = $('#color_t').val();
                var color_t_en = $('#color_t_en').val();
                

                var size = $('#size').val();

                var image = $('#image').val();
                var count_t = $('#count_t').val();



                $.ajax({
                    type: 'post',
                    url: "/admin/tshirt/store",

                    data: {
                        'color_t': color_t,
                        'color_t_en':color_t_en,
                        'size': size,
                        'image': image,
                        'count_t':count_t,
                        'req_id': req_id,


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
                        toastr.success(msg);
                                              $('#image').val('');
                                                       
                                        document.getElementById("basic-form").reset();

                        $('#addReqTshirt_modal').modal('hide');
                        getAll();

                    },

                    error: function(response) {
                        if (response.responseJSON.errors.color_t)
                            $('.errors_color_t').text(response.responseJSON.errors.color_t);
                            
                             if (response.responseJSON.errors.color_t_en)
                            $('.errors_color_t_en').text(response.responseJSON.errors.color_t_en);

                        if (response.responseJSON.errors.size)
                            $('.errors_size').text(response.responseJSON.errors.size);


                        if (response.responseJSON.errors.count_t)
                            $('.errors_count_t').text(response.responseJSON.errors.count_t);

                            if (response.responseJSON.errors.image)
                            $('.errors_image').text(response.responseJSON.errors.image);




                    }


                });
            });

        }

        add_tshirt();


        // Start Fetch Data vinyl
        $(document).on('click', '.editReqTshirt_modal', function(e) {
            e.preventDefault();
            //alert("editType");
            var item_id = this.id;
            //  alert(item_id);

            current_location = $(this);

            $.ajax({
                url: '/admin/tshirt/edit/' + item_id,
                type: 'get',
                success: function(data) {
                    //alert(data);
                    // $("#editModal").replaceWith(data);
                    $("#editReqTshirtModal").html(data);

                    $('#editReqTshirt_modal').modal('show');
                }
            });
        });
        // Start Fetch Data vinyl


        // Start Edit Data vinyl

        $(document).on('click', '.editTshirt_btn', function() {
            var id = $("#id").val();


                var color_t = $('#colors_t').val();
                    var color_t_en = $('#colors_t_en').val();
                

                var size = $('#sizes').val();

                var image = $('#images').val();
                var count_t = $('#counts_t').val();
          

            $.ajax({
                url: '/admin/tshirt/update/' + id,
                type: 'post',
                data: { 
                     'color_t': color_t,
                     'color_t_en':color_t_en,
                        'size': size,
                        'image': image,
                        'count_t':count_t,
                        'id': id,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                success: function(data) {
                    // console.log(data)
                    getAll();


                    $('#editReqTshirt_modal').modal('hide');
                    
                    
                       var msg=""
                      
                      var lang='{{App::getLocale()}}';
                                        // alert(lang);
                      if(lang=='ar'){
                       msg="تم تعديل البيانات بنجاح !";
                       }else{
                          msg='Edited successfully !';

                           
                           
                       }
                        toastr.success(msg);
                    
                 

                },
                error: function(response) {
                        if (response.responseJSON.errors.color_t)
                            $('.error_color_t').text(response.responseJSON.errors.color_t);
                       
                        if (response.responseJSON.errors.color_t_en)
                            $('.error_color_t_en').text(response.responseJSON.errors.color_t_en);



                        if (response.responseJSON.errors.size)
                            $('.error_size').text(response.responseJSON.errors.size);


                        if (response.responseJSON.errors.count_t)
                            $('.error_count_t').text(response.responseJSON.errors.count_t);

                            if (response.responseJSON.errors.image)
                            $('.error_image').text(response.responseJSON.errors.image);




                    }

            });
        });
        // End Edit Data vinyl








    });

    // start Delete vinyl
    function deleteItem(id) {
        var url = "{{URL::to('/')}}";
        var m_url = url + "/admin/tshirt/delete/" + id;

        // alert(m_url);

        swal({
            title: "هل أنت متأكد  ؟",
            text: " ",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            confirmButtonText: "تأكيد !",
            cancelButtonText: "إلغاء !",
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

    //end Delete vinyl

    //start get all vinyl
    function getAll() {
        var urlLang="";
        var req_id = $('.req_id').val();
        var url = '{{URL::to('/admin/')}}';
        var m_url = url + '/tshirt/getAll/' + req_id;
        var count = 0;
        $('#tshirt_table').html("");
        
          var lang='{{App::getLocale()}}';
                                        // alert(lang);
                      if(lang=='ar'){
                   urlLang="{{asset('assets/arabic.json')}}";
                       }

        

        $('#tshirt_table').DataTable({
            "language": {
                "url":urlLang,
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
            "columns": [{
                    "data": "",
                    "sTitle": "#",
                    "sClass": "text-center",
                    "mRender": function(data, type, full) {

                        return ++count;

                    }
                },
                {
                    "data": "image",
                    "sTitle":"{{trans('lang.Product-mage')}}",
                    "sClass":"text-center",
                    "mRender": function(data, type, full) {

return '<a target="_blank" href="/storage/' + full.image + ' ">' +
    '<img src="/storage/' + full.image + '" class="img" height="55" width="70">' +

    '</a>';

}




             },
                {
                    "data": "size",
                    "sTitle": "{{trans('lang.Size')}}",
                    "sClass": "text-center"
                },
                {
                    "data":  (lang) == 'ar' ? 'color_t' : 'color_t_en',
                    "sTitle": "{{trans('lang.Color')}}",
                    "sClass": "text-center"
                },
                {
                    "data": "count_t",
                    "sTitle": "{{trans('lang.Number')}}",
                    "sClass": "text-center"
                },

                {
                    "data": "",
                    sWidth: '10',
                    "Sortable": true,
                    "sClass": "text-center",
                    "mRender": function(data, type, full) {

                        return '<div class="btn-group" role="group" aria-label="Basic example"><a class="btn  btn-sm btn-primary editReqTshirt_modal" href="#" id="' + full.id + '"> <i class="fa fa-edit"></i></a>' +
                            ' <button type="submit" class="btn btn-sm btn-danger ml-2" onclick="deleteItem( ' + full.id + ')"> <i class="fa fa-trash"></i></button></div>';


                    }

                },

            ]
            // "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {}

        });
    }

    //end get all vinyl
</script>


            
<script>
   var url = "{{URL::to('/')}}";

new Dropzone("#m-dropzone-Tishirt", {
                paramName:"file",
                maxFiles:1,
                maxFilesize:5,
                addRemoveLinks:!0,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                accept:function(e, o) {
                    "justinbieber.jpg"==e.name?o("Naha, you don't."): o()
                },
                sending: function(file, xhr, formData) {

                    formData.append("_token", $("input[name='_token']").val());
                },
                success:function (file , response) {
                    // alert(response);
                    var ffile_id = $(file.previewElement).parent().parent().find($("input[title='image_t']"));
                    ffile_id.val(response.success)
                    // var input = '<input type="hidden" name="file'+ffile_id+'" title="reqName" value="'+response+'">';
                    // var asss = file.previewElement;

                    
              
                    console.log(ffile_id);

                    console.log(response);
                    // let curr = $(this).find('.dz-preview');
                    // console.log($(this).find(asss))
                    // $(file.previewElement).append(input);
                },
                removedfile:function (file , response) {
                    // var name = $(file.previewElement).find("input[title='reqName']").val();
                    console.log(name);
                    $.ajax({
                        url:url+'/deleteFile',
                        data: {name: name},
                        type: 'get',
                        success: function (data) {
                            console.log(data);
                            $(file.previewElement).parent().parent().find($("input[name='filePaths']")).val('')
                            $(file.previewElement).remove()

                       
                        }

                    });
                }

            }

);
</script>


@endsection