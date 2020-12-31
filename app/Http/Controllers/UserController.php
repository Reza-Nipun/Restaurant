<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\User;

class UserController extends Controller
{
    function login(Request $request){
        $user = User::where(['email'=>$request->email, 'status'=>1])->first();

        if(!$user || !Hash::check($request->password, $user->password))
        {
            $request->session()->put('flash_message', 'Invalid Email/Password!');
            return redirect("/");
        }else{
            $request->session()->put('user', $user);
            return redirect("/dashboard");
        }
    }

    function dashboard(){

        if(Session::has('user')){
            $title = 'Dashboard';

            return view('dashboard', compact('title'));
        }else{
            return redirect('/');
        }

    }

    function users(){
        if(Session::has('user')){
            $title = 'Users';

            $users = User::where('access_level', 1)->get();

            return view('users', ['users'=>$users, 'title'=>$title]);
        }else{
            return redirect('/');
        }
    }

    function salesAccounts(){
        if(Session::has('user')){
            $title = 'Sales Accounts';

            $sales_accounts = User::where('access_level', 2)->get();

            return view('sales_accounts', ['sales_accounts'=>$sales_accounts, 'title'=>$title]);
        }else{
            return redirect('/');
        }
    }

    function expenses(){
        if(Session::has('user')){
            echo $title = 'Expenses';

            // return view('expenses', ['title'=>$title]);
        }else{
            return redirect('/');
        }
    }

    function editUser($id){
        if(Session::has('user')){
            $title = 'Edit User';

            $data = User::find($id);

            return view('edit_user', ['title'=>$title, 'user_info'=>$data]);
        }else{
            return redirect('/');
        }
    }

    function updateUser($id, Request $request){
        if(Session::has('user')){
        
            $array = array(
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'allow_sub_accounts' => $request->input('allow_sub_accounts'),
                'status' => $request->input('status'),
            );

            User::where('id', $id)->update($array);
        
            return redirect('/users');
        }else{
            return redirect('/');
        }
    }

    function logout(){
        Session::forget('user');

        return redirect('/');
    }
}
