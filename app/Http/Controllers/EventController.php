<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\event;
use Illuminate\Http\Request;

class EventController extends Controller
{


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
            'event_address' => 'required|max:225|',
            'event_date' => 'required',
            'event_foto' => 'required',
            'more_info' => 'required',
            'longitude_coordinate' => 'required',
            'latitude_coordinate' => 'required',

        ]);

        $events = $request->file('event_foto')->store('event_foto', 'public');
        

        event::create([
            'event_name' => request('event_name'),
            'event_address' => request('event_address'),
            'event_date' => request('event_date'),
            'event_foto' => $events,
            'more_info' => request('more_info'),
            'longitude_coordinate' => request('longitude_coordinate'),
            'latitude_coordinate' => request('latitude_coordinate')
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
                'event_address' => 'required|max:225|',
                'event_date' => 'required',
                'event_foto' => '',
                'more_info' => 'required',
                'longitude_coordinate' => 'required|max:225|',
                'latitude_coordinate' => 'required|max:225|',
        
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
            $events->event_address = request('event_address');
            $events->event_date = request('event_date');
            if ($path !== "" && $path !== null) {
                $events->event_foto = $path;
            }
            $events->more_info = request('more_info');
            $events->longitude_coordinate = request('longitude_coordinate');
            $events->latitude_coordinate = request('latitude_coordinate');
            $events->save();
    
            return redirect('/all_events')->with('message_events_edit', 'Jūs sėkmingai redagavote įrašą!');
        }
}
