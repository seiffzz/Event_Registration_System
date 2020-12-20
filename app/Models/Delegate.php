<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @method static insert(array $array)
 */
class Delegate extends Model
{
    use HasFactory;

    protected $table = 'delegates';

    public static function get_registered()
    {
        return DB::table('delegates')->where('deleted', '=', 0)->select('name', 'email', 'phone_number', 'gender', 'dob', 'role', 'function', 'allergies',  'paid',  'checked_in' , 'checked_out', 'created_at')->get()->toArray();
    }

    public static function get_paid()
    {
        return DB::table('delegates')->where([['deleted', '=', 0], ['paid', '=', 1]])->select('name', 'email', 'phone_number', 'gender', 'dob', 'role', 'function', 'allergies',  'paid',  'checked_in' , 'checked_out', 'created_at')->get()->toArray();
    }

    public static function get_unpaid()
    {
        return DB::table('delegates')->where([['deleted', '=', 0], ['paid', '=', 0]])->select('name', 'email', 'phone_number', 'gender', 'dob', 'role', 'function', 'allergies',  'paid',  'checked_in' , 'checked_out', 'created_at')->get()->toArray();
    }

}
