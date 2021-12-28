@extends('emails.order_common_part')
@section('message_part')
    {{__('messages.order_confirmed')}}
    <br>
    <br>
@endsection
