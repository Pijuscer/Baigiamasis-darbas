<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Camp;
use App\Models\User_profile;
use Illuminate\Support\Facades\Auth;

class CampController extends Controller
{

    public function index(){
        $camps = camp::all();
        return view('all_camps', compact('camps'));
        
    }

    public function viewForm(){
        $camps = camp::all();
        return view('add_camp', ['add_camp' => $camps]);

    }

    public function store(Request $request){
        
        $validated = $request -> validate([
            'camp_name' => 'required|max:225|',
            'camp_organizer' => 'required|max:225|',
            'camp_address' => 'required|max:225|',
            'camp_arrival_date' => 'required',
            'camp_leave_date' => 'required',
            'camp_foto' => 'required',
            'camp_more_info' => 'required',
            'camp_number_of_participants' => 'required',
            'camp_longitude_coordinate' => 'required',
            'camp_latitude_coordinate' => 'required',

        ]);

        $camps = $request->file('camp_foto')->store('camp_foto', 'public');
        

        camp::create([
            'camp_name' => request('camp_name'),
            'camp_organizer' => request('camp_organizer'),
            'camp_address' => request('camp_address'),
            'camp_arrival_date' => request('camp_arrival_date'),
            'camp_leave_date' => request('camp_leave_date'),
            'camp_foto' => $camps,
            'camp_more_info' => request('camp_more_info'),
            'camp_number_of_participants' => request('camp_number_of_participants'),
            'camp_longitude_coordinate' => request('camp_longitude_coordinate'),
            'camp_latitude_coordinate' => request('camp_latitude_coordinate')
        ]);

       

        return redirect('/add_camp')->with('message_event_add', 'Sėkmingai pridėjote įrašą!');
    }

    public function editForm($id){
        $camps = camp::where('id', $id)->firstOrFail();

        return view('edit_camp', compact("camps"));
    }

    public function edit(Request $request, $id){
    
         $validated = $request -> validate([
            'camp_name' => 'required|max:225|',
            'camp_organizer' => 'required|max:225|',
            'camp_address' => 'required|max:225|',
            'camp_arrival_date' => 'required',
            'camp_leave_date' => 'required',
            'camp_foto' => '',
            'camp_more_info' => 'required',
            'camp_number_of_participants' => 'required|max:225|',
            'camp_longitude_coordinate' => 'required|max:225|',
            'camp_latitude_coordinate' => 'required|max:225|',
    
         ]);

         $path = "";
         // Handle the file upload if a new file is provided
        if ($request->hasFile('camp_foto')) {
            // Store the new file and save its path
            $path = $request->file('camp_foto')->store('camp_photos', 'public');
            
        }
         
        $camps = camp::where('id', $id)->firstOrFail();

        //$request->file('event_foto')->store('event_foto', 'public');

        $camps->camp_name = request('camp_name');
        $camps->camp_organizer = request('camp_organizer');
        $camps->camp_address = request('camp_address');
        $camps->camp_arrival_date = request('camp_arrival_date');
        $camps->camp_leave_date = request('camp_leave_date');
        if ($path !== "" && $path !== null) {
            $camps->camp_foto = $path;
        }
        $camps->camp_more_info = request('camp_more_info');
        $camps->camp_number_of_participants = request('camp_number_of_participants');
        $camps->camp_longitude_coordinate = request('camp_longitude_coordinate');
        $camps->camp_latitude_coordinate = request('camp_latitude_coordinate');
        $camps->save();

        return redirect('/all_camps')->with('message_events_edit', 'Jūs sėkmingai redagavote įrašą!');
    }


    public function removeForm($id){
        $camps = camp::where('id', $id)->firstOrFail(); 

        return view('remove_working_days]',compact("freedom"));
    }
    public function remove($id){
        $camps = camp::where('id', $id)->firstOrFail();
        $camps->delete();

        return redirect('/all_camps')->with('message_freedom_delete', 'Sėkmingai ištrynėte!');
    }

    //Atvaizduojami iš DB pasirinkimai pagrindiniame lange
    public function campsAll(Request $request)
    {
        // If the profile is verified, retrieve all events
        $camps = camp::all();

        // Get the authenticated user's ID
        if(Auth::user()){
            $userId = Auth::user()->id;
             // Find the user's profile by user ID and check if it is verified
            $userProfile = User_profile::where('user_id', $userId)->first();

             // Return the view with the events
             return view('camps', compact('camps', "userProfile"));
        }
        
    
        //if ($userProfile && $userProfile->verified) {
            
            // Return the view with the events
            return view('camps', compact('camps'));
        //}
    
        // If not verified, redirect back
        return redirect()->back()->with('error', 'Your profile is not verified.');
    }

    // Show metodas
    public function show($id)
    {
        // Surandame konkretų renginį pagal jo ID
        $camp = Camp::findOrFail($id);

        // Grąžiname vaizdą su platesne informacija apie renginį
        //return view('show', compact('event'));

        // Get the authenticated user's ID
        $userId = Auth::user()->id;
    
        // Find the user's profile by user ID and check if it is verified
        $userProfile = User_profile::where('user_id', $userId)->first();
    
        if ($userProfile && $userProfile->verified) {
            // If the profile is verified, retrieve all events
            $camps = Camp::all();
            
            // Return the view with the events
            return view('show_camp', compact('camp'));
        }
        // Return the view with the events
        return view('show_camp', compact('camp'));
    
        // If not verified, redirect back
        return redirect()->back()->with('error', 'Your profile is not verified.');
    }
}
