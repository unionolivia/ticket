<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    //
    protected $fillable = ['name'];
    
    public function Ticket()
    {
      return $this->hasMany(Ticket::class);
    }
}
