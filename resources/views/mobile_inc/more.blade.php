@if(!empty($data))
    @foreach($data as $key=>$val)
        <div class="review_block" >
            <div class="review_pic">
                <a href="/mobile/detail/{{$val->id}}"
                   class="review_link">  <img src="{{$val->thumb}}" style="height: 137.39px"/>  </a>
            </div>
            <div class="review_tit">
                <a href="/mobile/detail/{{$val->id}}">{{$val->description}}		</a>
            </div>
            <div class="review_infor">
                科室：{{$val->catname}}
            </div>
            <div class="review_infor">
                专家：{{$val->doc_name}}{{$val->profess}}
            </div>
            <div class="review_infor">
                会员专享：@if($val->is_admin == 1)
                    是
                @else
                    否
                @endif
            </div>
        </div>
    @endforeach
    @if($num >= 8)
        <div class="loading_box" onclick="more(8,'{{$catid}}','{{$page}}')" id="more"><div class="loading">点击加载更多</div></div>
    @else
        <div class="loading_box" ><div class="loading">已加载全部</div></div>
    @endif
@endif

