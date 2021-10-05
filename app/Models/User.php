<?php

namespace App\Models;

use App\Filters\FilterAbstract;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'phone',
        'email',
        'password',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(): int
    {
        return (int)$this->is_admin;
    }

    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function scopeFilter(Builder $builder, FilterAbstract $filters): Builder
    {
        return $filters->apply(
            $builder
                ->select([
                    'id',
                    'firstname',
                    'lastname',
                    'email',
                    'phone',
                    DB::raw("CONCAT(firstname, ' ', lastname) as full_name"),
                ])
        );
    }
}
