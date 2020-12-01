<?php

namespace App\Http\Controllers;

use App\Mail\Confirmation_mail;
use App\Mail\Payment_mail;
use App\Models\Delegate;
use Illuminate\Http\Request;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\DB;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\Mail;

class DelegateController extends Controller
{
    public function index()
    {
        $delegates = DB::table('delegates')->where('deleted', '=', 0)->get()->all();

        return view('delegates.index', compact('delegates'));
    }

    public function room_print(Request $request)
    {
        if ($request->selected == null) {
            return redirect()->back()->with(['error' => 'Please Select Exactly 2 Delegates!']);
        }
        if (count($request->selected) > 2) {
            return redirect()->back()->with(['error' => 'Please Select Exactly 2 Delegates!']);
        }

        $data = array();
        $counter = 0;

        foreach ($request->selected as $iValue) {
            $id_front = DB::table('delegates')->where('id', '=', $iValue)->select('id_front')->get()->first();
            $id_back = DB::table('delegates')->where('id', '=', $iValue)->select('id_back')->get()->first();
            $data[$counter] = $id_front->id_front;
            $data[++$counter] = $id_back->id_back;
            $counter++;
        }
        //dd($data);
        $pdf = PDF::loadView('delegates.myPDF', compact('data'));
        return $pdf->download('room.pdf');
//        return redirect()->back()->with(['success' => 'Room Printed Successfully!']);
    }

    public function mark_paid(Request $request)
    {
        $error_free = true;
        $error_indexes = array();
        if ($request->selected == null) {
            return redirect()->back()->with(['error' => 'Please Select Delegate(s) To Mark Them!']);
        }
        $counter = 0;
        foreach ($request->selected as $i => $iValue) {
            $delegate = DB::table('delegates')->where('id', '=', $iValue);
            if ($delegate->get()->first()->received_payment_mail == 1) {
                $delegate->update(['paid' => 1]);
            } else {
                $error_free = false;
                $error_indexes[$counter++] = $i + 1;
            }
        }
        if ($error_free) {
            return redirect()->back()->with(['success' => 'Delegate(s) Marked Paid Successfully!']);
        }
        $error_message = 'Delegate(s):';
        foreach ($error_indexes as $iValue) {
            $error_message .= $iValue . ', ';
        }
        $error_message .= 'Did\'t Receive Payment Mail to be Checked Paid';
        return redirect()->back()->with(['error' => $error_message]);
    }

    public function mark_unpaid(Request $request)
    {
        if ($request->selected == null) {
            return redirect()->back()->with(['error' => 'Please Select Delegate(s) To Mark Them!']);
        }
        foreach ($request->selected as $iValue) {
            $delegate = DB::table('delegates')->where('id', '=', $iValue);
            $delegate->update(['paid' => 0]);
        }
        return redirect()->back()->with(['success' => 'Delegate(s) Marked Unpaid Successfully!']);
    }

    public function send_confirmation_mail(Request $request)
    {
//        $markdown = new Markdown(view(), config('mail.markdown'));

//        return $markdown->render('emails.confirmation_mail',['qr'=>"https://chart.googleapis.com/chart?chs=150x150&chld=L|0&cht=qr&chl=" . route('read_qr_code', $request->selected[0]) . "&choe=UTF-8",'name'=>'Seif']);
        $error_free = true;
        $error_index = array();
        if ($request->selected == null) {
            return redirect()->back()->with(['error' => 'Please Selected Delegates(s) To Send Confirmation Email to!']);
        }
        $iMax = count($request->selected);
        $counter = 0;
        for ($i = 0; $i < $iMax; $i++) {
            $delegate_email = DB::table('delegates')->where('id', '=', $request->selected[$i])->select('email')->first();
            $qr = "https://chart.googleapis.com/chart?chs=150x150&chld=L|0&cht=qr&chl=" . route('read_qr_code', $request->selected[$i]) . "&choe=UTF-8";
            $mail_data = ['name' => DB::table('delegates')->where('id', '=', $request->selected[$i])->select('name')->first()->name, 'qr' => $qr];
            Mail::to($delegate_email)->send(new Confirmation_mail($mail_data));
            if (count(Mail::failures()) !== 0) {
                $error_free = false;
                $error_index[$counter++] = $i + 1;
            } else {
                DB::table('delegates')->where('id', '=', $request->selected[$i])->update(['received_confirmation_mail' => 1]);
            }
        }
        if ($error_free) {
            return redirect()->back()->with(['success' => 'Emails were sent Successfully!']);
        }
        $error_message = 'Delegate(s):';
        for ($i = 0, $iMax = count($error_index); $i < $iMax; $i++) {
            $error_message .= $error_index[$i] . ', ';
        }
        $error_message .= 'Didn\'t Receive Emails';
        return redirect()->back()->with(['error' => $error_message]);
    }

    public function send_payment_mail(Request $request)
    {
        $error_free = true;
        $error_index = array();
        if ($request->selected == null) {
            return redirect()->back()->with(['error' => 'Please Selected Delegates(s) To Send Confirmation Email to!']);
        }
        $counter = 0;
        for ($i = 0, $iMax = count($request->selected); $i < $iMax; $i++) {
            $delegate_email = DB::table('delegates')->where('id', '=', $request->selected[$i])->get()->first();
            $mail_data = ['delegate' => DB::table('delegates')->where('id', '=', $request->selected[$i])->get()->first()];
            Mail::to($delegate_email)->send(new Payment_mail($mail_data));
            if (count(Mail::failures()) !== 0) {
                $error_free = false;
                $error_index[$counter++] = $i + 1;
            } else {
                DB::table('delegates')->where('id', '=', $request->selected[$i])->update(['received_payment_mail' => 1]);
            }
        }
        if ($error_free) {
            return redirect()->back()->with(['success' => 'Emails were sent Successfully!']);
        }
        $error_message = 'Delegate(s):';
        for ($i = 0, $iMax = count($error_index); $i < $iMax; $i++) {
            $error_message .= $error_index[$i] . ', ';
        }
        $error_message .= 'Didn\'t Receive Emails';
        return redirect()->back()->with(['error' => $error_message]);
    }

    public function read_qr_code($id)
    {
        $delegate = DB::table('delegates')->where('id', '=', $id);
        $delegate_data = $delegate->get()->first();
        if ($delegate == null) {
            return redirect()->route('delegates.index')->with(['error' => 'This QR code is invalid!']);
        }

        if ($delegate_data->checked_in == 1) {
            $delegate->update(['meals_counter' => ++$delegate_data->meals_counter]);
            return redirect()->route('delegates.index')->with(['success' => 'Delegate Received A Meal Successfully!']);
        }

        $delegate->update([
            'checked_in' => 1,
        ]);

        return redirect()->route('delegates.index')->with(['success' => 'Delegate Has Been Checked-In Successfully!']);
    }

    public function delete_delegate(Request $request)
    {
        if ($request->selected == null) {
            return redirect()->back()->with(['error' => 'Please Select Delegates to be Deleted!']);
        }
        foreach ($request->selected as $iValue) {
            DB::table('delegates')->where('id', '=', $iValue)->update(['deleted' => 1]);
        }
        return redirect()->back()->with(['success' => 'Delegate(s) Deleted Successfully!']);
    }

    public function edit_delegate(Request $request)
    {
        if ($request->selected == null) {
            return redirect()->back()->with(['error', 'Please Select a Delegate To Be Edited!']);
        }
        if (count($request->selected) > 1) {
            return redirect()->back()->with(['error', 'Please Select Only One Delegate!']);
        }
        $delegate = DB::table('delegates')->where('id', '=', $request->selected[0])->get()->first();
        return view('delegates.edit', compact('delegate'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email',
            'dob' => 'required',
            'phone_number' => 'required|max:11',
        ]);
        if ($request->id_front == null && $request->id_back != null) {
            $id_back = $request->id_back->getClientOriginalName();
            $request->id_back->storeAs('ids', $id_back, 'public');
            DB::table('delegates')->where('id', '=', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'phone_number' => $request->phone_number,
                'id_back' => $request->id_back->getClientOriginalName(),
                'allergies' => $request->allergies,
                'lc' => $request->lc,
                'role' => $request->role,
                'function' => $request->function,
            ]);
            return redirect()->route('delegates.index')->with(['success' => 'Delegate Updated Successfully!']);
        }
        if ($request->id_back == null && $request->id_front != null) {
            $id_front = $request->id_front->getClientOriginalName();
            $request->id_front->storeAs('ids', $id_front, 'public');
            DB::table('delegates')->where('id', '=', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'phone_number' => $request->phone_number,
                'id_front' => $request->id_front->getClientOriginalName(),
                'allergies' => $request->allergies,
                'lc' => $request->lc,
                'role' => $request->role,
                'function' => $request->function,
            ]);
            return redirect()->route('delegates.index')->with(['success' => 'Delegate Updated Successfully!']);
        }
        if ($request->id_back != null && $request->id_front != null) {
            $id_front = $request->id_front->getClientOriginalName();
            $request->id_front->storeAs('ids', $id_front, 'public');

            $id_back = $request->id_back->getClientOriginalName();
            $request->id_back->storeAs('ids', $id_back, 'public');

            DB::table('delegates')->where('id', '=', $id)->update([
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
                'function' => $request->function,
            ]);
            return redirect()->route('delegates.index')->with(['success' => 'Delegate Updated Successfully!']);
        }
        if ($request->id_back == null && $request->id_front == null) {
            DB::table('delegates')->where('id', '=', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'phone_number' => $request->phone_number,
                'allergies' => $request->allergies,
                'lc' => $request->lc,
                'role' => $request->role,
                'function' => $request->function,
            ]);
            return redirect()->route('delegates.index')->with(['success' => 'Delegate Updated Successfully!']);
        }
    }

    public function get_profile(Request $request)
    {
        if ($request->selected == null) {
            return redirect()->back()->with(['error' => 'Please select Delegate To View His Profile!']);
        }
        if (count($request->selected) > 1) {
            return redirect()->back()->with(['error' => 'Please Select Only one Delegate!']);
        }
        $delegate = DB::table('delegates')->join('payment', 'delegates.id', '=', 'payment.user_id')->where('delegates.id', '=', $request->selected[0])->get()->first();
        if ($delegate == null) {
            $delegate = DB::table('delegates')->where('id', '=', $request->selected[0])->get()->first();
        }
        return view('delegates.profile', compact('delegate'));
    }

    public function mark_checked_in(Request $request)
    {
        $error_indexes = array();
        $error_free = true;
        if ($request->selected == null) {
            return redirect()->back()->with(['error' => 'Please Select Delegate(s) To Mark Them!']);
        }
        $counter = 0;
        for ($i = 0, $iMax = count($request->selected); $i < $iMax; $i++) {
            $delegate = DB::table('delegates')->where('id', '=', $request->selected[$i])->get()->first();

            if ($delegate->paid !== 1) {
                $error_indexes[$counter++] = $i + 1;
                $error_free = false;
            } else {
                DB::table('delegates')->where('id', '=', $request->selected[$i])->update(['checked_in' => 1]);
            }
        }
        if ($error_free) {
            return redirect()->back()->with(['success' => 'Delegate(s) Marked Checked-In Successfully!']);
        }

        $error_message = 'Delegate(s):';
        for ($i = 0, $iMax = count($error_indexes); $i < $iMax; $i++) {
            $error_message .= $error_indexes[$i] . ', ';
        }
        $error_message .= 'Didn\'t Pay to Be Marked Checked-In';
        return redirect()->back()->with(['error' => $error_message]);
    }

    public function mark_unchecked_in(Request $request)
    {
        if ($request->selected == null) {
            return redirect()->back()->with(['error' => 'Please Select Delegate(s) To Mark Them!']);
        }
        foreach ($request->selected as $iValue) {
            DB::table('delegates')->where('id', '=', $iValue)->update(['checked_in' => 0]);
        }
        return redirect()->back()->with(['success' => 'Delegate(s) Marked Unchecked-In Successfully!']);
    }
}
