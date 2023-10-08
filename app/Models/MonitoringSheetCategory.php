<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MonitoringSheetCategory extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'monitoring_sheet_categories';

    protected $fillable = [
        'category',
        'abbreviation'
    ];

    public function monitoringSheets(): HasMany
    {
        return $this->hasMany(MonitoringSheet::class, 'category_id', 'id');
    }
}
