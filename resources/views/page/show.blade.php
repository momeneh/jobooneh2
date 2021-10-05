@extends('layouts.green_layout')
@section('title')
    | {{ $record->title}}
@endsection

@section('content')
    <div class="inner_page">
        <div class="col-xl-8 col-lg-5 col-md-5 co-sm-l2" style="margin: auto">
            <div class="inner_page_box">
                <p>
            {!! $record->body !!}</p>
            </div>
        </div>
    </div>
@endsection
