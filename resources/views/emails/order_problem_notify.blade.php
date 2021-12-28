@extends('emails.order_common_part')
@section('message_part')
    {{__('messages.order_problem_mail',['order_id'=>$order->id])}}
    <br>
    <div style="border: 1px solid;padding: 5px">
        {!! $body_desc !!}
    </div>
    <a class="btn btn-success"  style="margin: 10px" href="{{route('message.index')}}">{{__('title.inbox')}}</a>
    <br>

@endsection
