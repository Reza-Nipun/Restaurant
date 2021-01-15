<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\User;

class RegistrationController extends Controller
{
    function registration(Request $request){

        $user_name = $request->input('user_name');
        $email = $request->input('email');
        $mobile = $request->input('mobile');
        $password = $request->input('password');


        $data["user_name"] = $user_name;
        $data["requested_email"] = $email;

        $user = new User();
        $user->name = $user_name;
        $user->email = $email;
        $user->mobile = $mobile;
        $user->password = Hash::make($password);
        $user->access_level = 1;
        $user->status = 1;
        $user->parent_id = 0;
        $user->reg_approval_status = 2;
        $user->registration_date = date('Y-m-d');
        $user->allow_sub_accounts = 1;
        $user->service_charge = 0;
        $user->vat_percentage = 0;
        $save_res = $user->save();

        if($save_res == 1){
            Mail::send('emails.account_creation_notification', $data, function($message) use($email)
            {
                $message
                    ->to($email)
                    ->from('info@techexpertsbd.com', 'Tech Experts BD')
                    ->subject('Welcome Message - Restaurant POS');
            });
    
            Mail::send('emails.registration_request_notification', $data, function($message)
            {
                $message
                    ->to('nipunsarker56@gmail.com')
                    ->from('info@techexpertsbd.com', 'Tech Experts BD')
                    ->subject('Registration Request - Restaurant POS');
            });

            $request->session()->put('success_message', 'Your restaurant account has been created. Please wait 24-48 Hours for the approval.');

        }else{
            $request->session()->put('flash_message', 'Invalid Email/Password!');
        }

        return redirect('/register');

    }

    function userAvailability(Request $request){
        $email = $request->input('email');

        $res = User::where('email', $email)->get();

        return response()->json($res);
    }
}
