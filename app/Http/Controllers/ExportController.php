<?php

namespace App\Http\Controllers;

use App\Exports\DelegateExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export_registered()
    {
        return Excel::download(new DelegateExport, 'ASPIRE\'20-Registered.xlsx');
    }

    public function export_paid()
    {
        return Excel::download(new DelegateExport, 'ASPIRE\'20-Paid.xlsx');
    }

    public function export_unpaid()
    {
        return Excel::download(new DelegateExport, 'ASPIRE\'20-Unpaid.xlsx');
    }
}
