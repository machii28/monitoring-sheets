<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoringSheetCategory extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'monitoring_sheet_categories';

    protected $fillable = [
        'category',
        'abbreviation'
    ];
}
