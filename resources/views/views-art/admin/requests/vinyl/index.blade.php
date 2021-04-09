@extends('layouts.dashboard')
<meta name="csrf-token" content="{{ csrf_token() }}">



@section("title")
الفينيل
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
    <a class="btn btn-sm btn-primary ml-2 " href='#' data-toggle="modal" data-target="#addReqVinyl_modal" title="إضافة  فينيل ">
        <i class="fa fa-plus"></i> إضافة فينيل
    </a>
</div>

@endsection
@section('content')


<input type="hidden" class="req_id" id="req_id" name="req_id" value="{{$req_id}}">


<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover js-basic-example dataTable table-custom spacing8" id="vinyl_table">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>لون الفينيل</th>
                            <th>رمز الفينيل</th>
                            <th>نوع الفينيل </th>

                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0 ?>
                        @foreach($vinyl as $item)
                        <tr class="text-center">
                            <td><?= ++$i ?></td>
                            <td>{{$item->color_v}}</td>
                            <td>{{$item->code_v}}</td>
                            <td>{{$item->type_v}}</td>
                            <td>

                                <a class="btn  btn-sm btn-primary editVinyl" href='#' id="{{$item->id}}">
                                    <i class='fa fa-edit'></i>
                                </a>
                                <div class="btn-group" role="group" aria-label="Basic example">


                                    <button type="submit" class="btn btn-sm btn-danger ml-2" onclick="deleteItem({{$item->id}})"><i class='fa fa-trash'></i></button>

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
<div class="modal fade" id="addReqVinyl_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="basic-form"  novalidate enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">أضافة فينيل </h5>
                </div>
                <div class="modal-body">
                    <p class="text-success addTypeSuccess"></p>

                    @csrf
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="color_v" class="control-label">لون الفينيل</label>
                                <input value="{{old('color_v')}}" type="text" class="form-control " id="color_v" name="color_v" required>
                                <p class="text-danger error_color_v"></p>

                            </div>
                            <div class="form-group mb-4">
                                <label for="code_v" class="control-label">رمز الفينيل</label>
                                <input value="{{old('code_v')}}" type="text" class="form-control" id="code_v" name="code_v" required>
                                <p class="text-danger  error_code_v"></p>
                            </div>
                            <div class="form-group mb-4">
                                <label for="type_v" class="control-label">نوع الفينيل</label>
                                <input value="{{old('type_v')}}" type="text" class="form-control @if ($errors->has('type_v'))is-invalid @endif" id="type_v" name="type_v" required>
                                <p class="text-danger  error_type_v"></p>

                            </div>



                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary  add_all_vinyl"> إضافة</button>
                        <button type="button" class="btn btn-secondary  ml-2" data-dismiss="modal">إغلاق</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- End Modal -->





<!-- Edit vinyl  modal -->

<div class="modal fade" id="editVinyl_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="editVinylModal">


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


        var url = "{{URL::to('/')}}";


        var add_vinyl = function() {

            $('.add_all_vinyl').on("click", function() {

                // alert("hhhh");
                // alert(url+'/admin/requests/vinyl/store');

                var req_id = $('.req_id').val();
                var color_v = $('#color_v').val();

                var code_v = $('#code_v').val();

                var type_v = $('#type_v').val();




                $.ajax({
                    type: 'post',
                    url: "/admin/vinyl/store",

                    data: {
                        'color_v': color_v,
                        'code_v': code_v,
                        'type_v': type_v,
                        'req_id': req_id,


                    },

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function(response) {
                        toastr.success("تم إضافة البيانات بنجاح")

                                        document.getElementById("basic-form").reset();;

                        $('#addReqVinyl_modal').modal('hide');
                        getAll();

                    },

                    error: function(response) {
                        if (response.responseJSON.errors.color_v)
                            $('.error_color_v').text(response.responseJSON.errors.color_v);

                        if (response.responseJSON.errors.code_v)
                            $('.error_code_v').text(response.responseJSON.errors.code_v);


                        if (response.responseJSON.errors.type_v)
                            $('.error_type_v').text(response.responseJSON.errors.type_v);




                    }


                });
            });

        }

        add_vinyl();


        // Start Fetch Data vinyl
        $(document).on('click', '.editVinyl', function(e) {
            e.preventDefault();
            //alert("editType");
            var item_id = this.id;
            //  alert(item_id);

            current_location = $(this);

            $.ajax({
                url: '/admin/vinyl/edit/' + item_id,
                type: 'get',
                success: function(data) {
                    //alert(data);
                    // $("#editModal").replaceWith(data);
                    $("#editVinylModal").html(data);

                    $('#editVinyl_modal').modal('show');
                }
            });
        });
        // Start Fetch Data vinyl


        // Start Edit Data vinyl

        $(document).on('click', '.editVinyl_btn', function() {
            var id = $("#id").val();


            // alert("salam");
            // var id = $("#id").val();
            // alert(id);
            var data = $("#editVinyl_form").serialize();
            // alert(data);

            $.ajax({
                url: '/admin/vinyl/update/' + id,
                type: 'post',
                data: data,
                success: function(data) {
                    // console.log(data)
                    getAll();


                    $('#editVinyl_modal').modal('hide');
                    toastr.success("تم تعديل البينات بنجاح");

                },
                error: function(response) {
                    if (response.responseJSON.errors.color_v)
                        $('.color_v_error').text(response.responseJSON.errors.color_v);

                    if (response.responseJSON.errors.code_v)
                        $('.code_v_error').text(response.responseJSON.errors.code_v);


                    if (response.responseJSON.errors.type_v)
                        $('.type_v_erorr').text(response.responseJSON.errors.type_v);




                }
            });
        });
        // End Edit Data vinyl








    });

    // start Delete vinyl
    function deleteItem(id) {
        var url = '{{URL::to('/')}}';
        var m_url = url + "/admin/vinyl/delete/" + id;

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
        var req_id = $('.req_id').val();
        var url = '{{URL::to('/admin/')}}';
        var m_url = url +'/vinyl/getAll/'+ req_id;
        var count = 0;
        $('#vinyl_table').html("");

        $('#vinyl_table').DataTable({
            "language": {
                "url": "{{asset('assets/arabic.json')}}"
            },
            
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
                    "data": "color_v",
                    "sTitle": " لون الفينيل",
                    "sClass": "text-center"
                },
                {
                    "data": "code_v",
                    "sTitle": "رمز الفينيل",
                    "sClass": "text-center"
                },
                {
                    "data": "type_v",
                    "sTitle": "  نوع الفينيل	",
                    "sClass": "text-center"
                },

                {
                    "data": "",
                    sWidth: '10',
                    "Sortable": true,
                    "sClass": "text-center",
                    "mRender": function(data, type, full) {

                        return '<div class="btn-group" role="group" aria-label="Basic example"><a class="btn  btn-sm btn-primary editVinyl" href="#" id="' + full.id + '"> <i class="fa fa-edit"></i></a>' +
                            ' <button type="submit" class="btn btn-sm btn-danger ml-2" onclick="deleteItem( ' + full.id + ')"> <i class="fa fa-trash"></i></button></div>';


                    }

                },

            ]
            // "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {}

        });
    }

    //end get all vinyl
</script>



@endsection
