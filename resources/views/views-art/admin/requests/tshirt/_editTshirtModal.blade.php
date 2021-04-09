<form method="POST" id="editTshirt_form" novalidate action="">
    <div class="modal-header">
                <h5 class="modal-title">{{trans('lang.Editing-Tshirt')}} </h5>
    </div>
    <div class="modal-body">
        @csrf
        <input type="hidden" id="id" name="id" value="{{$item->id}}" />
        <div class="row clearfix">
            <div class="col-md-12">

                <div class="form-group ">
                                <label for="colors_t" class="control-label">{{trans('lang.Color-tshirt')}}  </label>
                    <input value="{{old('color_t',$item->color_t)}}" type="text" class="form-control" id="colors_t" name="colors_t" required>

                    <p class="text-danger error_color_t"></p>

                </div>
                
                
                
                  <div class="form-group ">
                    <label for="colors_t_en" class="control-label">{{trans('lang.Color-tshirt-en')}}  </label>
                    <input value="{{old('color_t_en',$item->color_t_en)}}" type="text" class="form-control" id="colors_t_en" name="colors_t_en" required>

                    <p class="text-danger error_color_t_en"></p>

                </div>


                <div class="form-group">
                   <label for="sizes" class="control-label">{{trans('lang.Size')}}  </label>
                    <select class="form-control sizes" id="sizes" name="sizes" required>
                        <option value="">{{trans('lang.choose-size')}}</option>
                        <option value="S" {{ old('size', $item->size)== "S" ? ' selected' : ''  }}> S</option>
                        <option value="M" {{ old('size', $item->size)== "M" ? ' selected' : ''  }}> M</option>
                        <option value="L" {{ old('size', $item->size)== "L" ? ' selected' : ''  }}> L</option>
                        <option value="XL" {{ old('size', $item->size)== "XL" ? ' selected' : ''  }}> XL</option>
                        <option value="2XL" {{ old('size', $item->size)== "2XL" ? ' selected' : ''  }}> 2XL</option>
                        <option value="3XL" {{ old('size', $item->size)== "3XL" ? ' selected' : ''  }}> 3XL</option>
                        <option value="4XL" {{ old('size', $item->size)== "4XL" ? ' selected' : ''  }}> 4XL</option>
                        <option value="5XL" {{ old('size', $item->size)== "5XL" ? ' selected' : ''  }}> 5XL</option>
                        <option value="6XL" {{ old('size', $item->size)== "6XL" ? ' selected' : ''  }}> 6XL</option>

                    </select>
                    <p class="text-danger error_size"></p>

                </div>


                <div class="form-group">
                     <label for="counts_t" class="control-label">{{trans('lang.Number')}}  </label>
                    <input value="{{old('count_t',$item->count_t)}}" type="text" class="form-control" id="counts_t" name="counts_t" required>

                    <p class="text-danger error_count_t"></p>

                </div>


                <div class="form-group">

                      <label class="control-label">{{trans('lang.Product-mage')}}   </label>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="m-dropzone dropzone dz-clickable" action="{{ route('uploads.requests.file') }}" id="m-dropzone-one-update" class="dropzone">

                            {{ csrf_field() }}
                            <div class="m-dropzone__msg dz-message needsclick">
                               <h3 class="m-dropzone__msg-title">  {{trans('lang.drag-file')}} </h3>

                                    <span class="m-dropzone__msg-desc"> {{trans('lang.drag-click')}}   </span>
                            </div>
                        </div>
                        <input type="hidden" title="images" class="form-control custom-file-input " id="images" name="images" value="{{$item->image}}">



                        <p class="text-danger error_image"></p>

                    </div>



                </div>


            </div>


        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary editTshirt_btn">{{trans('lang.Editing')}}</button>
            <button type="button" class="btn btn-secondary  ml-2" data-dismiss="modal">{{trans('lang.Close')}}</button>
    </div>
</form>


<script>
    var url = "{{URL::to('/')}}";

    new Dropzone("#m-dropzone-one-update", {
            paramName: "file",
            maxFiles: 1,
            maxFilesize: 5,
            addRemoveLinks: !0,
            acceptedFiles:"image/*",
            accept: function(e, o) {
                "justinbieber.jpg" == e.name ? o("Naha, you don't.") : o()
            },
            sending: function(file, xhr, formData) {

                formData.append("_token", $("input[name='_token']").val());
            },
            success: function(file, response) {
                var ffile_id = $(file.previewElement).parent().parent().find($("input[title='images']"));
                ffile_id.val(response.success)
                // var input = '<input type="hidden" name="file'+ffile_id+'" title="reqName" value="'+response+'">';
                // var asss = file.previewElement;




                console.log(ffile_id);

                console.log(response);
                // let curr = $(this).find('.dz-preview');
                // console.log($(this).find(asss))
                // $(file.previewElement).append(input);
            },
            removedfile: function(file, response) {
                // var name = $(file.previewElement).find("input[title='reqName']").val();
                console.log(name);
                $.ajax({
                    url: url + '/deleteFile',
                    data: {
                        name: name
                    },
                    type: 'get',
                    success: function(data) {
                        console.log(data);
                        $(file.previewElement).parent().parent().find($("input[name='images']")).val('')
                        $(file.previewElement).remove()


                    }

                });
            }

        }

    );
</script>