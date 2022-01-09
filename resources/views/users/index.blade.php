
@extends('layouts.green_layout')
@section('title')
    | {{__("title.Admin_users")}}
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
                        <th colspan="8" class="th_title">
                            <span>{{__('title.Admin_users')}}</span>
                        </th>
                    </tr>
                    <tr >
                        <td></td>
                        <td></td>
                        <td>{{ __('title.id')}}</td>
                        <td>{{ __('title.name')}}</td>
                        <td>{{ __('title.email')}}</td>
                        <td>{{ __('title.created')}}</td>
                        <td>{{ __('title.mobile')}}</td>
                        <td>{{ __('title.job_title')}}</td>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach( $list as $item)
                        <tr class="{{$item->id}}">
                            <td class="btn-td">
                                <form action="{{route('user.destroy',$item->id)}}" method="post">
                                    {{method_field('delete')}}
                                    {{csrf_field()}}
                                    <input type="submit" value=""  class="btn btn-danger" title="{{__('title.delete')}}" onclick="return confirm('{{__('title.confirm_delete')}}')">
                                </form>
                            </td>
                            <td class="btn-td">
                                <a href="{{route('user.edit',$item->id)}}" class="btn btn-edit "  title="{{__('title.record_edit')}}"> </a>
                            </td>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>
                                @if(app()->getLocale() == 'fa') <div style="direction: ltr"> {{dateConvert::strftime('Y-m-d H:i:s', strtotime($item->created_at))}}</div>
                                @else {{$item->created_at}}
                                @endif
                            </td>
                            <td>{{$item->mobile_no}}</td>
                            <td>{{$item->job_title}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$list->appends(request()->query())->links()}} <!-- PAGINATION-->
            {{--            <h2>{{ __('title.search')}}</h2>--}}
                <form method="'get" action="{{route('user.index')}}" class="search-form inner_page_box">
                <div class="form-search">
                    <label for="id">{{ __('title.id')}}: </label>
                    <input type="text" name="id" value="{{$request->id}}" class="form-control"  >
                </div>
                <div class="form-search">
                    <label for="title">{{ __('title.name')}}: </label>
                    <input type="text" name="name" value="{{$request->name}}" class="form-control"  >
                </div>
                <div class="form-search">
                    <label for="title">{{ __('title.email')}}: </label>
                    <input type="text" name="email" value="{{$request->email}}" class="form-control"  >
                </div>
                <div class="form-search">
                    <label for="verified">{{ __('title.verified')}}: </label>
                    <select  name="verified"  class="form-control"  >
                        <option value="">{{__('title.select_one')}}</option>
                        <option value="1" {{!empty($request->verified) && $request->verified == 1 ? 'selected = selected' : ''}}>{{__('title.yes')}}</option>
                        <option value="2" {{!empty($request->verified) && $request->verified == 2 ? 'selected = selected' : ''}}>{{__('title.no')}}</option>
                    </select>
                </div>

                <div class="clearfix"></div>
                <input type="submit" value="{{ __('title.search')}}" class="btn btn-primary">
                <a href="{{route('user.index')}}" class="btn btn-reset" >  {{ __('title.reset_filters')}}</a>
            </form>

        </div>
    </div>
@endsection
