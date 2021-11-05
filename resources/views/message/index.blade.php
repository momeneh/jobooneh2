@extends('layouts.app',  $navbar)

@section('title')
   | {{ __('title.inbox')}}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-11">
            <div class="card">

                <table border="1" cellpadding="20" class="table table-hover">
                    <thead>
                    <tr>
                        <th colspan="6" class="th_title">
                            <span>{{__('title.inbox')}}</span>
                            <a href="{{route($prefix.'message.create')}}" class="btn btn-create" >  {{ __('title.compose')}}</a>
                        </th>
                    </tr>
                    <tr >
                        <td></td>
                        <td></td>
                        <td>{{ __('title.sender')}}</td>
                        <td>{{ __('title.subject')}}</td>
                        <td>{{ __('title.date')}}</td>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($list as $item)
                            <tr class="{{$item->id}}">
                                <td class="btn-td">
                                    <form action="{{route($prefix.'message.destroy',$item->id)}}" method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                        <input type="submit" value=""  class="btn btn-danger" title="{{__('title.delete')}}" onclick="return confirm('{{__('title.confirm_delete')}}')">
                                    </form>
                                </td>
                                <td class="btn-td">
                                    <form action="{{route($prefix.'message.update',$item->id)}}" method="post">
                                        {{method_field('put')}}
                                        {{csrf_field()}}
                                        <input type="submit" value=""  class="btn btn-edit" title="{{__('title.mark_as_read')}}" >
                                    </form>
                                </td>
                                <td><a href="{{route($prefix.'message.show',$item->id)}}" @if(empty($item->read_at))class="font-weight-bold" @endif> {{$item->sender->name}}</a></td>
                                <td><a href="{{route($prefix.'message.show',$item->id)}}" @if(empty($item->read_at))class="font-weight-bold" @endif>{{$item->subject}}</a></td>
                                <td>
                                    {{-- TODO::if date is for today just show the hour --}}
                                    @if(app()->getLocale() == 'fa') <div style="direction: ltr"> {{dateConvert::strftime('Y-m-d H:i:s', strtotime($item->created_at))}}</div>
                                    @else {{$item->created_at}}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        {{$list->appends(request()->query())->links()}} <!-- PAGINATION-->
            <form method="get" action="{{route($prefix.'message.index')}}" class="search-form">
                <div class="form-search">
                    <label for="subject">{{ __('title.subject')}}: </label>
                    <input type="text" name="subject" value="{{$request->subject}}" class="form-control"  >
                </div>
                <div class="form-search">
                    <label for="sender">{{ __('title.sender')}}: </label>
                    <input type="text" name="sender" value="{{$request->sender}}" class="form-control"  >
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
                <a href="{{route($prefix.'message.index')}}" class="btn btn-reset" >  {{ __('title.reset_filters')}}</a>
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

