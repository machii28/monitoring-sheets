<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Creagia\LaravelSignPad\Concerns\RequiresSignature;
use Creagia\LaravelSignPad\Contracts\CanBeSigned;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssignedMonitoringSheet extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'assigned_monitoring_sheets';

    protected $fillable = [
        'monitoring_sheet_id',
        'assigned_id',
        'assigned_by',
        'is_filled_up'
    ];

    public function monitoringSheet(): BelongsTo
    {
        return $this->belongsTo(MonitoringSheet::class, 'monitoring_sheet_id', 'id');
    }

    public function processOwner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_id', 'id');
    }
}
