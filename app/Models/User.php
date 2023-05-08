<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'age',
        'gender',
        'county',
        'sub_county',
        'region_id',
        'type_id',
        'staff_id',
        'ward_name',
        'created_by',
        'is_approved',
        'approved_by',
        'approved_by_name',
        'photo',
        'role_id',
        'last_seen',
        'file_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the region associated with the user. 
     */
    public function regions()
    {
        return $this->belongsTo(Region::class, 'region_id');  
    }

    /**
     * Get the roles associated with the user.
     */
    public function roleUser()
    {
        return $this->belongsTo(Role::class, 'role_id');  
    }

    /**
     * Get the created by associated with the user.
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');  
    }

    /**
     * Get the avatar by associated with the user.
     */
    public function avatars()
    {
        return $this->belongsTo(Avatar::class, 'file_id');  
    }

    
  
}
