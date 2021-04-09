<form method="POST" id="editReq_form" novalidate enctype="multipart/form-data">
    <div class="modal-header">
        <h5 class="modal-title"> {{trans('lang.Editing-req')}} </h5>
    </div>
    <div class="modal-body">
        <p class="text-success addTypeSuccess"></p>
        @csrf
        <input type="hidden" id="id" name="id" value="{{$item->id}}" />

        <div class="row clearfix">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="name_requests" class="control-label"> {{trans('lang.name-req-ar')}}   </label>
                    <input value="{{old('name_request',$item->name_request)}}" type="text" class="form-control " id="name_requests" name="name_requests" required>
                    <p class="text-danger error_name_requests"></p>

                </div>
                
                 <div class="form-group">
                    <label for="name_requests_en" class="control-label">{{trans('lang.name-req-en')}}   </label>
                    <input value="{{old('name_request',$item->name_request_en)}}" type="text" class="form-control " id="name_requests_en" name="name_requests_en" required>
                    <p class="text-danger error_name_requests_en"></p>

                </div>


                <div class="form-group">
                    <label for="tracking_numbers" class="control-label"> {{trans('lang.tracking-number')}}  </label>
                    <input value="{{old('tracking_number',$item->tracking_number)}}" type="text" class="form-control " id="tracking_numbers" name="tracking_numbers" required>
                    <p class="text-danger error_tracking_numbers"></p>

                </div>
                
                  <div class="form-group">
                    <label for="request_numbers" class="control-label"> {{trans('lang.request_number')}}  </label>
                    <input value="{{old('request_number',$item->request_number)}}" type="text" class="form-control " id="request_numbers" name="request_numbers" required>
                    <p class="text-danger error_request_numbers"></p>

                </div>
                


                <div class="col-lg-12 col-md-12 mt-2">
                    <div class="form-group">

                       <label class="control-label"> {{trans('lang.Photo')}} </label>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="m-dropzone dropzone dz-clickable" action="{{ route('uploads.requests.file') }}" id="m-dropzone-one-update" class="dropzone">

                                {{ csrf_field() }}
                                <div class="m-dropzone__msg dz-message needsclick">
                                       <h3 class="m-dropzone__msg-title">  {{trans('lang.drag-file')}} </h3>

                                       <span class="m-dropzone__msg-desc"> {{trans('lang.drag-click')}}   </span>span>
                                </div>
                            </div>
                            <input type="hidden" title="images" class="form-control custom-file-input " id="filePaths" name="filePaths" value="{{$item->filePath}}">
                            <input type="hidden" title="orignal_names" class="form-control custom-file-input " id="orignal_names" name="orignal_names" value="{{$item->orignal_name}}">
                            <input type="hidden" title="type_files" class="form-control custom-file-input " id="type_files" name="type_files" value="{{$item->type}}">


                            <p class="text-danger error_filePaths"></p>

                        </div>
                    </div>


                </div>




            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-primary  edit_requests_btn"> {{trans('lang.Editing')}}</button>
            <button type="button" class="btn btn-secondary  ml-2" data-dismiss="modal">{{trans('lang.Close')}}</button>
        </div>
    </div>
</form>





            
<script>
   var url = "{{URL::to('/')}}";

new Dropzone("#m-dropzone-one-update", {
                paramName:"file",
                maxFiles:1,
                maxFilesize:5,
                addRemoveLinks:!0,
                acceptedFiles:"image/jpeg,image/png,image/jpg,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/docx,application/pdf,text/plain,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                accept:function(e, o) {
                    "justinbieber.jpg"==e.name?o("Naha, you don't."): o()
                },
                sending: function(file, xhr, formData) {

                    formData.append("_token", $("input[name='_token']").val());
                },
                success:function (file , response) {
                    var ffile_id = $(file.previewElement).parent().parent().find($("input[title='images']"));
                    ffile_id.val(response.success)
                    // var input = '<input type="hidden" name="file'+ffile_id+'" title="reqName" value="'+response+'">';
                    // var asss = file.previewElement;

                    
                 var orignal_name = $(file.previewElement).parent().parent().find($("input[title='orignal_names']"));
                 orignal_name.val(file.name)
                  // var asss = file.previewElement;
                  var type_file = $(file.previewElement).parent().parent().find($("input[title='type_files']"));
                  type_file.val(file.type)
                    // ffile_id.val(response)

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

                            $(file.previewElement).parent().parent().find($("input[name='orignal_names']")).val('')
                            $(file.previewElement).remove()

                            $(file.previewElement).parent().parent().find($("input[name='type_files']")).val('')
                            $(file.previewElement).remove()
                        }

                    });
                }

            }

);
</script>
