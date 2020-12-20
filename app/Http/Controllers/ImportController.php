<?php

namespace App\Http\Controllers;

use App\Imports\AcceptedDelegateImport;
use App\Mail\Confirmation_mail;
use App\Mail\RegistrationMail;
use App\Models\AcceptedDelegate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

class ImportController extends Controller
{
    public function import(Request $request)
    {
        if ($request->hasFile('file')) {
            $collection = (new FastExcel)::import($request->file('file')->getRealPath());
            $errors = [];
            $counter = 0;
            foreach ($collection as $key => $row) {
                try {
                    AcceptedDelegate::insert(['name' => $row['name'], 'email' => $row['email'], 'role' => $row['role'], 'phone_number' => $row['phone_number']]);
                } catch (\Exception $e) {
                    if (!str_contains($e->getMessage(), 'Duplicate entry')) {
                        $errors[$counter++] = $row['name'];
                    }
                    continue;
                }
            }
            if (count($errors) > 0) {
                return redirect()->back()->with(['warning' => $errors]);
            }

            return redirect()->back()->with(['success' => 'Success!']);
        }
        return redirect()->back()->with(['error' => 'Error!']);
    }

    public function send_emails(Request $request)
    {
        $error_free = true;
        $error_index = array();
        if ($request->selected == null) {
            return redirect()->back()->with(['error' => 'Please Selected Delegates(s) To Send Registration Email To!']);
        }
        $iMax = count($request->selected);
        $counter = 0;
        for ($i = 0; $i < $iMax; $i++) {
            $received_mail = DB::table('accepted_delegates')->where('id', '=', $request->selected[$i])->select('received_mail')->first()->received_mail;
            $delegate_email = DB::table('accepted_delegates')->where('id', '=', $request->selected[$i])->select('email')->first();

            $mail_data = ['delegate' => DB::table('accepted_delegates')->where('id', '=', $request->selected[$i])->get()->first()];
            if ($received_mail != 1) {
                Mail::to($delegate_email)->queue(new RegistrationMail($mail_data));
            }
            if (count(Mail::failures()) !== 0) {
                $error_free = false;
                $error_index[$counter++] = $i + 1;
            } else {
                DB::table('accepted_delegates')->where('id', '=', $request->selected[$i])->update(['received_mail' => 1]);
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

    public function delete(Request $request)
    {
        if ($request->selected == null) {
            return redirect()->back()->with(['error' => 'Please Select Delegates to be Deleted!']);
        }
        foreach ($request->selected as $iValue) {
            DB::table('accepted_delegates')->where('id', '=', $iValue)->update(['deleted' => 1]);
        }
        return redirect()->back()->with(['success' => 'Delegate(s) Deleted Successfully!']);
    }

    public function edit(Request $request)
    {
        if ($request->selected == null) {
            return redirect()->back()->with(['error' => 'Please Select a Delegate To Be Edited!']);
        }
        if (count($request->selected) > 1) {
            return redirect()->back()->with(['error' => 'Please Select Only One Delegate!']);
        }
        $accepted_delegate = DB::table('accepted_delegates')->where('id', '=', $request->selected[0])->get()->first();
        return view('imports.edit', compact('accepted_delegate'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'email' => 'required|email',
                'received_mail' => 'required|numeric|min:0|max:1',
                'phone_number' => 'required|max:11'
            ]);
        DB::table('accepted_delegates')->where('id', '=', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'received_mail' => $request->received_mail,
        ]);
        return redirect()->route('imports.index')->with(['success' => 'Delegate(s) Updated Successfully!']);
    }
}
