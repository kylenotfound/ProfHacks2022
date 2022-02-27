<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Event;
use App\Models\Registrations;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getName() {
        return $this->name;
    }

    public function getId() {
      return $this->id;  
    }

    public function profile() {
      return $this->hasOne(UserProfile::class, 'id', 'profile_id');
    }

    public function registrations() {
      return $this->hasMany(Registrations::class);
    }

    public function isRegisteredForEvent($id) {
      $registration = Registrations::where('event_id', $id)
        ->where('user_id', $this->id)
        ->exists();
      return $registration;
    }
}
