<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Hash;
use Auth;

class UsersController extends Controller
{
    public function passwordChangeView()
    {
    	return view('users.create');
    }

    public function passwordChange(Request $request)
    {
    	$this->validate($request,[
            'old_password'      => ['required', 'string', 'min:8'],
            'new_password'      => ['required', 'string', 'min:8'],
            'confirmed_password'  => ['required', 'string', 'min:8'],
        ]);
        $old_password       = $request->old_password;
        $new_password       = $request->new_password;
        $confirm_password   = $request->confirmed_password;
        
        if(Auth::check()){
            if($new_password == $confirm_password){
                $current_password = Auth::user()->password;
                if(Hash::check($old_password, $current_password))
                {
                    $id             = Auth::user()->id;
                    $user           = User::findOrFail($id);
                    $user->password = Hash::make($new_password);
                    $user->save(); 
                    return redirect()->back()->with('success', 'Passowrd Updated!');
                }
            }else{
                return redirect()->back()->with('error','New Password and Confirm password not matching!');
            }
        }else{
            return redirect('/login');
        }
    }
}
