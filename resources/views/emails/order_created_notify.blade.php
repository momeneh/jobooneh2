@extends('emails.order_common_part')
@section('message_part')
    {{__('messages.owner_order_desc',['shopper'=>$shopper])}}
    <br>
    <div class="row " style="margin: 10px">
        <a class="btn btn-success" href="{{route('confirm_order',$order->id)}}" style="margin: 0 5px">{{__('confirm the order')}}</a><br>
        <a class="btn btn-danger" href="{{route('order_problem',$order->id)}}">{{__('describe the problems')}}</a>
    </div>
    <br>
@endsection
