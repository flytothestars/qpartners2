@foreach($row->packet as $key => $item)

    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box" style="background-color: #{{$item->packet_css_color}}">
            <div class="inner">
                <h3 style="font-family: cursive; font-size: 24px">{{$item->packet_name_ru}}</h3>
                <h4 style="font-size: 22px">{{$item->packet_price}} PV</h4>
            </div>
            <div class="icon">
                <i class="ion ion-bag" style="font-size: 17px"></i>
            </div>

                @if($item->is_active > 0)
                    <a class="small-box-footer" style="font-size: 18px">Приобретенный</a>
                @else
                    <a class="small-box-footer" style="font-size: 18px">Отправил запрос</a>
                @endif

        </div>
    </div>

@endforeach