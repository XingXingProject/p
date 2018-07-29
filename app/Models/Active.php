<?php

namespace App\Models;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Database\Eloquent\Model;

class Active extends Model
{
    public $fillable=['title','content','start_time','end_time'];

}
