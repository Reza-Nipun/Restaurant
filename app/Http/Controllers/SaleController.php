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

    public function addNewItemRow(){
        $u_id = Session::get('user')->id;
        $parent_id = Session::get('user')->parent_id;

        $user_id=0;

        if($parent_id == 0){
            $user_id = $u_id;
        }
        
        if($parent_id > 0){
            $user_id = $parent_id;
        }


        $products = Product::where('user_id', $user_id);

        $new_row = '';

        $new_row .= '<tr>';
        $new_row .= '<td class="text-center">
                        <input class="form-control" 
                            list="customers" name="product_name" id="product_name">

                        <datalist id="customers">
                            <option value="0">Edge</option>
                            <option value="Firefox">Firefox</option>
                            <option value="Chrome">Chrome</option>
                            <option value="Opera">Opera</option>
                            <option value="Safari">Safari</option>
                        </datalist>
                    </td>';
        $new_row .= '<td class="text-center"><input type="text" class="form-control" name="price" id="price" readonly="readonly" /></td>';
        $new_row .= '<td class="text-center"><input type="number" class="form-control" name="quantity" id="quantity" /></td>';
        $new_row .= '<td class="text-center"><input type="text" class="form-control" name="total_price" id="total_price" readonly="readonly" /></td>';
        $new_row .= '<td class="text-center">
                        <span class="btn btn-sm btn-danger" title="Remove Item">
                            <i class="fa fa-archive" aria-hidden="true"></i>
                        </span>
                     </td>';
        $new_row .= '</tr>';

        foreach($products as $p){
            
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
