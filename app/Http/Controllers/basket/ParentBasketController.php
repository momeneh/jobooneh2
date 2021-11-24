<?php

namespace App\Http\Controllers\basket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ParentBasketController extends Controller
{
    //auth->id is not set when routing an interface so I could not use the interface name in route/web.php
    //but auth->id is set when type hint and data inject the interface so i had to
    //make this controller as a second route between basket and tmpBasket

    public function store(Request $request,BasketContract $basket)
    {
        $basket->store($request);
    }

    public function update(Request $request, $id,BasketContract $basket)
    {
        $basket->update($request,$id);
    }

    public function destroy($id,Request $request,BasketContract $basket){
        $basket->destroy($id,$request);
    }

    public function Index(Request $request,BasketContract $basket)
    {
        return $basket->Index($request);
    }
}
