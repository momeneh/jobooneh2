@extends('layouts.green_layout')
@section('title')
    | {{__("title.orders")}}
@endsection
@section('content')
    <div class="inner_page dashboard">
        <div class="col-xl-12 row">
            @include('layouts.navbars.nav_check')
            <div class="col-xl-9 " style="margin-top: 10px" >
                @include('includes.message')
                    <table border="1" cellpadding="20" class="table table-hover inner_page_box">
                    <thead>
                    <tr>
                        <th colspan="10" class="th_title">
                            <span>{{__('title.requested_orders')}}</span>
                        </th>
                    </tr>
                    <tr >
                        <td width="10"></td>
                        <td>{{ __('title.id')}}</td>
                        <td>{{ __('title.seller')}}</td>
                        <td>{{ __('title.shopper')}}</td>
                        <td>{{ __('title.sum_price')}}</td>
                        <td>{{ __('title.post_price_2')}}</td>
                        <td>{{ __('title.price')}}</td>
                        <td>{{ __('title.owner_confirmed')}}</td>
                        <td>{{ __('title.post_tracking_number')}}</td>
                        <td>{{ __('title.created')}}</td>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($list as $item)
                            <tr class="{{$item->id}}">

                                <td class="btn-td">
                                    <a href="{{route('order_edit',$item->id)}}" class="btn btn-edit "  title="{{__('title.record_edit')}}"> </a>
                                </td>
                                <td>{{$item->id}}</td>
                                <td>{{$item->seller2->name}}</td>
                                <td>{{$item->shopper->name}}</td>
                                <td>{{number_format($item->sum_price_pros)}}</td>
                                <td>{{number_format($item->post_price)}}</td>
                                <td>{{number_format($item->final_price)}}</td>
                                <td>{{$item->owner_confirmed === 1 ? __('title.yes') : __('title.no')}}</td>
                                <td>{{$item->post_tracking_number}}</td>
                                <td>
                                    @if(app()->getLocale() == 'fa') <div style="direction: ltr"> {{dateConvert::strftime('Y-m-d H:i:s', strtotime($item->created_at))}}</div>
                                    @else {{$item->created_at}}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$list->appends(request()->query())->links()}} <!-- PAGINATION-->
                <form method="get" action="{{route('requested_orders')}}" class="search-form inner_page_box">
                <div class="form-search">
                    <label for="seller">{{ __('title.seller')}}: </label>
                    <input type="text" name="seller" value="{{$request->seller}}" class="form-control"  >
                </div>
                <div class="form-search">
                    <label for="shopper">{{ __('title.shopper')}}: </label>
                    <input type="text" name="shopper" value="{{$request->shopper}}" class="form-control"  >
                </div>

                <div class="form-search">
                    <label for="owner_confirmed">{{ __('title.owner_confirmed')}}: </label>
                    <select  name="owner_confirmed"  class="form-control"  >
                        <option value="">{{__('title.select_one')}}</option>
                        <option value="1" {{!empty($request->owner_confirmed) && $request->owner_confirmed == 1 ? 'selected = selected' : ''}}>{{__('title.yes')}}</option>
                        <option value="2" {{!empty($request->owner_confirmed) && $request->owner_confirmed == 2 ? 'selected = selected' : ''}}>{{__('title.no')}}</option>
                    </select>
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
                <a href="{{route('requested_orders')}}" class="btn btn-reset" >  {{ __('title.reset_filters')}}</a>
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

