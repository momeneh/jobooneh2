
@extends('layouts.app', ['admin' => 1])

{{--@extends('layouts.main')--}}
@section('title')
   | {{ __('title.products')}}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-11">
            <div class="card">


                <table border="1" cellpadding="20" class="table table-hover">
                    <thead>
                    <tr>
                        <th colspan="9" class="th_title">
                            <span>{{__('title.products')}}</span>
                            <a href="{{route('product.create')}}" class="btn btn-create" >  {{ __('title.create_new')}}</a>
                        </th>
                    </tr>
                    <tr >
                        <td></td>
                        <td></td>
                        <td>{{ __('title.id')}}</td>
                        <td>{{ __('title.title')}}</td>
                        <td>{{ __('title.owner')}}</td>
                        <td>{{ __('title.categories')}}</td>
                        <td>{{ __('title.confirmed')}}</td>
                        <td>{{ __('title.sell_status')}}</td>
                        <td>{{ __('title.price')}}</td>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($list as $item)
                            <tr class="{{$item->id}}">
                                <td class="btn-td">
                                    <form action="{{route('product.destroy',$item->id)}}" method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                        <input type="submit" value=""  class="btn btn-danger" title="{{__('title.delete')}}" onclick="return confirm('{{__('title.confirm_delete')}}')">
                                    </form>
                                </td>
                                <td class="btn-td">
                                        <a href="{{route('product.edit',$item->id)}}" class="btn btn-edit "  title="{{__('title.record_edit')}}"> </a>
                                </td>
                                <td>{{$item->id}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->owner->name}}</td>
                                <td>{{$item->category->title}}</td>
                                <td>{{$item->confirmed === 1 ? __('title.yes') : __('title.no')}}</td>
                                <td>{{__('title.sell_status_'.$item->sell_status)}}</td>
                                <td>{{$item->price}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        {{$list->appends(request()->query())->links()}} <!-- PAGINATION-->
            <form method="'get" action="{{route('product.index')}}" class="search-form">
                <div class="form-search">
                    <label for="id">{{ __('title.id')}} : </label>
                    <input type="text" name="id" value="{{$request->id}}" class="form-control"  >
                </div>
                <div class="form-search">
                    <label for="title">{{ __('title.title')}}: </label>
                    <input type="text" name="title" value="{{$request->title}}" class="form-control"  >
                </div>
                <div class="form-search">
                    <label for="owner">{{ __('title.owner')}}: </label>
                    <input type="text" name="owner" value="{{$request->owner}}" class="form-control"  >
                </div>

                <div class="form-search">
                    <label for="active">{{ __('title.confirmed')}}: </label>
                    <select  name="active"  class="form-control"  >
                        <option value="">{{__('title.select_one')}}</option>
                        <option value="1" {{!empty($request->active) && $request->active == 1 ? 'selected = selected' : ''}}>{{__('title.yes')}}</option>
                        <option value="2" {{!empty($request->active) && $request->active == 2 ? 'selected = selected' : ''}}>{{__('title.no')}}</option>
                    </select>
                </div>
                <div class="clearfix"></div>
                <div class="form-search">
                    <label for="parent_id">{{ __('title.categories')}}:  </label>
                    <select id="parent_id" class="form-control" name="categories_id"  autofocus>
                        <option value="">{{__('title.select_one')}}</option>
                        @foreach($categories as $item)
                            <option value="{{$item->id}}" {{!empty($request->categories_id) && $request->categories_id == $item->id? 'selected = selected' : ''}}>{{$item->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-search">
                    <label for="sell_status">{{ __('title.sell_status')}}:  </label>
                    <select id="sell_status" class="form-control" name="sell_status"  autofocus>
                        <option value="">{{__('title.select_one')}}</option>
                        @for ($i = 1; $i < 3; $i++)
                            <option value="{{$i}}" {{!empty($request->sell_status) && $request->sell_status == $i? 'selected = selected' : ''}}>{{__('title.sell_status_'.$i)}}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-search">
                    <label for="price">{{ __('title.price')}}: </label>
                    <input type="text" name="price" value="{{$request->price}}" class="form-control"  >
                </div>
                <div class="clearfix"></div>
                <input type="submit" value="{{ __('title.search')}}" class="btn btn-primary">
                <a href="{{route('product.index')}}" class="btn btn-reset" >  {{ __('title.reset_filters')}}</a>
            </form>

        </div>
    </div>
@endsection
