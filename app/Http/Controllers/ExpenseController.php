<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Expense;

class ExpenseController extends Controller
{
    function expenses(){
        if(Session::has('user')){
            $title = 'Expenses';
            
            $user_id = Session::get('user')->id;

            if(Session::get('user')->access_level == 1){
                $expenses = Expense::where('expenses.parent_id', $user_id)
                            ->leftJoin('users', 'expenses.user_id', '=', 'users.id')
                            ->select('expenses.*','users.name')->get();
            }elseif(Session::get('user')->access_level == 2){
                $expenses = Expense::where('expenses.user_id', $user_id)
                            ->leftJoin('users', 'expenses.user_id', '=', 'users.id')
                            ->select('expenses.*','users.name')->get();
            }

            return view('expenses', ['expenses' => $expenses,'title'=>$title]);
        }else{
            return redirect('/');
        }
    }
    
    function createExpense(){
        if(Session::has('user')){
            $title = 'Create Expense';
            
            return view('create_expense', ['title'=>$title]);
        }else{
            return redirect('/');
        }
    }

    function saveExpense(Request $request){
        if(Session::has('user')){

            $access_level = Session::get('user')->access_level;
            
            if($access_level == 1){
                $user_id = Session::get('user')->id;
                $parent_id = Session::get('user')->id;
            }elseif($access_level == 2){
                $user_id = Session::get('user')->id;
                $parent_id = Session::get('user')->parent_id;
            }            


            Expense::create([
                'expenditures' => $request->input('expenditures'), 
                'description' => $request->input('description'), 
                'date' => date('Y-m-d'), 
                'expense' => $request->input('expense'), 
                'user_id' => $user_id,
                'parent_id' => $parent_id,
            ]);

            Session::put('success_message', 'Expenditure has logged successfully.');

            return redirect()->back();
        }else{
            return redirect('/');
        }
    }
}
