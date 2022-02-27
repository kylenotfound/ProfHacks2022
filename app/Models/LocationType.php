<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationType extends Model {

    const PHYSICAL = 1;
    const REMOTE = 2;

    protected $table = 'location_types';
    protected $fillable = ['name'];
    public $timestamps = true;
    
    public function getId() {
      return $this->id;
    }
}
