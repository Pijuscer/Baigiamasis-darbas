<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Camp;
use App\Models\Camp_rezervation;
use App\Models\User_profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CampRezervationController extends Controller
{
    public function store(Request $request, $id){
        //$allEventParticipants = Event_rezervation::where("user_profile_id", User_profile::where("user_id", Auth::user()->id)->first()->id);
        
        // Get the user's profile
        $userProfile = User_profile::where("user_id", Auth::user()->id)->first();
        
        //dd(!Event_rezervation::where("user_profile_id", $userProfile->id)->first());
        if(!Camp_rezervation::where("user_profile_id", $userProfile->id)->first() &&
        Camp::where("id", $id)->first()->camp_number_of_participants > 0
        ){
            $camp_rezervation=Camp_rezervation::create([
                'event_id' => $id,
                'user_profile_id' => User_profile::where("user_id", Auth::user()->id)->first()->id
                
            ]);


            $camp = Camp::where("id", $id)->first();
            $camp->camp_number_of_participants =  $camp->camp_number_of_participants - 1;
            $camp->save();

            return redirect()->back()->with('message_reservation', 'Sėkmingai rezervavotes laiką!');
        }

        
    
    return redirect()->back()->with('message_reservation', 'Esate jau dalyvis šiame renginyje!');
    }

    /*public function index(){
        if(Auth::user()->roles != 'Vartotojas'){
            $event_rezervations = Event_rezervation::all();
            $users = User_profile::all();
            $event = event::all();
        }
        else{
            $event_rezervations = Event_rezervation::where("user_profile_id", User_profile::where("user_id", Auth::user()->id)->first()->id)->get();
            $user = User_profile::where("user_id", Auth::user()->id)->first();
            //$event = event::where("id", $event_rezervations->event_id)->;
            $event = event::all();
            $users = array($user);
            
        }

        return view('events_rezervations', compact( 'users', 'event_rezervations', 'event' ));
        
    }*/

    public function index() {
        // Check if the user is not a regular "Vartotojas" user
        if(Auth::user()->roles != 'Vartotojas'){
            // Admin or other roles: fetch all event reservations, users, and events
            $camp_rezervations = Camp_rezervation::all();
            $users = User_profile::all();
            $camp = Camp::all(); // Correct capitalization
        } 
        else {
            // Fetch the user profile for the logged-in user
            $user = User_profile::where("user_id", Auth::user()->id)->first();
    
            // Check if the user profile exists
            if ($user) {
                // Fetch event reservations for this user profile
                $camp_rezervations = Camp_rezervation::where("user_profile_id", $user->id)->get();
                
                // If no reservations found, redirect or handle gracefully
                if ($camp_rezervations->isEmpty()) {
                    // Option 1: Redirect to a different page with a message
                    return redirect()->route('dashboard')->with('error', 'Jūs neturite rezervacijų į renginius.');
    
                    // Option 2: Alternatively, show a message within the same view
                    // You can send an empty event or handle it in the view as a message.
                    // Uncomment the below lines if you prefer this:
                    // $event_rezervations = [];
                    // $event = []; // No events if no reservations
                    // return view('events_rezervations', compact('users', 'event_rezervations', 'event'))->with('message', 'Jūs neturite rezervacijų į renginius.');
                }
    
                // Fetch all events related to the reservations
                $camp = Camp::all(); // Fetch all events for now
                $users = [$user]; // Wrap the user in an array for the view
            } 
            else {
                // If the user profile does not exist, handle the error (e.g., redirect)
                return redirect()->route('dashboard')->with('error', 'Vartotojo profilis nerastas.');
            }
        }
    
        // Return the view with relevant data
        return view('camps_rezervations', compact('users', 'camp_rezervations', 'camp'));
    }
}
