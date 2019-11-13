<?php

namespace App\Http\Controllers\Dashboard\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client,App\Order,App\Category;
class OrderController extends Controller
{
    public function create(Client $client){
        $categories = Category::with('products')->get();
        return view('dashboard.clients.orders.create',compact('client','categories'));
    }

    public function store(Request $request,Client $client){

    }

    public function edit(Client $client,Order $order){

    }

    public function update(Request $request,Client $client,Order $order){

    }

    public function destroy(Client $client,Order $order){

    }
}
