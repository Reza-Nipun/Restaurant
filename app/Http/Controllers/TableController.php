<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Table;

class TableController extends Controller
{
    public function index(){
        if(Session::has('user')){
            $title = 'Tables';

            $user_id = Session::get('user')->id;

            $tables = Table::where('user_id', '=', $user_id)->get();

            return view('table_list', ['tables' => $tables, 'title'=>$title]);
        }else{
            return redirect('/');
        }
    }

    public function createTable(){
        if(Session::has('user')){
            $title = 'Tables';

            $user_id = Session::get('user')->id;

            return view('create_table', ['title'=>$title]);
        }else{
            return redirect('/');
        }
    }

    public function saveTable(Request $request){
        $this->validate($request, [
            'table' => 'required',
        ]);

        $user_id = Session::get('user')->id;

        $table = new Table();
        $table->table = $request->table;
        $table->user_id = $user_id;
        $table->save();

        Session::put('success_message', 'Successfully Saved!');

        return redirect()->back();
    }
}