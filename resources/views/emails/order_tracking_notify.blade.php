@extends('emails.order_common_part')
@section('message_part')
    {{__('messages.order_tracking_number',['order_id'=>$order->id,'tracking_number'=>$order->post_tracking_number])}}
    <br>
    <br>

@endsection
