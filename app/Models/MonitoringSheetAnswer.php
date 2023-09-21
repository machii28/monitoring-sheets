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
        'answer',
        'user_id',
        'question_id',
        'monitoring_sheet_id'
    ];

    public function respondent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    public function monitoringSheet(): BelongsTo
    {
        return $this->belongsTo(MonitoringSheet::class, 'monitoring_sheet_id', 'id');
    }
}
