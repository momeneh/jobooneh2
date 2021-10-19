
        @foreach($comments as $comment)
            <div class="comments_detail">
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12  comment_date">
                    @if(app()->getLocale() == 'fa') <div style="direction: ltr"> {{PersianNo(dateConvert::strftime('Y/m/d', strtotime($comment->created_at)))}}</div>
                    @else {{$comment->created_at}}
                    @endif
                </div>
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12  comment_name">{{$comment->name}}   </div>
                <div class="comment_body">{{$comment->comment}}</div>
            </div>
        @endforeach

        <div class="navigations">
            @if(!empty($comments->nextPageUrl()))
                <button class="read-more" style="float: none;margin-top: -34px;" onclick="Getmore()">more</button>
            @endif
        {{$comments->appends(request()->query())->links()}} <!-- PAGINATION-->
        </div>
