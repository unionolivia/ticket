<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\APIBaseController as APIBaseController;
use App\Ticket;
use App\TicketType;
use Validator;

class TicketAPIController extends APIBaseController {
	/**
	*	Display a listing of the resource.
	*
	*	@return \Illuminate\Http\Response
	**/
	public function index(){
		$ticket = Ticket::all();
		
		return $this->sendResponse($ticket->toArray(), 'Tickets retrived successfully.');
		
	}
	
	/**
	*	store a newly created resource in storage.
	*
	*	@param \Illuminate\Http\Request $request
	*	@return \Illuminate\Http\Response
	**/
	public function store(Request $request, TicketType $ticketType)
	{
		$ticket = Ticket::firstOrCreate(
        [
          'ticket_type_id' => $ticketType->id
        ],
        [ 'ticket_id' => str_random(8),
        	'title' => $request->title,
        	'price' => $request->price,
        	'quantity' => $request->quantity,
        	'status' => $request->status
        ]
      );

				return $this->sendResponse($ticket->toArray(), 'Ticket created successfully.');
	}
	
	/**
	*	Update the specified resource in storage.
	*
	* @param \Illuminate\Http\Request $request
	*	@param int $id
	*	@return \Illuminate\Http\Response
	**/	
	public function update(Request $request, TickepetType $ticketType)
	{
		$input = $request->all();
		
		$validator = Validator::make($input, [
				'title' => 'required',
				'price' => 'required',
				'quantity' => 'required',
				'status' => 'required'
			]);
			
			if($validator->fails())
			{
				return $this->sendError('Validation Error.', $validator->errors());
			}
			
			$ticket = Ticket::find($ticketType->id);
			if(is_null($ticket))
			{
				return $this->sendError('Ticket not found');
			}
			
			$ticket->title = $input['title'];
			$ticket->price = $input['price'];
			$ticket->quantity = $input['quantity'];
			$ticket->status = $input['status'];
			$ticket->save();
			
			return $this->sendResponse($ticket->toArray(), 'Ticket updated successfully');
			
	}
	
}

