
@extends('layouts.green_layout')
@section('title')
    | {{ __('Newsletter')}}
@endsection
@section('content')
    <div class="inner_page dashboard">
        <div class="col-xl-12 row">
            @include('layouts.navbars.nav_check')
            <div class="col-xl-9 " style="margin-top: 10px" >
                @include('includes.message')
                <div class="card">
                    <table border="1" cellpadding="20" class="table table-hover">
                    <thead>
                    <tr>
                        <th colspan="8" class="th_title">
                            <span>{{__('Newsletter')}}</span>
                            <a href="{{route('subscribe.create')}}" class="btn btn-create" >  {{ __('title.create_new')}}</a>
                        </th>
                    </tr>
                    <tr >
                        <td></td>
                        <td></td>
                        <td>{{ __('title.title')}}</td>
                        <td>{{ __('title.user_creator')}}</td>
                        <td>{{ __('title.created')}}</td>
                        <td>{{ __('title.sent_at')}}</td>
                        <td>{{ __('title.receivers_count')}}</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($list as $item)
                            <tr class="{{$item->id}}">
                                <td class="btn-td">
                                    @can('delete',$item)
                                    <form action="{{route('subscribe.destroy',$item->id)}}" method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                        <input type="submit" value=""  class="btn btn-danger" title="{{__('title.delete')}}" onclick="return confirm('{{__('title.confirm_delete')}}')">
                                    </form>
                                    @endcan
                                </td>
                                <td class="btn-td">
                                    @if(empty($item->sent_at) && auth()->user()->can('update',$item))
                                        <a href="{{route('subscribe.edit',$item->id)}}" class="btn btn-edit "  title="{{__('title.record_edit')}}"> </a>
                                    @else
                                        <a href="{{route('subscribe.show',$item->id)}}" class="btn btn-show " > </a>
                                    @endif
                                </td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->InsertBy->name}}</td>
                                <td>@if(app()->getLocale() == 'fa')
                                        <div style="direction: ltr"> {{PersianNo(dateConvert::strftime('Y/m/d H:i:s', strtotime($item->created_at)))}}</div>
                                    @else {{$item->created_at}}
                                    @endif</td>
                                <td>@if(app()->getLocale() == 'fa' && !empty($item->sent_at))
                                        <div style="direction: ltr"> {{PersianNo(dateConvert::strftime('Y/m/d H:i:s', strtotime($item->sent_at)))}}</div>
                                    @else {{$item->sent_at}}
                                    @endif</td>
                                <td>{{$item->count_receivers}}</td>
                                <td>@if(!empty($item->sent_at))
                                        <a href="{{route('subscribe_excel',$item->id)}}" class="btn btn-excel" title="{{__('Receivers list')}}"> </a>
                                    @else
                                        @can('delete',$item)
                                            <a href="{{route('subscribe_send',$item->id)}}" class="btn btn-send" title="{{__('Send Newsletter')}}"> </a>
                                        @endcan
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                {{$list->appends(request()->query())->links()}} <!-- PAGINATION-->
                <form method="get" action="{{route('subscribe.index')}}" class="search-form inner_page_box">
                <div class="form-search">
                    <label for="subject">{{ __('title.subject')}}: </label>
                    <input type="text" name="subject" value="{{$request->subject}}" class="form-control"  >
                </div>
                <div class="form-search">
                    <label for="creator">{{ __('title.user_creator')}}: </label>
                    <input type="text" name="creator" value="{{$request->creator}}" class="form-control"  >
                </div>

                <div class="form-search">
                    <label for="date_from">{{ __('title.date_sent_from')}}: </label>
                    <input class="form-control date" name="date_from" type="text" value="{{$request->date_from}}">

                </div>
                <div class="form-search">
                    <label for="date_to">{{ __('title.date_sent_to')}}: </label>
                    <input class="form-control date" name="date_to" type="text" value="{{$request->date_to}}">

                </div>


                <div class="clearfix"></div>
                <input type="submit" value="{{ __('title.search')}}" class="btn btn-primary">
                <a href="{{route('subscribe.index')}}" class="btn btn-reset" >  {{ __('title.reset_filters')}}</a>
            </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    // TODO: fill date picker on selected values
    <script>
    @if(app()->getLocale() == 'fa')
    $(document).ready(function() {
        $(".date").persianDatepicker({
            initialValue: false,
            formatDate: "YYYY-0M-0D",
            // selectedDate:$(this).val()

        });

    });
    @else
     $(".date").datepicker({
        format: 'Y-m-d',
    });
    @endif
</script>
@endsection

