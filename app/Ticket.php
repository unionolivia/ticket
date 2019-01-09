<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    protected $fillable = [
    'ticket_type_id', 'ticket_id', 'title', 'price', 'quantity', 'status',
];

	public function ticketType()
    {
      return $this->belongsTo(TicketType::class);
    }
}
