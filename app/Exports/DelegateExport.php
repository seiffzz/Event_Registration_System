<?php

namespace App\Exports;

use App\Models\Delegate;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DelegateExport implements FromCollection,WithHeadings
{

    public function headings():array
    {
        return [
            'Name',
            'Email',
            'Phone_number',
            'Gender',
            'Date Of Birth',
            'Role',
            'Function',
            'Allergies',
            'Received Payment Mail',
            'Paid',
            'Received Confirmation Mail',
            'Checked-In'
        ];
    }

    public function collection()
    {
        if (Route::currentRouteName() ==='exports.export_registered') {
            return collect(Delegate::get_registered());
        }

        if (Route::currentRouteName() === 'exports.export_paid') {
            return collect(Delegate::get_paid());
        }

        if (Route::currentRouteName() === 'exports.export_unpaid') {
            return collect(Delegate::get_unpaid());
        }

    }
}
