<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

use App\User;

class UserController extends Controller
{
    function login(Request $request){
        $date = date('Y-m-d');

        $user = User::where(['email'=>$request->email, 'status'=>1])->first();

        if(!$user || !Hash::check($request->password, $user->password))
        {
            $request->session()->put('flash_message', 'Invalid Email/Password!');
            return redirect("/");
        }else{

            if($user->reg_approval_status == 1){
                $request->session()->put('user', $user);

                $array = array(
                    'last_login_date' => $date,
                );
    
                User::where('id', $user->id)->update($array);
    
                return redirect("/dashboard");
            }elseif($user->reg_approval_status == 2){
                $request->session()->put('success_message', 'Please wait for the approval of your registration!');
                return redirect("/");
            }elseif($user->reg_approval_status == 0){
                $request->session()->put('flash_message', 'Sorry, your registration request is denied!');
                return redirect("/");
            }

        }
    }

    function dashboard(){

        if(Session::has('user')){
            $title = 'Dashboard';
            
            return view('dashboard', ['title'=>$title]);
        }else{
            return redirect('/');
        }

    }

    function registrationRequests(){
        if(Session::has('user')){
            $title = 'Registration Requests';

            $registration_requests = User::where('reg_approval_status', 2)->get();

            return view('registration_requests', ['registration_requests'=>$registration_requests, 'title'=>$title]);
        }else{
            return redirect('/');
        }
    }

    function updateRegistrationInfo($id, Request $request){
        if(Session::has('user')){
        
            $user_name = $request->input('name');
            $email = $request->input('email');
            $account_valid_till = $request->input('account_valid_till');
            $service_charge = $request->input('service_charge');

            $array = array(
                'allow_sub_accounts' => $request->input('allow_sub_accounts'),
                'account_valid_till' => $account_valid_till,
                'reg_approval_status' => $request->input('registration_status'),
                'status' => $request->input('status'),
                'reg_approval_date' => date('Y-m-d'),
                'service_charge' => $service_charge,
            );

            $res = User::where('id', $id)->update($array);

            if($res == 1){
                $data["user_name"] = $user_name;

                if($request->input('registration_status') == 0){
                    $data["account_status"] = 'denied. Currently, we are not allowing any new accounts. Thank you for your interest.';
                }

                if($request->input('registration_status') == 1){
                    $data["account_status"] = "approved. Your account validate till: $account_valid_till , Yearly Service Charge: $service_charge BDT";
                }

                if($request->input('registration_status') == 2){
                    $data["account_status"] = 'pending, we are verifying your request. Please wait 24-48 Hours for the approval';
                }

                Mail::send('emails.account_approval_notification', $data, function($message) use($email)
                {
                    $message
                        ->to($email)
                        ->from('info@techexpertsbd.com', 'Tech Experts BD')
                        ->subject('Welcome Message - Restaurant POS');
                });
            }

        
            return redirect('/registration_requests');
        }else{
            return redirect('/');
        }
    }

    function users(){
        if(Session::has('user')){
            $title = 'Users';

            $users = User::where('access_level', 1)->where('reg_approval_status', 1)->get();

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

    function createSalesAccount(){
        if(Session::has('user')){
            $title = 'Create Sales Account';

            return view('create_sales_account', ['title'=>$title]);
        }else{
            return redirect('/');
        }
    }

    function saveSalesAccount(Request $request){
        $parent_id = Session::get('user')->id;
        $reg_approval_status = Session::get('user')->reg_approval_status;
        $registration_date = Session::get('user')->registration_date;
        $reg_approval_date = Session::get('user')->reg_approval_date;
        $service_charge = Session::get('user')->service_charge;

        $name = $request->input('name');
        $email = $request->input('email');
        $status = $request->input('status');
        $phone = $request->input('phone');
        $mobile = $request->input('mobile');
        $receipt_note = $request->input('receipt_note');
        $address = $request->input('address');
        $password = $request->input('password');
        $vat_percentage = $request->input('vat_percentage');

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->mobile = $mobile;
        $user->phone = $phone;
        $user->password = Hash::make($password);
        $user->access_level = 2;
        $user->status = $status;
        $user->parent_id = $parent_id;
        $user->reg_approval_status = $reg_approval_status;
        $user->reg_approval_date = $reg_approval_date;
        $user->registration_date = $registration_date;
        $user->allow_sub_accounts = 0;
        $user->service_charge = $service_charge;
        $user->vat_percentage = $vat_percentage;
        $user->address = $address;
        $user->receipt_note = $receipt_note;
        $save_res = $user->save();

        return redirect('/sales_accounts');
    }

    function expenses(){
        if(Session::has('user')){
            echo $title = 'Expenses';

            // return view('expenses', ['title'=>$title]);
        }else{
            return redirect('/');
        }
    }

    function editRegistrationRequest($id){
        if(Session::has('user')){
            $title = 'Edit Registration Request';

            $data = User::find($id);

            return view('edit_registration_request', ['title'=>$title, 'user_info'=>$data]);
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
        Session::put('success_message', 'Successfully Logout!');

        return redirect('/');
    }
}
