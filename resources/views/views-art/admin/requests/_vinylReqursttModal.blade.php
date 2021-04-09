<div class="modal-header">
    <h5 class="modal-title"> فينيل الطلب</h5>
</div>
<div class="modal-body">

    <div class="row clearfix">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-custom spacing8">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>لون الفينيل</th>
                            <th>رمز الفينيل</th>
                            <th>نوع الفينيل </th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0 ?>
                        @foreach($vinyl as $items)
                        @foreach($items->vinyl as $item)
                        <tr class="text-center">
                            <td><?= ++$i ?></td>
                            <td>{{$item->color_v}}</td>
                            <td>{{$item->code_v}}</td>
                            <td>{{$item->type_v}}</td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>