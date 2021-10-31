@extends('layouts.app'    , ['admin' => 1])

@section('title')
   | {{ __('Newsletter')}}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-11">
            <div class="card">
                <div class="flex-center position-ref full-height">
                    <h5>{{__('title.create_new')}}</h5>
                    <form action="{{route('subscribe.store')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                            <label for="subject" class="col-md-4 control-label ">{{ __('title.subject')}} <span class="require">*</span> </label>
                            <div class="col-md-6">
                                <input id="subject" type="text" class="form-control" name="subject" value="{{ old('subject') }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'subject'])
                            </div>
                        </div>

                        <div class="document-editor col-md-8">
                            <div class="document-editor__toolbar"></div>
                            <div class="document-editor__editable-container">
                                <textarea id="body"  class="form-control hidden" name="body"  ></textarea>
                                <div class="document-editor__editable">
                                    <p>{{ old('body') }}</p>
                                </div>
                            </div>
                            @include('alerts.feedback', ['field' => 'body'])
                        </div>

                        <div class="form-group_submit  ">
                            <div class="">
                                <button type="submit" name='submit' class="btn btn-primary" id="submit">
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
{{--    <script src="{{asset('white/js/ckeditor5-build-classic/ckeditor.js')}}"></script>--}}
    <script src="{{asset('white/js/ckeditor5-build-decoupled-document/ckeditor.js')}}"></script>
    <script src="{{ asset('white/js/SimpleAjaxUploader.js')}}"></script>
    <script> var url='{{route('admin.upload_file_newsletter')}}';</script>
{{--    <script src="{{ asset('white/js/CKeditorConfig.js')}}"></script>--}}
    <script src="{{ asset('white/js/CKeditorConfigDoc.js')}}"></script>
@endsection



