<div class="form-group{{ $errors->has('categories') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label ">{{ __('title.categories')}} <span class="require">*</span> </label>
    <div class="col-md-6">
        <select id="category_id" class="form-control" name="category_id"  autofocus>
            <option value="">{{__('title.select_one')}}</option>
            @foreach($categories as $item)
                <option value="{{$item->id}}" {{!empty(old('category_id')) && old('category_id') == $item->id? 'selected = selected' : ''}}>{{$item->title}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
    <label class="col-md-4 control-label ">{{ __('title.title') }} <span class="require">*</span></label>
    <div class="col-md-6">
        <input type="text" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"  value="{{ old('title') }}" required>
        @include('alerts.feedback', ['field' => 'title'])
    </div>
</div>

<div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
    <label class="col-md-4 control-label ">{{ __('title.description') }}</label>
    <div class="col-md-6">
                                <textarea name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">
                                    {{ old('description') }}
                                </textarea>
        @include('alerts.feedback', ['field' => 'description'])
    </div>
</div>



<div class="form-group{{ $errors->has('sell_status') ? ' has-danger' : '' }}">
    <label for="sell_status" class="col-md-4 control-label ">{{ __('title.sell_status')}} </label>
    <div class="col-md-6">
        <select id="sell_status" class="form-control {{ $errors->has('pre_pay') ? ' is-invalid' : '' }}" name="sell_status"  autofocus onchange="ShowHideDiv();">
            <option value="">{{__('title.select_one')}}</option>
            @for ($i = 1; $i < 3; $i++)
                <option value="{{$i}}" {{!empty(old('sell_status')) && old('sell_status') == $i? 'selected = selected' : ''}}>{{__('title.sell_status_'.$i)}}</option>
            @endfor
        </select>
    </div>
</div>

<div id="pre_pay" class="form-group{{ $errors->has('pre_pay') ? ' has-danger' : '' }}" >
    <label class="col-md-4 control-label ">{{ __('title.pre_pay') }}</label>
    <div class="col-md-6">
        <input type="text" name="pre_pay" class="form-control{{ $errors->has('pre_pay') ? ' is-invalid' : '' }}"  currency_title="{{__('title.currency_title')}}" value="{{ old('pre_pay') }}" id="currency-field"  value="" data-type="currency"  >
        @include('alerts.feedback', ['field' => 'pre_pay'])
    </div>
</div>

<div id="duration" class="form-group{{ $errors->has('duration') ? ' has-danger' : '' }}">
    <label class="col-md-4 control-label ">{{ __('title.duration_of_work') }}</label>
    <div class="col-md-6">
                                <textarea id ="duration_box" name="duration" class="form-control{{ $errors->has('duration') ? ' is-invalid' : '' }}">
                                    {{ old('duration') }}
                                </textarea>
        @include('alerts.feedback', ['field' => 'duration'])
    </div>
</div>

<div  class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}" >
    <label class="col-md-4 control-label ">{{ __('title.price') }}</label>
    <div class="col-md-6">
        <input type="text" name="price" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}"  currency_title="{{__('title.currency_title')}}" value="{{ old('price') }}"   value="" data-type="currency"  >
        @include('alerts.feedback', ['field' => 'price'])
    </div>
</div>
<div  id="stock" class="form-group{{ $errors->has('count') ? ' has-danger' : '' }}" >
    <label class="col-md-4 control-label ">{{ __('title.stock') }}<span class="require">*</span></label>
    <div class="col-md-6">
        <input type="number" name="count" class="form-control{{ $errors->has('count') ? ' is-invalid' : '' }}"    value="{{ old('count') }}" required   >
        @include('alerts.feedback', ['field' => 'count'])
    </div>
</div>

<div class="card detail" >
    <h5>{{__('title.images')}}</h5>
    <div class="card-body" >
        <table class="table" id="images_table">
            <tbody>
            <tr><th style="width: 15px"></th><th>{{__('title.alt')}}</th><th>{{__('title.image')}}</th></tr>
            @foreach (old('image', ['']) as $index => $oldImage)
                @include('product.tr_images')
            @endforeach
            <tr id="image{{ count(old('image', [''])) }}"></tr>
            </tbody>
        </table>
        <div style="display: none" id="fake_table0">
            <table >
                <tbody>
                @include('product.tr_images',['index'=>10001])
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button id="add_row" class="btn btn-default"> +{{__('title.new_row')}}</button>
            </div>
        </div>
    </div>
</div>


