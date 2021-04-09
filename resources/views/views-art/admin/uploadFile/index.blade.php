@extends('layouts.dashboard')



@section('file_upload','active')
@section("title")
{{trans('lang.file-up')}}
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


@if(auth::user()->isSuperAdmin()== true)
@section('btn')
<div class="col-md-6 col-sm-12 text-right">
    <a class="btn btn-sm btn-primary ml-2 mb-2" href='{{route("admin.UploadFile.create")}}' title="{{trans('lang.Add-design-file')}} ">
        <i class="icon-book-open mr-2"></i>{{trans('lang.Add-design-file')}}
    </a>




</div>

<br>


@endsection
@endif
@section('content')



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
                            
                            <th class="text-center">{{trans('lang.File-title')}} </th>

                            <th class="text-center">{{trans('lang.description')}}</th>
                            <th class="text-center"> {{trans('lang.design-file')}}</th>

                            <th width="13%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0 ?>

                        @foreach($file as $upload)

                        <tr>
                            <td class="text-center"><?= ++$i ?></td>
                              @if(App::getLocale()=='ar')
                            <td class="text-center"> {{ $upload->title_file}}</td>

                            <td class="text-center"> {{ $upload->description}}</td>
                            @else
                              <td class="text-center"> {{ $upload->title_file_en}}</td>

                            <td class="text-center"> {{ $upload->description_en}}</td>
                            
                          
                            @endif
                            <td class="text-center"> {{ $upload->original_name}}</td>


                            <td>


                                <div class="btn-group" role="group" aria-label="Basic example">


                                <a href="{{asset('storage/DesignFile/' . $upload->fileupload )}}"
                                       download="{{$upload->original_name}}">
                                        <button type="button" class="btn btn-sm btn-info ml-2">
                                            <i class="fa fa-download"></i>
                                        </button>
                                    </a>

@if(auth::user()->isSuperAdmin()== true)

                                    <a class="btn btn-sm btn-primary ml-2" href='{{route("admin.uploadfile.edit", [ "id" => $upload->id ])}}'>
                                        <i class='fa fa-edit'></i>
                                    </a>


                                    <button type="submit" class="btn btn-sm btn-danger ml-2 " onclick="deleteItem({{$upload->id }})"> <i class='fa fa-trash'></i></button>
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



@endsection





@section('js')
<script src="{{asset('assets/vendor/jquery-validation/jquery.validate.js')}}"></script>

<!-- Jquery Validation Plugin Css -->
<!-- data table js -->
<script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
<script src="{{asset('assets/vendor/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/js/pages/ui/dialogs.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>



<script>
    $(document).ready(function() {
var urlLang="";
 var lang='{{App::getLocale()}}';
                                        // alert(lang);
                      if(lang=='ar'){
                   urlLang="{{asset('assets/arabic.json')}}";
                       }

        


        var table = $('#m_table_1').DataTable({

            "language": {
                "url": urlLang,
            },

            "columnDefs": [{
                "targets": 4,
                "orderable": false
            }]
        });







    });
</script>


<script>
    function deleteItem(id) {

        var url = '{{URL::to("/admin/uploadfile")}}';
        var m_url = url + "/delete/"+ id;

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

</script>

@endsection
