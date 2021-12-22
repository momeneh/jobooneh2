
@extends('layouts.green_layout')
@section('title')
    | {{__("Contact Us")}}
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
                        <th colspan="7" class="th_title">
                            <span>{{__('Contact Us')}}</span>
                        </th>
                    </tr>
                    <tr >
                        <td>{{ __('title.name')}}</td>
                        <td>{{ __('title.email')}}</td>
                        <td>{{ __('title.phone')}}</td>
                        <td>{{ __('title.created')}}</td>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($list as $item)
                            <tr class="{{$item->id}}">

                                <td><a href="{{route('admin.show_contacts',$item->id)}}">{{$item->name}}</a></td>
                                <td><a href="{{route('admin.show_contacts',$item->id)}}">{{$item->email}}</a></td>
                                <td>{{$item->phone}}</td>
                                <td> @if(app()->getLocale() == 'fa') <div style="direction: ltr"> {{dateConvert::strftime('Y-m-d H:i:s', strtotime($item->created_at))}}</div>
                                    @else {{$item->created_at}}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                {{$list->appends(request()->query())->links()}} <!-- PAGINATION-->
                <form method="'get" action="{{route('admin.contacts')}}" class="search-form inner_page_box">
                <div class="form-search">
                    <label for="name">{{ __('title.name')}} : </label>
                    <input type="text" name="name" value="{{$request->name}}" class="form-control"  >
                </div>
                <div class="form-search">
                    <label for="email">{{ __('title.email')}}: </label>
                    <input type="text" name="email" value="{{$request->email}}" class="form-control"  >
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
                <a href="{{route('admin.contacts')}}" class="btn btn-reset" >  {{ __('title.reset_filters')}}</a>
            </form>
            </div>
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

