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
        'category',
        'division_id',
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

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }

    public function getCoverageAttribute($value)
    {
        $coverage = '';

        switch ($value) {
            case '1':
                $coverage = '1st Quarter';
                break;
            case '2':
                $coverage = '2nd Quarter';
                break;
            case '3':
                $coverage = '3rd Quarter';
                break;
            case '4':
                $coverage = '4th Quarter';
                break;
        }

        return $coverage;
    }

    public function getFormattedCategoryAttribute()
    {
        $category = '';

        switch ($this->attributes['category']) {
            case 'fqo':
                $category = 'FUNCTIONAL QUALITY OBJECTIVES';
                break;
            case 'rr':
                $category = 'RISK REGISTER';
                break;
            case 'pg':
                $category = 'PROCESS GOAL';
                break;
        }

        return $category;
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $yearQuarter = '1st Quarter - ' . now()->format('Y');

            switch ($model->coverage) {
                case '1st Quarter':
                    $yearQuarter = '1st Quarter - ' . now()->format('Y');
                    break;
                case '2nd Quarter':
                    $yearQuarter = '2nd Quarter - ' . now()->format('Y');
                    break;
                case '3rd Quarter':
                    $yearQuarter = '3rd Quarter - ' . now()->format('Y');
                    break;
                case '4th Quarter':
                    $yearQuarter = '4th Quarter - '. now()->format('Y');
                    break;
            }
            $model->year_quarter = $yearQuarter;

        });

        static::updating(function ($model) {
            $yearQuarter = '1st Quarter - ' . now()->format('Y');

            switch ($model->coverage) {
                case '1st Quarter':
                    $yearQuarter = '1st Quarter - ' . now()->format('Y');
                    break;
                case '2nd Quarter':
                    $yearQuarter = '2nd Quarter - ' . now()->format('Y');
                    break;
                case '3rd Quarter':
                    $yearQuarter = '3rd Quarter - ' . now()->format('Y');
                    break;
                case '4th Quarter':
                    $yearQuarter = '4th Quarter - '. now()->format('Y');
                    break;
            }
            $model->year_quarter = $yearQuarter;
        });
    }
}
