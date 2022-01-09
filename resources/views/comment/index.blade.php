
@extends('layouts.green_layout')
@section('title')
    | {{__("title.comments")}}
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
                        <th colspan="7" class="th_title">
                            <span>{{__('title.comments')}}</span>
                        </th>
                    </tr>

                    <tr >
                        <td></td>
                        <td></td>
                        <td>{{ __('title.product_title')}}</td>
                        <td>{{ __('title.name')}}</td>
                        <td>{{ __('title.email')}}</td>
                        <td>{{ __('title.body')}}</td>
                        <td>{{ __('title.created')}}</td>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($list as $item)
                            <tr class="{{$item->id}}">
                                <td class="btn-td">
                                    <form action="{{route('comment.destroy',$item->id)}}" method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                        <input type="submit" value=""  class="btn btn-danger" title="{{__('title.delete')}}" onclick="return confirm('{{__('title.confirm_delete')}}')">
                                    </form>
                                </td>
                                <td class="btn-td">
                                    <a href="{{route('comment.show',$item->id)}}" class="btn btn-show " > </a>
                                </td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{substr($item->comment,0,100)}}</td>
                                <td>
                                    @if(app()->getLocale() == 'fa')
                                        <div style="direction: ltr"> {{PersianNo(dateConvert::strftime('Y/m/d H:i:s', strtotime($item->created_at)))}}</div>
                                    @else {{$item->created_at}}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                 {{$list->appends(request()->query())->links()}} <!-- PAGINATION-->
                <form method="'get" action="{{route('comment.index')}}" class="search-form inner_page_box">
                <div class="form-search">
                    <label for="product_title">{{ __('title.product_title')}}: </label>
                    <input type="text" name="product_title" value="{{$request->product_title}}" class="form-control"  >
                </div>
                <div class="form-search">
                    <label for="name">{{ __('title.name')}}: </label>
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
                <a href="{{route('comment.index')}}" class="btn btn-reset" >  {{ __('title.reset_filters')}}</a>
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

