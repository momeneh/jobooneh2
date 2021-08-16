@extends('layouts.app', ['admin' => 1])

{{--@extends('layouts.main')--}}
@section('title')
   | {{ __('title.categories')}}
@endsection
@section('content')

    <div class="row">
        <div class="col-md-11">
            <div class="card">
                <div class="flex-center position-ref full-height">
                    <h5>{{__('title.products')}}</h5>
                    <form id="frm_product_create" action="{{route('product.store')}}" method="post" enctype="multipart/form-data" >
                        {{csrf_field()}}

                        <div class="form-group{{ $errors->has('owner') ? ' has-error' : '' }}">
                            <label for="owner" class="col-md-4 control-label ">{{ __('title.owner')}} <span class="require">*</span> </label>
                            <div class="col-md-6">
                                <input id="auto" type="text" class="ui-autocomplete-input form-control" route = "{{route('autocompleteUsers')}}" autocomplete="off"  name="owner" value="{{ old('owner') }}" required autofocus>
                                <input id="auto_id" type="text" class="hidden"  autocomplete="off"  name="owner_id" value="{{ old('owner_id') }}"  >
                                <span id="loading_data_icon"></span>

                                @include('alerts.feedback', ['field' => 'owner_id'])
                            </div>
                        </div>

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

                        <div class="form-group{{ $errors->has('confirmed') ? ' has-error' : '' }}">
                            <label for="confirmed" class="col-md-1 control-label">{{__('title.confirmed')}}</label>
                            <input id="confirmed" type="checkbox" class="" name="confirmed" value=1 autofocus  {{ old('confirmed') ? 'checked' : ' ' }} >
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

                        <div class="card detail" >
                            <div class="card-header">
                                <h5>{{__('title.images')}}</h5>
                            </div>
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
                                        <button id="add_row" class="btn btn-default"> +{{__('title.create_new')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group_submit  ">
                            <div class="">
                                <button type="submit" name='submit' class="btn btn-primary">
                                    {{__('title.create_new')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        var url = "{{ route('upload_file_product')}}";
        var url_remove = "{{ route('remove_file_product')}}";
    </script>
    <script src="{{ asset('white/js/SimpleAjaxUploader.js')}}"></script>
    <script src="{{ asset('white/js/uploader.js') }}"></script>
    <script src="{{asset('pub')}}/jquery-ui.js"></script>
    <script>
        $('#frm_product_create').submit(function (event) {
            $('#fake_table0').html('');
            return true;
        });
        let row_number = {{ count(old('image',[''])) }};
{{--        var a = "{{json_encode(session()->getOldInput())}}";--}}
//         console.log( a );
    </script>
    <script src="{{ asset('white/js/admin_product_form_needed.js') }}"></script>
@endsection
