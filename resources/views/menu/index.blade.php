
@extends('layouts.green_layout')
@section('title')
    | {{__("title.menu_list")}}
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
                            <span>{{__('title.Admin_Menus')}}</span>
                            <a href="{{route('menu.create')}}" class="btn btn-create" >  {{ __('title.menu_create')}}</a>
                        </th>
                    </tr>
                    <tr >
                        <td></td>
                        <td></td>
                        <td>{{ __('title.id')}}</td>
                        <td>{{ __('title.title')}}</td>
                        <td>{{ __('title.link')}}</td>
                        <td>{{ __('title.priority')}}</td>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($menus as $menu)
                            <tr class="{{$menu->id}}">
                                <td class="btn-td">
                                    <form action="{{route('menu.destroy',$menu->id)}}" method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                        <input type="submit" value=""  class="btn btn-danger" title="{{__('title.delete')}}" onclick="return confirm('{{__('title.confirm_delete')}}')">
                                    </form>
                                </td>
                                <td class="btn-td">
                                        <a href="{{route('menu.edit',$menu->id)}}" class="btn btn-edit "  title="{{__('title.record_edit')}}"> </a>
                                </td>
                                <td>{{$menu->id}}</td>
                                <td>{{$menu->title}}</td>
                                <td>{{$menu->link}}</td>
                                <td>{{$menu->priority}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
             {{$menus->links()}} <!-- PAGINATION-->
{{--            <h2>{{ __('title.search')}}</h2>--}}
                <form method="'get" action="{{route('menu.index')}}" class="search-form inner_page_box">
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
                <a href="{{route('menu.index')}}" class="btn btn-reset" >  {{ __('title.reset_filters')}}</a>
            </form>
            </div>
        </div>
    </div>
@endsection
