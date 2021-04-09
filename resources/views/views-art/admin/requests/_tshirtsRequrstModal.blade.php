<div class="modal-header">
    <h5 class="modal-title"> 
    <!--{{trans('lang.T-shirt')}}-->
    
        @foreach($tshirts as $items)
        {{trans('lang.title-req')}} :  
        @if(App::getLocale()=='ar')
                          {{$items->name_request}}
                            @else
             {{$items->name_request_en}}

                            @endif
                            
                            _
                            
                            {{trans('lang.tracking-number')}} :{{$items->tracking_number}}
        @endforeach
    
    
    </h5>  
</div>
<div class="modal-body">

    <div class="row clearfix">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-custom spacing8">
                    <thead>
                        <tr class="text-center">
                          
                            <th>{{trans('lang.Product-mage')}}  </th>
                            <th> {{trans('lang.Size')}} </th>
                             <th>{{trans('lang.Number')}} </th>
                            <th> {{trans('lang.Color')}} </th>
                            
                           
                        </tr>
                    </thead>
                    <tbody>
                     
                        @foreach($tshirts as $items)
                        @foreach($items->tshirt as $req)
                        <tr class="text-center">
                           
                  <!--           @if(App::getLocale()=='ar')-->
                  <!--          <td class="text-center">{{$items->name_request}}</td>-->
                  <!--          @else-->
                  <!--<td class="text-center">{{$items->name_request_en}}</td>-->

                  <!--          @endif-->
                  <!--                      <td class="text-center">{{$items->tracking_number}}</td>-->

                           
                            <td class="text-center"><a target="_blank" href="/storage/{{ $req->image }}">
                                    <img src="{{asset('storage/' . $req->image )}}" class="img" height="55" width="70">

                                </a>
                            </td>

                            <td class="text-center">{{$req->size}}</td>
                              <td class="text-center">{{$req->count_t}}</td>
                             @if(App::getLocale()=='ar')
                            <td class="text-center">{{$req->color_t}}</td>
                            @else
                  <td class="text-center">{{$req->color_t_en}}</td>

                            @endif
                          
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>