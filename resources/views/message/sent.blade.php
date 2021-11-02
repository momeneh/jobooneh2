@extends('layouts.app',  $navbar)

@section('title')
   | {{ __('title.send')}}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-11">
            <div class="card">

                <table border="1" cellpadding="20" class="table table-hover">
                    <thead>
                    <tr>
                        <th colspan="6" class="th_title">
                            <span>{{__('title.sent')}}</span>
                            <a href="{{route($prefix.'message.create')}}" class="btn btn-create" >  {{ __('title.compose')}}</a>
                        </th>
                    </tr>
                    <tr >
                        <td>{{ __('title.receiver')}}</td>
                        <td>{{ __('title.subject')}}</td>
                        <td>{{ __('title.date')}}</td>
                        <td>{{__('title.read_at')}}</td>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($list as $item)
                            <tr class="{{$item->id}}">
                                <td><a href="{{route($prefix.'message.show',$item->id)}}" > {{$item->receiver->name}}</a></td>
                                <td><a href="{{route($prefix.'message.show',$item->id)}}" > {{$item->subject}}</a></td>
                                <td>
                                    {{-- TODO::if date is for today just show the hour --}}
                                    @if(app()->getLocale() == 'fa') <div style="direction: ltr"> {{dateConvert::strftime('Y-m-d H:i:s', strtotime($item->created_at))}}</div>
                                    @else {{$item->created_at}}
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($item->read_at))
                                    @if(app()->getLocale() == 'fa') <div style="direction: ltr"> {{dateConvert::strftime('Y-m-d H:i:s', strtotime($item->read_at))}}</div>
                                    @else {{$item->read_at}}
                                    @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        {{$list->appends(request()->query())->links()}} <!-- PAGINATION-->
            <form method="'get" action="{{route($prefix.'message_sent')}}" class="search-form">
                <div class="form-search">
                    <label for="subject">{{ __('title.subject')}}: </label>
                    <input type="text" name="subject" value="{{$request->subject}}" class="form-control"  >
                </div>
                <div class="form-search">
                    <label for="receiver">{{ __('title.receiver')}}: </label>
                    <input type="text" name="receiver" value="{{$request->receiver}}" class="form-control"  >
                </div>

                <div class="form-search">
                    <label for="date_from">{{ __('title.date_from')}}: </label>
                    <input class="form-control date" name="date_from" type="text" value="{{$request->date_from}}">

                </div>
                <div class="form-search">
                    <label for="date_to">{{ __('title.date_to')}}: </label>
                    <input class="form-control date" name="date_to" type="text" value="{{$request->date_to}}">

                </div>


                <div class="clearfix"></div>
                <input type="submit" value="{{ __('title.search')}}" class="btn btn-primary">
                <a href="{{route($prefix.'message_sent')}}" class="btn btn-reset" >  {{ __('title.reset_filters')}}</a>
            </form>

        </div>
    </div>
@endsection
@section('scripts')
    // TODO: fill date picker on selected vaules
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

