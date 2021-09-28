@extends('layouts.app',  $navbar)

@section('title')
   | {{ __('title.compose')}}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-11">
            <div class="card">
                <div class="flex-center position-ref full-height">
                    <h5>{{__('title.compose')}}</h5>
                    <form action="{{route($prefix.'message.store')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="form-group{{ $errors->has('receiver') ? ' has-error' : '' }}">
                            <label for="receiver" class="col-md-4 control-label ">{{ __('title.receiver')}} <span class="require">*</span> </label>
                            <div class="col-md-6">
                                <input id="auto" type="text" class="ui-autocomplete-input form-control"
                                       route = "{{route($prefix.'autocompleteReceiver')}}" autocomplete="off"  name="receiver"
                                       value="{{ old('receiver',$receiver) }}"
                                       @if(!empty($message->receiver->name)) readonly="readonly" @endif required autofocus>
                                <input id="auto_id" type="text" class="hidden"  autocomplete="off"  name="receiver_id" value="{{ old('receiver_id',$message['receiver_id']) }}"  >
                                <span id="loading_data_icon"></span>
                                @include('alerts.feedback', ['field' => 'receiver_id'])
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                            <label for="subject" class="col-md-4 control-label ">{{ __('title.subject')}} <span class="require">*</span> </label>
                            <div class="col-md-6">
                                <input id="subject" type="text" class="form-control" name="subject" value="{{ old('subject',$message['subject']) }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'subject'])
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                            <label for="body" class="col-md-4 control-label">{{ __('title.body')}} </label>
                            <div class="col-md-6">
                                <textarea id="body"  class="form-control" name="body">
                                    {{ old('body',$message['body']) }}</textarea>
                                @include('alerts.feedback', ['field' => 'body'])
                            </div>
                        </div>

                        <div class="col-xs-10" id="progressBox">
                            <div class="col-md-6">
                            <div id="progressOuter" class="progress progress-striped active" style="display:none;">
                                <div id="progressBar" class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-xs-10">
                            <div class="col-md-6">
                                <div id="showBox" class="clear" style="padding-top:0px;padding-bottom:10px;">
                                    <div id="fileSize"></div>
                                    @include('alerts.feedback', ['field' => 'image'])
                                </div>
                                <div id="msgBox"></div>

                                <button type="button" id="uploadBtn" class="btn btn-icon btn-round" style="background-color: #c9f3bc;" >
                                    <i class="tim-icons icon-attach-87" title="reply"></i>
                                </button>
                            </div>
                        </div>


                        <div class="form-group_submit  ">
                            <div class="">
                                <button type="submit" name='submit' class="btn btn-primary">
                                    {{__('title.send')}}
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
    <script src="{{ asset('white/js/SimpleAjaxUploader.js')}}"></script>
    <script src="{{ asset('white/js/uploader.js') }}"></script>
    <script src="{{asset('pub')}}/jquery-ui.js"></script>
    <script>
        var url = "{{ route($prefix.'upload_file_message')}}";
        var url_remove = "{{ route($prefix.'remove_file_message')}}";
        var url_download = "{{ route($prefix.'show_attachments','')}}";
        $(document).ready(function () {
            AssignUploaderAttachments();
        });

    </script>

@endsection



