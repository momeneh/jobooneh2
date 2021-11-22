<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ParentBasketController extends Controller
{
    //auth->id is not set when routing an interface so I could not use the interface name in route/web.php
    //but auth->id is set when type hint and date inject the interface so i had to
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
        $basket->Index($request);
    }
}
