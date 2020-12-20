<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function edit_room_number(Request $request, $id)
    {

        DB::table('rooms')->where('id', '=', $id)->update(['room_number' => (int)$request->room_number]);
        return redirect()->back()->with(['success' => 'Room Updated Successfully!']);
    }

    public function view_room($id)
    {
        $room = DB::table('rooms')->where('id', '=', $id)->get()->first();
        $checked_out = false;
        if ($room->capacity == 2) {
            $delegate1 = DB::table('delegates')->where('id', '=', $room->delegate1)->get()->first();
            $delegate2 = DB::table('delegates')->where('id', '=', $room->delegate2)->get()->first();

            if ($delegate1->checked_out == 1 && $delegate2->checked_out == 1) {
                $checked_out = true;
            }
            $data = ['room' => $room, 'delegate1' => $delegate1, 'delegate2' => $delegate2, 'checked_out' => $checked_out];
        } else if ($room->capacity == 1) {
            $delegate = DB::table('delegates')->where('id', '=', $room->delegate1)->get()->first();
            if ($delegate->checked_out == 1) {
                $checked_out = true;
            }
            $data = ['room' => $room, 'delegate1' => $delegate, 'checked_out' => $checked_out];
        }

        return view('rooms.view', compact('data'));
    }

    public function print_room($id)
    {
        $room = DB::table('rooms')->where('id', '=', $id)->get()->first();
        $data = array();
        if ($room->capacity == 2) {
            $id_front1 = DB::table('delegates')->where('id', '=', $room->delegate1)->select('id_front')->get()->first();
            $id_back1 = DB::table('delegates')->where('id', '=', $room->delegate1)->select('id_back')->get()->first();
            $id_front2 = DB::table('delegates')->where('id', '=', $room->delegate2)->select('id_front')->get()->first();
            $id_back2 = DB::table('delegates')->where('id', '=', $room->delegate2)->select('id_back')->get()->first();
            $data[0] = $id_front1->id_front;
            $data[1] = $id_back1->id_back;
            $data[2] = $id_front2->id_front;
            $data[3] = $id_back2->id_back;
        } elseif ($room->capacity == 1) {
            $id_front = DB::table('delegates')->where('id', '=', $room->delegate1)->select('id_front')->get()->first();
            $id_back = DB::table('delegates')->where('id', '=', $room->delegate1)->select('id_back')->get()->first();
            $data[0] = $id_front->id_front;
            $data[1] = $id_back->id_back;
        }

        //dd($data);
        $pdf = PDF::loadView('delegates.myPDF', compact('data'));
        return $pdf->download('room.pdf');
    }

    public function mark_room($id)
    {
        DB::table('rooms')->where('id', '=', $id)->update(['checked_out' => 1]);
        return redirect()->back()->with(['success' => 'Room Checked-out Successfully!']);
    }

    public function mark_check_out($id)
    {
        DB::table('delegates')->where('id', '=', $id)->update(['checked_out' => 1]);
        return redirect()->back()->with(['success' => 'Delegate Marked Successfully!']);
    }

    public function create_room(Request $request)
    {
        if ($request->selected == null) {
            return redirect()->back()->with(['error' => 'Please Select Exactly 2 Delegates!']);
        }
        if (count($request->selected) > 2) {
            return redirect()->back()->with(['error' => 'Please Select Exactly 2 Delegates!']);
        }
        if (count($request->selected) != 1) {
            $delegate1_gender = DB::table('delegates')->where('id', '=', $request->selected[0])->select('gender')->get()->first()->gender;
            $delegate2_gender = DB::table('delegates')->where('id', '=', $request->selected[1])->select('gender')->get()->first()->gender;
            if ($delegate1_gender != $delegate2_gender) {
                return redirect()->back()->with(['error' => 'Cannot Room Delegates With Different Genders!']);
            }
        }
        if (count($request->selected) == 2) {
            Room::insert([
                'capacity' => 2,
                'delegate1' => $request->selected[0],
                'delegate2' => $request->selected[1],
            ]);
            return redirect()->back()->with(['success' => 'Room Created Successfully!']);
        }
        if (count($request->selected) == 1) {
            Room::insert([
                'capacity' => 1,
                'delegate1' => $request->selected[0]
            ]);
            return redirect()->back()->with(['success' => 'Room Created Successfully!']);
        }
    }
}
