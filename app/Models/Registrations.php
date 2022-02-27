<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Registrations extends Model {
    use HasFactory; use SoftDeletes;

    protected $table = 'registrations';
    protected $fillable = ['user_id', 'event_id'];
    public $timestamps = true;

    public function event() {
      return $this->belongsTo(Event::class, 'event_id', 'id');  
    }

    public function user() {
      return $this->hasMany(User::class, 'id', 'user_id');  
    }

    public function getId() {
      return $this->id;  
    }
}
