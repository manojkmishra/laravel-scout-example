<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    protected $fillable = [ 
        'title', 'content', 'published'
    ];
      public function user()
    { return $this->belongsTo('App\User');
    }
    
}
