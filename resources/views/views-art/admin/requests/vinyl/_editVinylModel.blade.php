<form method="POST" id="editVinyl_form" novalidate action="">
    <div class="modal-header">
        <h5 class="modal-title">تعديل الفينيل </h5>
    </div>
    <div class="modal-body">
        <p class="text-success addTypeSuccess"></p>
        @csrf
        <input type="hidden" id="id" name="id" value="{{$item->id}}" />
        <div class="row clearfix">
            <div class="col-md-12">

                <div class="form-group">
                    <label for="color_v" class="control-label">لون الفينيل</label>
                    <input value="{{old('color_v',$item->color_v)}}" type="text" class="form-control " id="color_v" name="color_v" required>
                    <p class="text-danger color_v_error"></p>

                </div>

                <div class="form-group mb-4">
                    <label for="code_v" class="control-label">رمز الفينيل</label>
                    <input value="{{old('code_v',$item->code_v)}}" type="text" class="form-control" id="code_v" name="code_v" required>
                    <p class="text-danger  code_v_error"></p>
                </div>
                <div class="form-group mb-4">
                    <label for="type_v" class="control-label">نوع الفينيل</label>
                    <input value="{{old('type_v',$item->type_v)}}" type="text" class="form-control" id="type_v" name="type_v" required>
                    <p class="text-danger type_v_erorr"></p>

                </div>


            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary editVinyl_btn">تعديل</button>
        <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">اغلاق</button>
    </div>
</form>
