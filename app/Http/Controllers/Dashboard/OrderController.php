<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
class OrderController extends Controller
{
    public function index(){

        $orders = Order::paginate(5);
        return view('dashboard.orders.index',compact('orders'));

    }
}
