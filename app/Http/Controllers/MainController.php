<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function about(){
        $this->visit();
        $contact_data = Contact::where('id' , '1')->first();
//        $menu = Menu::get();
        $about = About::where('id' , '1')->first();
        return view('about' , ['contact_data'=>$contact_data , 'data'=>$about]);
    }
    public function contact(){
        $this->visit();
        $contact_data = Contact::where('id' , '1')->first();
//        $menu = Menu::get();
        return view('contact' , ['contact_data'=>$contact_data ]);
    }
}
