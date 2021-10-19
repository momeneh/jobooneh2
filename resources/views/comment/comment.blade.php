<div class="col-xl-12 col-lg-5 col-md-5 co-sm-l2  comments ">
    <h3>{{__('comments')}}</h3>
    <form action="{{route('comment.store')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}

        <input type="hidden" name="product_id" value="{{$product->id}}">
        <div class="col-xl-5 inline">
            <label for="name" class="col-md-4 control-label ">{{ __('title.name')}}  </label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"  autofocus>
            @include('alerts.feedback', ['field' => 'name'])
        </div>

        <div class="col-xl-5 inline">
            <label for="email" class="col-md-4 control-label ">{{ __('title.email')}} </label>
            <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}"  autofocus>
            @include('alerts.feedback', ['field' => 'email'])
        </div>

        <div class="col-xl-10">
            <label for="comment" class="col-md-4 control-label ">{{ __('title.comment')}} <span class="require">*</span> </label>
            <textarea class="form-control textarea"  type="text" name="comment" required>{{old('comment')}}</textarea>
            @include('alerts.feedback', ['field' => 'comment'])
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        @if(config('services.recaptcha.key'))
            <div class=" ">
                <div class="g-recaptcha"  data-sitekey="{{config('services.recaptcha.key')}}">
                </div>
            </div>
            @include('alerts.feedback', ['field' => 'g-recaptcha-response'])
        @endif
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <button class="send">Send</button>
        </div>

    </form>
    @if(!empty($comments[0]))
        <div class="col-xl-11 comments_list">
            <h4>{{__('others comments')}}</h4>
            @include('comment.list')
        </div>

    @endif

</div>
