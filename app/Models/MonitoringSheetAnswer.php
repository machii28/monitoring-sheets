<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonitoringSheetAnswer extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'monitoring_sheet_answers';

    protected $fillable = [
        'assigned_monitoring_sheet_id',
        'question_id',
        'status',
        'remarks',
        'root_cause',
        'corrective_action'
    ];

    public function assignedMonitoringSheetId(): BelongsTo
    {
        return $this->belongsTo(
            AssignedMonitoringSheet::class,
            'assigned_monitoring_sheet_id',
            'id'
        );
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }
}
