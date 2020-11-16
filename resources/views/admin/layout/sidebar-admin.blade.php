<ul class="sidebar-menu">
    <li class="treeview">
        <a href="/admin/contact?active=0">
            <i class="fa fa-envelope-o"></i>
            <span>Обратная связь</span>
            <?php $feedback_count = \App\Models\Contact::where('is_show', '0')->count();?>
            <span class="label label-primary pull-right" id="feedback_count"
                  style="@if($feedback_count == 0) display: none; @endif background-color: rgb(253, 58, 53) ! important;">{{$feedback_count}}</span>
        </a>
    </li>
    <li class="treeview">
        <a href="/admin/doc">
            <i class="fa fa-file-word-o"></i>
            <span>Документы</span>
        </a>
    </li>
    <li class="treeview">
        <a href="/admin/news">
            <i class="fa fa-newspaper-o"></i>
            <span>Новости</span>
        </a>
    </li>
    {{--    <li class="treeview">--}}
    {{--        <a href="/admin/about">--}}
    {{--            <i class="fa fa-file-text"></i>--}}
    {{--            <span>О компании</span>--}}
    {{--        </a>--}}
    {{--    </li>--}}
    {{--    <li class="treeview">--}}
    {{--        <a href="/admin/project">--}}
    {{--            <i class="fa fa-file-text"></i>--}}
    {{--            <span>Проекты</span>--}}
    {{--        </a>--}}
    {{--    </li>--}}
    <li>
        <a href="/admin/about?category_type=guide">
            <i class="fa fa-info"></i>
            <span>О нас</span>
        </a>
    </li>
    <li class="treeview">
        <a href="/admin/product">
            <i class="fa fa-tag"></i>
            <span>Продукты</span>
        </a>
    </li>
    <li class="treeview">
        <a href="/admin/video">
            <i class="fa fa-video-camera"></i>
            <span>Видео</span>
        </a>
    </li>
    <li class="treeview">
        <a href="/admin/slider">
            <i class="fa fa-file-image-o"></i>
            <span>Галерея</span>
        </a>
    </li>
    {{--    <li class="treeview">--}}
    {{--        <a href="/admin/education">--}}
    {{--            <i class="fa fa-file-text"></i>--}}
    {{--            <span>Бизнес обучение</span>--}}
    {{--        </a>--}}
    {{--    </li>--}}
    {{--    <li class="treeview">--}}
    {{--        <a href="/admin/page">--}}
    {{--            <i class="fa fa-file-text"></i>--}}
    {{--            <span>Тексты на сайте</span>--}}
    {{--        </a>--}}
    {{--    </li>--}}
    <li class="treeview">
        <a href="/admin/country">
            <i class="fa fa-flag"></i>
            <span>Страны</span>
        </a>
    </li>
    <li class="treeview">
        <a href="/admin/city">
            <i class="fa fa-home"></i>
            <span>Города</span>
        </a>
    </li>
    <li>
        <a href="/admin/representative">
            <i class="fa fa-user"></i>
            <span>Добавить представителей</span>
        </a>
    </li>
    <li class="treeview">
        <a href="/admin/faq">
            <i class="fa fa-question"></i>
            <span>Часта задаваемые вопросы</span>
        </a>
    </li>
    <li class="treeview">
        <a href="/admin/support">
            <i class="fa fa-support"></i>
            <span>Служба поддержки</span>
        </a>
    </li>
    <li class="treeview">
        <a href="/admin/password">
            <i class="fa fa-key"></i>
            <span>Сменить пароль</span>
        </a>
    </li>

    <li class="treeview">
        <a href="/logout">
            <i class="fa fa-sign-out"></i>
            <span>Выйти</span>
        </a>
    </li>
</ul>