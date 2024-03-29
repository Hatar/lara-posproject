<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Client;
use App\Product;
use App\Order;
use App\User;
use Illuminate\Support\Facades\DB;
class WelcomeController extends Controller
{
    public function index(){
        $products_count = Product::count();
        $clients_count = Client::count();
        $categories_count = Category::count();
        $users_count = User::count();

        $sale_data = Order::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_price) as sum')
        )->groupBy('month')->get();

        return view('dashboard.welcome',compact('products_count','clients_count','categories_count','users_count','sale_data'));
    }
}
