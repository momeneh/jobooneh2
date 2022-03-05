@extends('layouts.green_layout')
@section('title')
    | {{ $record->title}}
@endsection
@section('meta_keyword') , {{ $record->title}} @endsection
@section('meta_description') . {{ substr($record->body,0,1000) }} @endsection
@section('content')
    <div class="inner_page">
        <div class="col-xl-8 col-lg-5 col-md-5 co-sm-l2 inner_page_box" >
            <div >
                <p>
            {!! $record->body !!}</p>
            </div>
        </div>
    </div>
@endsection
