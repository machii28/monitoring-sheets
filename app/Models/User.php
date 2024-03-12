<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use CrudTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_initial',
        'name_extension',
        'email',
        'password',
        'role',
        'position'
    ];

//    /**
//     * The attributes that should be hidden for serialization.
//     *
//     * @var array<int, string>
//     */
//    protected $hidden = [
//        'password',
//        'remember_token',
//        'area_id'
//    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getYearAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->year;
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function process(): BelongsTo
    {
        return $this->belongsTo(Process::class, 'process_id');
    }

    public function totalAssignedMS(): int
    {
        return AssignedMonitoringSheet::where('assigned_id', $this->id)
            ->count();
    }

    public function getTotalAssignedMsAttribute()
    {
        return $this->totalAssignedMS();
    }

    public function getFullNameAttribute()
    {
        return $this->last_name . ', ' . $this->first_name . ' ' . $this->middle_initial . '. ' . $this->name_extension;
    }

    public function showFullName()
    {
        return $this->fresh()->fullname;
    }
}
