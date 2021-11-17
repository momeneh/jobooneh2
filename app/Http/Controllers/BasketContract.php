<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;

interface BasketContract
{
    public function store(Request $request);
    public function update(Request $request, $id);
    public function destroy($id,Request $request);
    public function IsBasket($id);
    public function Index(Request $request);

}
