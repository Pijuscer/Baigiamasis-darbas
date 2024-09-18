<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user_profile;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function index(){
        $user_profiles = user_profile::all();
        return view('all_user_profile', compact('user_profiles'));
        
    }

    public function index2(){
        $user_profiles = user_profile::all();
        return view('my_user_profile', compact('user_profiles'));
        
    }

    /*public function viewForm(){
        if(user_profile::where("user_id", Auth::user()->id)->first()){
             return redirect()->back();
        }
        
        return view('add_user_profile');

    }*/
    public function viewForm(){
        return view('add_user_profile');

    }

    
    public function store(Request $request){
        if(user_profile::where("user_id", Auth::user()->id)->first()){
            return redirect()->back();
        }
        $validated = $request -> validate([
            'user_id',
            'name' => 'required|max:225|regex:/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ]+$/',
            'surname' => 'required|max:225|regex:/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ]+$/',
            'telephone_number' => 'required|max:225',
            'address' => 'required|max:225',
            'additional_information' => 'required|max:225',

        ]);

        user_profile::create([
            'user_id'=> Auth::user()->id,
            'name' => request('name'),
            'surname' => request('surname'),
            'telephone_number' => request('telephone_number'),
            'address' => request('address'),
            'additional_information' => request('additional_information'),
        ]);

        return redirect('/add_user_profile')->with('message_user_profile_add', 'Sėkmingai pridėjote!');
    }
}
