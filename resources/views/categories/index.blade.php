
@extends('layouts.green_layout')
@section('title')
    | {{__("title.categories")}}
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
                            <span>{{__('title.categories')}}</span>
                            <a href="{{route('product_category.create')}}" class="btn btn-create" >  {{ __('title.create_new')}}</a>
                        </th>
                    </tr>
                    <tr >
                        <td width="10"></td>
                        <td width="10 "></td>
                        <td width="10">{{ __('title.id')}}</td>
                        <td>{{ __('title.title')}}</td>
                        <td>{{ __('title.active')}}</td>
                        <td>{{ __('title.icon')}}</td>
                        <td>{{ __('title.parent_id')}}</td>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($list as $item)
                            <tr class="{{$item->id}}">
                                <td class="btn-td">
                                    <form action="{{route('product_category.destroy',$item->id)}}" method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                        <input type="submit" value=""  class="btn btn-danger" title="{{__('title.delete')}}" onclick="return confirm('{{__('title.confirm_delete')}}')">
                                    </form>
                                </td>
                                <td class="btn-td">
                                        <a href="{{route('product_category.edit',$item->id)}}" class="btn btn-edit "  title="{{__('title.record_edit')}}"> </a>
                                </td>
                                <td>{{$item->id}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->is_active === 1 ? __('title.yes') : __('title.no')}}</td>
                                <td>@if (!empty($item->icon))<img alt="category icon " src="{{asset('/category_icons/'.$item->icon)}}" style="height: 50px;background-color: #052501"> @endif</td>
                                <td>{{!empty($item->parent->title) ? $item->parent->title : ''}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                {{$list->appends(request()->query())->links()}} <!-- PAGINATION-->
                <form method="'get" action="{{route('product_category.index')}}" class="search-form inner_page_box">
                <div class="form-search">
                    <label for="id">{{ __('title.id')}} : </label>
                    <input type="text" name="id" value="{{$request->id}}" class="form-control"  >
                </div>
                <div class="form-search">
                    <label for="title">{{ __('title.title')}}: </label>
                    <input type="text" name="title" value="{{$request->title}}" class="form-control"  >
                </div>
                <div class="form-search">
                    <label for="active">{{ __('title.active')}}: </label>
                    <select  name="active"  class="form-control"  >
                        <option value="">{{__('title.select_one')}}</option>
                        <option value="1" {{!empty($request->active) && $request->active == 1 ? 'selected = selected' : ''}}>{{__('title.yes')}}</option>
                        <option value="2" {{!empty($request->active) && $request->active == 2 ? 'selected = selected' : ''}}>{{__('title.no')}}</option>
                    </select>
                </div>
                <div class="form-search">
                    <label for="parent_id">{{ __('title.parent_id')}}:  </label>
                    <select id="parent_id" class="form-control" name="parent_id"  autofocus>
                        <option value="">{{__('title.select_one')}}</option>
                        @foreach($parents as $item)
                            <option value="{{$item->id}}" {{!empty($request->parent_id) && $request->parent_id == $item->id? 'selected = selected' : ''}}>{{$item->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="clearfix"></div>
                <input type="submit" value="{{ __('title.search')}}" class="btn btn-primary">
                <a href="{{route('product_category.index')}}" class="btn btn-reset" >  {{ __('title.reset_filters')}}</a>
            </form>
            </div>
        </div>
    </div>
@endsection
