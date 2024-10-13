<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\event;
use App\Models\User_profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class EventController extends Controller
{

    // Show metodas
    public function show($id)
    {
        // Surandame konkretų renginį pagal jo ID
        $event = Event::findOrFail($id);

        // Grąžiname vaizdą su platesne informacija apie renginį
        //return view('show', compact('event'));

        // Get the authenticated user's ID
        $userId = Auth::user()->id;
    
        // Find the user's profile by user ID and check if it is verified
        $userProfile = User_profile::where('user_id', $userId)->first();
    
        if ($userProfile && $userProfile->verified) {
            // If the profile is verified, retrieve all events
            $events = Event::all();
            
            // Return the view with the events
            return view('show_event', compact('event'));
        }
        // Return the view with the events
        return view('show_event', compact('event'));
    
        // If not verified, redirect back
        return redirect()->back()->with('error', 'Your profile is not verified.');
    }
    
    //Atvaizduojami iš DB pasirinkimai pagrindiniame lange
    public function eventsAll(Request $request)
    {
        // If the profile is verified, retrieve all events
        $events = Event::all();

        // Get the authenticated user's ID
        if(Auth::user()){
            $userId = Auth::user()->id;
             // Find the user's profile by user ID and check if it is verified
            $userProfile = User_profile::where('user_id', $userId)->first();

             // Return the view with the events
             return view('events', compact('events', "userProfile"));
        }
        
    
        //if ($userProfile && $userProfile->verified) {
            
            // Return the view with the events
            return view('events', compact('events'));
        //}
    
        // If not verified, redirect back
        return redirect()->back()->with('error', 'Your profile is not verified.');
    }

    public function index(){
        $events = event::all();
        return view('all_events', compact('events'));
        
    }

    public function viewForm(){
        $events = event::all();
        return view('add_event', ['add_event' => $events]);

    }

    public function store(Request $request){
        
        $validated = $request -> validate([
            'event_name' => 'required|max:225|',
            'event_organizer' => 'required|max:225|',
            'event_address' => 'required|max:225|',
            'event_date' => 'required',
            'event_foto' => 'required',
            'event_more_info' => 'required',
            'event_number_of_participants' => 'required',
            'event_longitude_coordinate' => 'required',
            'event_latitude_coordinate' => 'required',

        ]);

        $events = $request->file('event_foto')->store('event_foto', 'public');
        

        event::create([
            'event_name' => request('event_name'),
            'event_organizer' => request('event_organizer'),
            'event_address' => request('event_address'),
            'event_date' => request('event_date'),
            'event_foto' => $events,
            'event_more_info' => request('event_more_info'),
            'event_number_of_participants' => request('event_number_of_participants'),
            'event_longitude_coordinate' => request('event_longitude_coordinate'),
            'event_latitude_coordinate' => request('event_latitude_coordinate')
        ]);

       

        return redirect('/add_event')->with('message_event_add', 'Sėkmingai pridėjote įrašą!');
    }

        
        public function editForm($id){
            $events = event::where('id', $id)->firstOrFail();
    
            return view('edit_event', compact("events"));
        }
    
        public function edit(Request $request, $id){
        
             $validated = $request -> validate([
                'event_name' => 'required|max:225|',
                'event_organizer' => 'required|max:225|',
                'event_address' => 'required|max:225|',
                'event_date' => 'required',
                'event_foto' => '',
                'event_more_info' => 'required',
                'event_number_of_participants' => 'required|max:225|',
                'event_longitude_coordinate' => 'required|max:225|',
                'event_latitude_coordinate' => 'required|max:225|',
        
             ]);

             $path = "";
             // Handle the file upload if a new file is provided
            if ($request->hasFile('event_foto')) {
                // Store the new file and save its path
                $path = $request->file('event_foto')->store('event_photos', 'public');
                
            }
             
            $events = event::where('id', $id)->firstOrFail();

            //$request->file('event_foto')->store('event_foto', 'public');

            $events->event_name = request('event_name');
            $events->event_organizer = request('event_organizer');
            $events->event_address = request('event_address');
            $events->event_date = request('event_date');
            if ($path !== "" && $path !== null) {
                $events->event_foto = $path;
            }
            $events->event_more_info = request('event_more_info');
            $events->event_number_of_participants = request('event_number_of_participants');
            $events->event_longitude_coordinate = request('event_longitude_coordinate');
            $events->event_latitude_coordinate = request('event_latitude_coordinate');
            $events->save();
    
            return redirect('/all_events')->with('message_events_edit', 'Jūs sėkmingai redagavote įrašą!');
        }

        public function removeForm($id){
            $events = event::where('id', $id)->firstOrFail(); 
    
            return view('remove_working_days]',compact("freedom"));
        }
        public function remove($id){
            $events = event::where('id', $id)->firstOrFail();
            $events->delete();
    
            return redirect('/all_events')->with('message_freedom_delete', 'Sėkmingai ištrynėte!');
        }
}
