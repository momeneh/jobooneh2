@extends('layouts.green_layout')
@section('title')
    | {{__("title.Notifications")}}
@endsection
@section('content')
    <div class="inner_page dashboard">
        <div class="col-xl-12 row">
            @include('layouts.navbars.nav_check')
            <div class="col-xl-9 " style="margin-top: 10px" >
                @include('includes.message')
                <div class="card">
                    <div class="card-header">
                      <div class="clearfix">
                          <a href="{{route('destroy_notifications')}}" onclick="return confirm('{{__('title.confirm_delete')}}')" class="alert alert-warning remove_link" >{{__('title.delete_all')}}</a>
                          <h4 class="card-title">{{__('title.Notifications')}}</h4>
                      </div>
                      @foreach($notifications as $notify)
                          <div class="alert alert-success">
                              <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close" onclick="RemoveNotification(this)" route="{{ route('delete_notifications',$notify->id)}}">
                                  <i class="tim-icons icon-simple-remove"></i>
                              </button>
                               <span> <b> {{__('messages.'.$notify->type,['id_product'=> $notify->data['id']??'','desc'=>$notify->data['desc']??'','sender'=>$notify->data['sender']??'','order'=>$notify->data['order_id']??''])}} </span>
                              </div>
                      @endforeach
                    </div>
    </div>
            </div>
        </div>
  </div>
@endsection
@section('scripts')
          <script src="{{ asset('green/js/white.js')}}"></script>
@endsection

