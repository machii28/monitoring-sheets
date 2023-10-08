<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'processes';


    protected $fillable = [
        'name'
    ];
}
