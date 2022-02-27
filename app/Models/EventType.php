<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model {

    const VOLUNTEERING = 1;
    const FUNDRAISER = 2;
    const PROTEST = 3;

    protected $table = 'event_types';
    protected $fillable = ['name'];
    public $timestamps = true;

    public function getId() {
      return $this->id;  
    }

    public function getName() {
      return $this->name;
    }

}
