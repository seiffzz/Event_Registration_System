<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Delegate;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{

    public function home()
    {
        $events = Event::all()->toArray();
        return view('home', compact('events'));
    }

    public function index()
    {
        $events = Event::all()->toArray();
        return view('events.index', compact('events'));
    }

    public function single($id)
    {
        $event = DB::table('events')->where('id', '=', $id)->get()->toArray();
        return view('events.single', compact('event'));
    }

    public function save(EventRequest $request)
    {

        $file_name = $request->event_image->getClientOriginalName();

        $request->event_image->storeAs('event_images', $file_name, 'public');
        Event::insert([
            'name' => $request->event_name,
            'price' => $request->event_price,
            'capacity' => $request->event_capacity,
            'location' => $request->event_location,
            'time' => $request->event_time,
            'cover_image' => $request->event_image->getClientOriginalName()
        ]);
        return redirect()->route('events')->with(['success' => 'Event Added Successfully!']);
    }

    public function delete($id)
    {
        DB::table('events')->delete($id);
        return redirect()->back()->with(['success' => 'Event Deleted Successfully!']);
    }

    public function register(Request $request, $event)
    {

        $id_front = $request->id_front->getClientOriginalName();
        $request->id_front->storeAs('ids', $id_front, 'public');

        $id_back = $request->id_back->getClientOriginalName();
        $request->id_back->storeAs('ids', $id_back, 'public');

        $request->validate([
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|unique:delegates,email',
            'dob' => 'required',
            'phone_number' => 'required|max:11',
            'id_front' => 'required|mimes:jpeg,png,jpg|max:1024',
            'id_back' => 'required|mimes:jpeg,png,jpg|max:1024',
        ]);

        Delegate::insert([
            'name' => $request->name,
            'email' => $request->email,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'id_front' => $request->id_front->getClientOriginalName(),
            'id_back' => $request->id_back->getClientOriginalName(),
            'allergies' => $request->allergies,
            'lc' => $request->lc,
            'role' => $request->role,
            'function' => $request->role == 'Member' || $request->role == 'LCP' || $request->role == 'Newbei' ? null : $request->function,
            'event' => $event
        ]);
        $message = 'success';
        return view('confirmation', compact('message'));
    }

    public function pay(Request $request, $id)
    {
        $transaction_receipt = $request->transaction_receipt->getClientOriginalName();
        $request->transaction_receipt->storeAs('receipts', $transaction_receipt, 'public');
        DB::table('payment')->insert([
            'user_id' => $id,
            'payment_method' => $request->payment_method,
            'transaction_receipt' => $request->transaction_receipt->getClientOriginalName(),
            'transaction_number' => $request->transaction_number
        ]);
        $message = 'We Received Your Payment Confirmation!';
        return view('confirmation', compact('message'));
    }
}
