<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Product;
use App\Table;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{

    public function pendingSellList(){
        if(Session::has('user')){
            $title = 'Pending Sale List';

            $user_id = Session::get('user')->id;
            $parent_id = Session::get('user')->parent_id;

            $pending_list = DB::table('sales_summary')
                            ->leftJoin('customers', 'sales_summary.customer_id', '=', 'customers.id')
                            ->leftJoin('tables', 'sales_summary.table_id', '=', 'tables.id')
                            ->select('sales_summary.*', 'customers.customer_code', 'tables.table')
                            ->get();

            return view('pending_sale_list', ['title'=>$title, 'pending_list'=>$pending_list]);
        }else{
            return redirect('/');
        }
    }

    public function saleProduct(){
        if(Session::has('user')){
            $title = 'Sale Product';

            $user_id = Session::get('user')->id;

            $products = Product::where('user_id', '=', $user_id)->where('status', 1)->get();
            $tables = Table::where('user_id', '=', $user_id)->get();

            return view('sale_product', ['products' => $products, 'tables' => $tables, 'title'=>$title]);
        }else{
            return redirect('/');
        }
    }
}
