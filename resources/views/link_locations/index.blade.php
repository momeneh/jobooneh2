
@extends('layouts.app', ['admin' => 1])

{{--@extends('layouts.main')--}}
@section('title')
   | {{ __('title.links_location')}}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-11">
            <div class="card">


                <table border="1" cellpadding="20" class="table table-hover">
                    <thead>
                    <tr>
                        <th colspan="6" class="th_title">
                            <span>{{__('title.links')}}</span>
                            <a href="{{route('link_locations.create')}}" class="btn btn-create" >  {{ __('title.create_new')}}</a>
                        </th>
                    </tr>
                    <tr >
                        <td></td>
                        <td></td>
                        <td>{{ __('title.id')}}</td>
                        <td>{{ __('title.title')}}</td>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($list as $item)
                            <tr class="{{$item->id}}">
                                <td class="btn-td">
                                    <form action="{{route('link_locations.destroy',$item->id)}}" method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                        <input type="submit" value=""  class="btn btn-danger" title="{{__('title.delete')}}" onclick="return confirm('{{__('title.confirm_delete')}}')">
                                    </form>
                                </td>
                                <td class="btn-td">
                                        <a href="{{route('link_locations.edit',$item->id)}}" class="btn btn-edit "  title="{{__('title.record_edit')}}"> </a>
                                </td>
                                <td>{{$item->id}}</td>
                                <td>{{$item->title}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
             {{$list->links()}} <!-- PAGINATION-->
{{--            <h2>{{ __('title.search')}}</h2>--}}
            <form method="'get" action="{{route('link_locations.index')}}" class="search-form">
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
                <a href="{{route('link_locations.index')}}" class="btn btn-reset" >  {{ __('title.reset_filters')}}</a>
            </form>

        </div>
    </div>
@endsection
