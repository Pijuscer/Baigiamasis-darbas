<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //

    //Atvaizduojama puslapis su picos pridėjimu
    public function viewForm(){
        $events = event::all();
        return view('add_event', ['add_event' => $events]);

    }

    public function store(Request $request){
        
        //Kai forma pateikiama tikrinama validacija 
        $validated = $request -> validate([
            'event_name' => 'required|max:225|',
            'event_address' => 'required|max:225|',
            'event_date' => 'required',
            'event_foto' => 'required',
            'more_info' => 'required',
            'longitude_coordinate' => 'required',
            'latitude_coordinate' => 'required',

        ]);

        //Picu nuotraukos patalpinamos public/storage aplanke direktorijoje(path)
        $events = $request->file('event_foto')->store('event_foto', 'public');
        

        //Sukuriamas įrašas
        event::create([
            'event_name' => request('event_name'),
            'event_address' => request('event_address'),
            'event_date' => request('event_date'),
            'event_foto' => $events,
            'more_info' => request('more_info'),
            'longitude_coordinate' => request('longitude_coordinate'),
            'latitude_coordinate' => request('latitude_coordinate')
        ]);

       

        return redirect('/add_event')->with('message_event_add', 'You have successfully added!');
    }
}
