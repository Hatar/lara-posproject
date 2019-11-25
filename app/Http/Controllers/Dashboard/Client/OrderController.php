<?php

namespace App\Http\Controllers\Dashboard\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client,App\Order,App\Category,App\Product;
class OrderController extends Controller
{
    public function create(Client $client){
        $categories = Category::with('products')->get();
        return view('dashboard.clients.orders.create',compact('client','categories'));
    }

    public function store(Request $request,Client $client){
        $request->validate([
            'products'=>'required|array'
        ]);

        //Create Order by Client
        $order = $client->orders()->create([]);

        $total_price =0;

        foreach($request->products as $id=>$quantity){

            $product = Product::FindOrFail($id);
            $total_price +=$product->sale_price;
             //Update Stock of Product
            $product->update([
                'stock'=>$product->stock - $quantity['quantity']
            ]);
        }//End foreach

        $order->update([
            'total_price'=>$total_price
        ]);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.orders.index');

    }

    public function edit(Client $client,Order $order){

    }

    public function update(Request $request,Client $client,Order $order){

    }

    public function destroy(Client $client,Order $order){

    }
}
