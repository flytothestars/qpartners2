@if(!isset($first_user))
    <div class="top-line">л|п</div>
@endif

<div class="divide-part">
    <input type="hidden" value="{{$parent->level}}" class="circle-level"/>
    <input type="hidden" value="1" class="circle-level-{{$parent->level}}"/>
    <div class="left-part">
        <div class="left-line"></div>
        <div class="clear-float"></div>

        <?php $user = \App\Models\Users::where('parent_id',$parent->user_id)->where('is_left_part',1)->first(); ?>

        @if($user != null)
             {!! view('admin.binar-structure.user-info',['user' => $user, 'main_user_id' => $main_user_id]) !!}

            @if($count < 5)
                {!! view('admin.binar-structure.divide-line',['count' => $count + 1, 'parent' => $user, 'main_user_id' => $main_user_id]) !!}
            @else
                <div class="child-list">
                    <div class="show-bottom-structure" onclick="showChildList(this,'{{$user->user_id}}','{{$main_user_id}}')">
                        <i class="fa fa-plus-square red-color"></i>
                    </div>
                </div>
            @endif

        @else
            {!! view('admin.binar-structure.empty-user-info',['parent_id' => $parent->user_id, 'is_left' => 1]) !!}
        @endif

    </div>
    <div class="right-part">
        <div class="right-line"></div>
        <div class="clear-float"></div>

        <?php $user = \App\Models\Users::where('parent_id',$parent->user_id)->where('is_left_part',0)->first(); ?>

        @if($user != null)
            {!! view('admin.binar-structure.user-info',['user' => $user, 'main_user_id' => $main_user_id]) !!}

            @if($count < 5)
                {!! view('admin.binar-structure.divide-line',['count' => $count + 1, 'parent' => $user, 'main_user_id' => $main_user_id]) !!}
            @else
                <div class="child-list">
                    <div class="show-bottom-structure" onclick="showChildList(this,'{{$user->user_id}}','{{$main_user_id}}')">
                        <i class="fa fa-plus-square red-color"></i>
                    </div>
                </div>
            @endif

        @else
            {!! view('admin.binar-structure.empty-user-info',['parent_id' => $parent->user_id, 'is_left' => 0]) !!}
        @endif

    </div>
    <div class="clear-float"></div>
</div>

@if($count > 4)
<!-- jQuery 2.1.4 -->
<script src="/admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>

<script>
    $('.binary-structure').removeClass('full-width');
    $('.first-user').css('width', $(".left-line").width() + $(".right-line").width());
</script>

@endif
