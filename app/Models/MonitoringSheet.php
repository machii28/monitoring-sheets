<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MonitoringSheet extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'monitoring_sheets';

    protected $fillable = [
        'title',
        'category_id',
        'division',
        'coverage',
        'year_quarter',
        'prepared_by',
        'prepared_by_role',
        'checked_by',
        'checked_by_role',
        'user_id',
        'area_id',
        'process_id'
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(MonitoringSheetCategory::class, 'category_id', 'id');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'monitoring_sheet_id',  'id');
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    public function process(): BelongsTo
    {
        return $this->belongsTo(Process::class, 'process_id', 'id');
    }
}
