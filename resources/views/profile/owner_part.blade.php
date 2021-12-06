<div class="form-group{{ $errors->has('post_price') ? ' has-danger' : '' }}">
    <label>{{ __('title.post_price') }}</label>
    <div class="col-md-6">
        <input type="text" name="post_price" class="form-control{{ $errors->has('post_price') ? ' is-invalid' : '' }}"  value="{{ old('post_price', $user->post_price) }}" currency_title="{{__('title.currency_title')}}" data-type="currency" >
        @include('alerts.feedback', ['field' => 'post_price'])
    </div>
</div>

<div class="form-group{{ $errors->has('card') ? ' has-danger' : '' }}">
    <label>{{ __('title.card_number') }}
        <img src="{{asset('green/icon/tic.png')}}" class="img_valid hidden"/>
        <img src="{{asset('green/icon/cross.png')}}" class="img_invalid hidden"/>
    </label>
    <div class="col-md-6">
        <input type="text"  name="card" class="form-control{{ $errors->has('card') ? ' is-invalid' : '' }}"  value="{{ old('card', $user->card_number) }}" onchange="CardNumber(this)">

        @include('alerts.feedback', ['field' => 'card'])
    </div>
</div>

<div class="form-group{{ $errors->has('card_owner') ? ' has-danger' : '' }}">
    <label>{{ __('title.card_owner') }}</label>
    <div class="col-md-6">
        <input type="text" name="card_owner" class="form-control{{ $errors->has('card_owner') ? ' is-invalid' : '' }}"  value="{{ old('card_owner', $user->card_owner) }}" >
        @include('alerts.feedback', ['field' => 'card_owner'])
    </div>
</div>
