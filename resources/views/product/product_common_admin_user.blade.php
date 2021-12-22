

    <div class="card">

        <table border="1" cellpadding="20" class="table table-hover" id=" list">
            <thead>
            <tr>
                <th colspan="10" class="th_title">
                    <span>{{__('title.products')}}</span>
                    <a href="{{route($r.'.create')}}" class="btn btn-create" >  {{ __('title.create_new')}}</a>
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
                <td>{{ __('title.stock')}}</td>
                <td>{{ __('title.price')}}</td>
            </tr>
            </thead>
            <tbody>

            @foreach($list as $item)
                <tr class="{{$item->id}}">
                    <td class="btn-td">
                        <form action="{{route($r.'.destroy',$item->id)}}" method="post">
                            {{method_field('delete')}}
                            {{csrf_field()}}
                            <input type="submit" value=""  class="btn btn-danger" title="{{__('title.delete')}}" onclick="return confirm('{{__('title.confirm_delete')}}')">
                        </form>
                    </td>
                    <td class="btn-td">
                        <a href="{{route($r.'.edit',$item->id)}}" class="btn btn-edit "  title="{{__('title.record_edit')}}"> </a>
                    </td>
                    <td>{{$item->id}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->owner->name}}</td>
                    <td>{{$item->category->title}}</td>
                    <td>{{$item->confirmed === 1 ? __('title.yes') : __('title.no')}}
                        @if (Auth::guard('admin')->check())
                        @if ($r == 'product' && $item->confirmed !== 1 &&  (empty($item->notified_at) || $item->notified_at < Carbon::now()->subHours(48)))
                            <a href="" class="confirm_user btn-light tim-icons icon-bell-55" id="{{$item->id}}" title="{{__('title.not_confirm_reason')}}"></a> @endif
                        @endif
                    </td>
                    <td>{{__('title.sell_status_'.$item->sell_status)}}</td>
                    <td><a href="{{route('productCountLog',$item->id)}}">{{$item->count}}</a></td>
                    <td>{{$item->price}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$list->appends(request()->query())->links()}} <!-- PAGINATION-->
    <form method="'get" action="{{route($r.'.index')}}" class="search-form inner_page_box ">
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
        <a href="{{route($r.'.index')}}" class="btn btn-reset" >  {{ __('title.reset_filters')}}</a>
    </form>


    <div id="dialog-form" title="{{__('title.not_confirm_reason')}}" class="hidden">
        <form>
            <div class="form-search">
                <fieldset>
                    <label for="description">{{__('title.message_body')}}</label>
                    <textarea name="description"  id="description" class="form-control" ></textarea>
                    <input type="hidden" id="dialog_id_product" name="id_product">

                    <input type="submit" tabindex="-1" style="position:absolute; top:-1000px" class="btn btn-primary">
                </fieldset>
            </div>
        </form>
    </div>

