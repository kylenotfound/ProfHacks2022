<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model {
    use HasFactory; use SoftDeletes;

    protected $table = 'events';
    protected $fillable = ['organizer_id', 'event_name', 'event_description', 'start_date', 'end_date', 
      'address', 'city', 'state', 'zipcode', 'notes', 'event_type_id'   
    ];
    public $timestamps = true;

    public function organizer() {
      return $this->belongsTo(User::class, 'organizer_id', 'id');  
    }

    public function registrations() {
      return $this->hasMany(Registrations::class);
    }

    public function eventType() {
      return $this->hasOne(EventType::class, 'id', 'event_type_id');
    }

    public function getId() {
      return $this->id;  
    }

    public function getName() {
      return $this->event_name;
    }

    public function getDescription() {
      return isset($this->event_description) ? $this->event_description : 'No Description Provided';
    }

    public function getFormattedAddress() {
      $addressString = $this->address . ' ' . $this->city . ' ' . $this->state . ' ' . $this->zipcode;
      return $addressString != '   ' ? $addressString : 'Remote';  
    }

    public function getFormattedStartDate() {
      return Carbon::parse($this->start_date)->format('M d, Y h:i A');  
    }

    public function getFormattedEndDate() {
      return Carbon::parse($this->end_date)->format('M d, Y h:i A');  
    }

}
