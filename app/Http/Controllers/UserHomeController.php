<?php

namespace App\Http\Controllers;

use App\About;
use App\Contact;
use App\Http\Controllers\Controller;

use App\Menu;
use App\User;
use Carbon\Carbon;
use Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserHomeController extends Controller
{

    public function profile()
    {
        if (!Auth::user())
            return redirect()->route('index');

        $user = Auth::user();
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();
        return view('user.profile', ['contact_data' => $contact_data, 'menu' => $menu , 'user' => $user]);
    }

    public function updateProfile(Request $request)
    {
        if (!Auth::user())
            return redirect()->route('index');

        $user = Auth::user();

        $request->validate([
            'name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'mobile' => 'max:11|min:11|required|unique:users,mobile,' . $user->id,
            'email' => 'email|required|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $this->securityItem($request->name),
            'last_name' => $this->securityItem($request->last_name),
            'mobile' => $this->securityItem($request->mobile),
            'email' => $this->securityItem($request->email),
        ]);

        if ($request['password'])
            $user->update(['password' => bcrypt($request['password']),]);

        return redirect()->back()->with('success', 'بروزرسانی با موفقیت انجام شد');
    }


    public function myCourse()
    {
        $user = Auth::user();
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();
        return view('user.course', ['contact_data' => $contact_data, 'menu' => $menu , 'user' => $user]);
    }

    public function myProducts()
    {
        $user = Auth::user();
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();
        return view('user.products', ['contact_data' => $contact_data, 'menu' => $menu , 'user' => $user]);
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
