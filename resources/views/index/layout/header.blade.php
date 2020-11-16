<!-- Top -->
<div class="themesflat-top header-style1">
  <div class="container">
    <div class="container-inside">
      <div class="content-left contact-info">

        <ul>
          <li class="border-right">
            +7(771)674-25-55
          </li>
          <li>
            <a href="mailto:6742555@gmail.com" target="_top">6742555@gmail.com</a>
          </li>
        </ul>
      </div><!-- /.col-md-7 -->

      <div class="content-right">
        <ul class="themesflat-socials">
          <li class="facebook">
            <a href="https://www.facebook.com/QyranPartners/" target="_blank" rel="alternate" title="facebook.com/themesflat">
              <i class="fa fa-facebook"></i>
            </a>
          </li>
          <li class="instagram">
            <a href="https://instagram.com/qpartners.club?igshid=k2cykcsk2lrz" target="_blank" rel="alternate" title="#">
              <i class="fa fa-instagram"></i>
            </a>
          </li>
          <li class="vkontakte">
            <a href="https://www.youtube.com/channel/UCUzWIFTzK3VKwSi6KB5oQZw" target="_blank" rel="alternate" title="#">
              <i class="fa fa-youtube"></i>
            </a>
          </li>
        </ul>

        <div id="icl_lang_sel_widget-4" class="widget themesflat-widget-languages widget_icl_lang_sel_widget">
          <div id="lang_sel">
            <ul>
              <li>
                <a href="#" class="lang_sel_sel icl-en">
                  <img class="iclflag" src="/wp-content/plugins/sitepress-multilingual-cms/res/flags/{{$lang}}.png" alt="en" title="English">
                  &nbsp;<span class="icl_lang_sel_current icl_lang_sel_native">{{Lang::get('app.lang')}}</span>
                </a>
                <ul>
                  <li class="icl-hi">
                    <a href="{{\App\Http\Helpers::setSessionLang('kz',$request)}}">
                      <img class="iclflag" src="/wp-content/plugins/sitepress-multilingual-cms/res/flags/kz.png" alt="" title="">&nbsp;<span
                              class="icl_lang_sel_native">Қазақша</span>
                    </a>
                  </li>
                  <li class="icl-hi">
                    <a href="{{\App\Http\Helpers::setSessionLang('ru',$request)}}">
                      <img class="iclflag" src="/wp-content/plugins/sitepress-multilingual-cms/res/flags/ru.png" alt="" title="">&nbsp;<span
                              class="icl_lang_sel_native">Русский</span>
                    </a>
                  </li>
                  <li class="icl-hi">
                    <a href="{{\App\Http\Helpers::setSessionLang('en',$request)}}">
                      <img class="iclflag" src="/wp-content/plugins/sitepress-multilingual-cms/res/flags/en.png" alt="" title="">&nbsp;<span
                              class="icl_lang_sel_native">English</span>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
        <div class="info-top-right cabinet-label">
          <a class="appoinment" href="/login">{{Lang::get('app.cabinet')}}</a>
          <ul class="cabinet-ul">
            @if(!Auth::check())
              <li><a href="/register">Регистрация</a></li>
              <li><a href="/login">Войти</a></li>
            @else
              <li><a href="/admin/index">Личный кабинет</a></li>
            @endif

          </ul>
        </div>
      </div>
    </div><!-- /.container -->
  </div><!-- /.container -->
</div><!-- /.top -->

<div class="themesflat_header_wrap header-style1" data-header_style="header-style1">
<header id="header" class="header header-style1" >
    <div class="container nav">
      <div class="row">
        <div class="col-md-12 ">
          <div class="header-wrap clearfix">
            <div id="logo" class="logo" >
              <a href="/"  title="Qpartners">
                <img class="logo_svg" src="/logo_main.png?v=3"  data-src="/logo_main.png?v=3" alt=""   data-retina="/logo_main.png" />
              </a>
            </div>


            <div class="nav-wrap">
              <div class="btn-menu">
                <span></span>
              </div><!-- //mobile menu button -->

              <nav id="mainnav" class="mainnav" role="navigation">
                <ul id="menu-main" class="menu">
                  @if($lang != 'kz')
                    <li id="menu-item-2167" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2167 @if(isset($menu) && $menu == 'index') current-menu-item current_page_item @endif"><a href="/">{{Lang::get('app.home')}}</a></li>
                  @endif

                  <li id="menu-item-2739" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-2739 @if(isset($menu) && $menu == 'about') current-menu-item current_page_item @endif"><a href="#">{{Lang::get('app.about_company')}}</a>
                    <?php $about = \App\Models\About::where('is_show',1)->orderBy('about_id')->get();?>
                     <ul  class="sub-menu">

                       @foreach($about as $key => $item)

                         <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2740"><a href="/{{\App\Http\Helpers::getTranslatedSlugRu($item['about_name_'.$lang])}}-u{{$item->about_id}}">{{$item['about_name_'.$lang]}}</a></li>

                       @endforeach

                     </ul>
                  </li>
                  <li id="menu-item-2161" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-2161 @if(isset($menu) && $menu == 'project') current-menu-item current_page_item @endif"><a href="#">{{Lang::get('app.our_projects')}}</a>
                    <?php $project = \App\Models\Project::where('is_show',1)->orderBy('sort_num','asc')->get();?>
                    <ul  class="sub-menu">

                      @foreach($project as $key => $item)

                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2740"><a href="/project/{{\App\Http\Helpers::getTranslatedSlugRu($item['project_name_'.$lang])}}-u{{$item->project_id}}">{{$item['project_name_'.$lang]}}</a></li>

                      @endforeach

                    </ul>
                  </li>
                  <li id="menu-item-204" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-204 @if(isset($menu) && $menu == 'gallery') current-menu-item current_page_item @endif"><a href="#">{{Lang::get('app.gallery')}}</a>
                    <ul  class="sub-menu">

                      <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2740"><a href="/gallery">{{Lang::get('app.photo')}}</a></li>
                      <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2740"><a href="/video">{{Lang::get('app.video')}}</a></li>

                    </ul>
                  </li>
                  <li id="menu-item-2171" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor menu-item-has-children menu-item-2171 @if(isset($menu) && $menu == 'news') current-menu-item current_page_item @endif">
                    <a href="/news">{{Lang::get('app.news')}}</a>
                  </li>
                  <li id="menu-item-2167" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2167 @if(isset($menu) && $menu == 'education') current-menu-item current_page_item @endif"><a href="#">{{Lang::get('app.business_education')}}</a>
                    <?php $education = \App\Models\Education::where('is_show',1)->orderBy('education_id')->get();?>
                    <ul  class="sub-menu">

                      @foreach($education as $key => $item)

                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2740"><a href="/education/{{\App\Http\Helpers::getTranslatedSlugRu($item['education_name_'.$lang])}}-u{{$item->education_id}}">{{$item['education_name_'.$lang]}}</a></li>

                      @endforeach

                    </ul>
                  </li>
                  <li id="menu-item-206" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-206 @if(isset($menu) && $menu == 'contact') current-menu-item current_page_item @endif"><a href="/contact">{{Lang::get('app.contact')}}</a></li>
                </ul>    </nav><!-- #site-navigation -->
            </div><!-- /.nav-wrap -->
          </div><!-- /.header-wrap -->

        </div><!-- /.col-md-12 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </header>
</div>