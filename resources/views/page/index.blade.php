
@extends('layouts.green_layout')
@section('title')
    | {{__("title.Admin_pages")}}
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
                        <th colspan="6" class="th_title">
                            <span>{{__('title.Admin_pages')}}</span>
                            <a href="{{route('page.create')}}" class="btn btn-create" >  {{ __('title.create_new')}}</a>
                        </th>
                    </tr>
                    <tr >
                        <td width="10"></td>
                        <td width="10"></td>
                        <td>{{ __('title.id')}}</td>
                        <td>{{ __('title.title')}}</td>
                        <td>{{ __('title.body')}}</td>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach( $list as $item)
                            <tr class="{{$item->id}}">
                                <td class="btn-td">
                                    <form action="{{route('page.destroy',$item->id)}}" method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                        <input type="submit" value=""  class="btn btn-danger" title="{{__('title.delete')}}" onclick="return confirm('{{__('title.confirm_delete')}}')">
                                    </form>
                                </td>
                                <td class="btn-td">
                                        <a href="{{route('page.edit',$item->id)}}" class="btn btn-edit "  title="{{__('title.record_edit')}}"> </a>
                                </td>
                                <td>{{$item->id}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->body}}...</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                {{$list->links()}} <!-- PAGINATION-->
{{--            <h2>{{ __('title.search')}}</h2>--}}
                <form method="'get" action="{{route('page.index')}}" class="search-form inner_page_box">
                <div class="form-search">
                    <label for="id">{{ __('title.id')}}: </label>
                    <input type="text" name="id" value="{{$request->id}}" class="form-control"  >
                </div>
                <div class="form-search">
                    <label for="title">{{ __('title.title')}}: </label>
                    <input type="text" name="title" value="{{$request->title}}" class="form-control"  >
                </div>

                <div class="clearfix"></div>
                <input type="submit" value="{{ __('title.search')}}" class="btn btn-primary">
                <a href="{{route('page.index')}}" class="btn btn-reset" >  {{ __('title.reset_filters')}}</a>
            </form>

        </div>
    </div>
@endsection
