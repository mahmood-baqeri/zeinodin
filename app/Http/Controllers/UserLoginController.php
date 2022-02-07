<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\User;
use Carbon\Carbon;
use Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{

    use AuthenticatesUsers;


    public function authentication(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->back();
        }

        return redirect()->back()->with('error' , 'نام کاربری یا رمز عبور اشتباه است');
    }

    public function register(Request $request)
    {
        if(Auth::user())
            return redirect()->back()->with('error', 'شما قبلا عضو شده اید');

        session()->flash('modalActived', 'registerModal');
        $request->validate([
            'name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'mobile' => 'max:11|min:11|required|unique:users,mobile,',
            'email' => 'email|required|unique:users,email,',
            'password' => ['required'],
        ]);

        User::create([
            'name' => $this->securityItem($request->name),
            'last_name' => $this->securityItem($request->last_name),
            'mobile' => $this->securityItem($request->mobile),
            'email' => $this->securityItem($request->email),
            'password' => bcrypt($request['password']),
            'is_user' => 1,
        ]);

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
        }

        session()->forget('modalActived');

        return redirect()->back()->with('success', 'ثبت نام با موفقیت انجام شد');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->back();
    }


    public function securityItem($item)
    {
        $item = str_replace('<script>', '', "$item");
        $item = str_replace('</script>', '', "$item");
        $item = str_replace('<?php>', '', "$item");
        $item = str_replace('@php', '', "$item");
        return $item;
    }



}
