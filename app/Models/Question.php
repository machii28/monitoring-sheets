<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = [
        'monitoring_sheet_id',
        'question'
    ];

    public function monitoringSheet(): BelongsTo
    {
        return $this->belongsTo(MonitoringSheet::class, 'monitoring_sheet_id', 'id');
    }
}
