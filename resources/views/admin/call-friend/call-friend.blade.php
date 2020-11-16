@extends('admin.layout.layout')

@section('meta-tags')

    <meta property="og:title" content="Qpartners"/>
    <meta property="og:description"
          content="Qpartners - это Казахстанская компания, которая производит и распространяет серебряные изделия высшей пробы по доступным ценам."/>
    <meta property="og:url" content="{{$url}}"/>
    <meta property="og:image" content="{{URL('/').'/default.png'}}"/>
    <meta property="og:image:type" content="image/jpeg"/>
    <meta property="og:image:width" content="400"/>
    <meta property="og:image:height" content="300"/>

    <meta name="title" content="Qpartners"/>
    <meta name="description" content=""/>
    <link rel="image_src" href="{{URL('/').'/default.png'}}"/>

@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="box-header">
                        <h1 class="box-title main-title">
                            Пригласить друга
                        </h1>
                    </div>
                    <div class="nav-tabs-custom">
                        <div class="tab-content">
                            <div class="shareSprite">
                                <h4>Вы можете поделиться со своими друзьями в социальной сети</h4>
                                <div style="margin-bottom: 10px">
                                    <strong >{{$url}}</strong>
                                </div>

                                <div>
                                    <a target="_blank" href="https://api.whatsapp.com/send?text={{$url}}">
                                        <i class="fa fa-whatsapp" style="font-size: 20px; margin-right: 20px"></i>
                                    </a>
                                    <a target="_blank" href="https://telegram.me/share/url?url={{$url}}">
                                        <i  class="fa fa-telegram" style="background-image: url('https://bitnovosti.com/wp-content/uploads/2017/02/telegram-icon-7.png');font-size: 20px; margin-right: 20px;width: 20px;height: 20px;background-size: 20px 20px;"></i>
                                    </a>
                                    <a target="_blank" href="https://www.facebook.com/sharer.php?u={{$url}}}">
                                        <i  class="fa fa-facebook" style="font-size: 20px; margin-right: 20px"></i>
                                    </a>
                                    <a target="_blank" href="http://vk.com/share.php?url={{$url}}">
                                        <i class="fa fa-vk" style="font-size: 20px; margin-right: 20px"></i>
                                    </a>
                                    <a target="_blank" href="https://twitter.com/share?url={{$url}}">
                                        <i class="fa fa-twitter" style="font-size: 20px; margin-right: 20px"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection