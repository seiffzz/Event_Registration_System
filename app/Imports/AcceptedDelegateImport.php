<?php

namespace App\Imports;

use App\Models\AcceptedDelegate;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

class AcceptedDelegateImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return Model|null
    */
    public function model(array $row)
    {
        dd($row);
    }
}
