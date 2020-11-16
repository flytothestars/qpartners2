@extends('admin.layout.layout')

@section('css')

    <link rel="stylesheet" type="text/css" href="/custom/css/structure/reset.css">
    <link rel="stylesheet" type="text/css" href="/custom/css/structure/style_002.css">
    <link rel="stylesheet" type="text/css" href="/custom/css/structure/others.css">

@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="main-content">
                <div class="heading-with-button">
                    <h1 class="with-subtitle">Настройка авторегистрации<span class="subtitle">Выберите правую или левую ветку</span>
                    </h1>
                </div>
                <div class="structure-content">
                    <div class="binary-structure full-width" style="width: auto; height: auto; min-height: 400px">
                        <div class="quadrate green-square binary-circle">

                        </div>
                        <div class="top-line">|</div>
                        <div class="divide-part">
                            <form>
                                <div class="left-part">
                                    <div class="left-line"></div>
                                    <div class="clear-float"></div>
                                    <div class="quadrate white-square binary-circle">
                                        <input @if(Auth::user()->is_left_config == 1) checked @endif value="1" name="is_left" style="margin-top: 15px" type="radio"/>
                                        <div style="color: rgb(86, 86, 86); position: absolute; font-size: 15px; margin-top: 20px;">Налево</div>
                                    </div>
                                </div>
                                <div class="right-part">
                                    <div class="right-line"></div>
                                    <div class="clear-float"></div>
                                    <div class="quadrate white-square binary-circle">
                                        <input @if(Auth::user()->is_left_config == 0) checked @endif value="0" name="is_left" style="margin-top: 15px" type="radio"/>
                                        <div style="color: rgb(86, 86, 86); position: absolute; font-size: 15px; margin-top: 20px;">Направо</div>
                                    </div>
                                </div>
                                <div class="clear-float"></div>
                            </form>
                        </div>
                        <input onclick="saveConfigStructure()" style="max-width: 400px; border-radius: 5px; margin: 50px auto auto;" class="btn btn-primary btn-block" type="button" value="Сохранить"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

