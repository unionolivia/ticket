<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\APIBaseController as APIBaseController;
use App\TicketType;
use Validator;

class TicketTypeAPIController extends APIBaseController {
	/**
	*	Display a listing of the resource.
	*
	*	@return \Illuminate\Http\Response
	**/
	public function index(){
		$ticketType = TicketType::all();
		
		return $this->sendResponse($ticketType->toArray(), 'Ticket Type retrived successfully.');
		
	}
	
	/**
	*	store a newly created resource in storage.
	*
	*	@param \Illuminate\Http\Request $request
	*	@return \Illuminate\Http\Response
	**/
	public function store(Request $request)
	{
		$input = $request->all();
		
		$validator = Validator::make($input, [
			'name' => 'required'
			]);
			
			if($validator->fails()){
				return $this->sendError('Validation Error.', $validator->errors());
				}
				
				$ticketType = TicketType::create($input);
				
				return $this->sendResponse($ticketType->toArray(), 'Ticket type created successfully.');
	}
	
	/**
	*	display the specified resource.
	*
	*	@param int $id
	*	@return \Illuminate\Http\Response
	**/
		
	public function show($id){
		$ticketType = TicketType::find($id);
		
		if(is_null($ticketType)){
			return $this->sendError('Ticket type not found');
		}	
		
		return $this->sendResponse($ticketType->toArray(), 'Ticket type retrieved successfully');
	}
	
	/**
	*	Update the specified resource in storage.
	*
	* @param \Illuminate\Http\Request $request
	*	@param int $id
	*	@return \Illuminate\Http\Response
	**/	
	public function update(Request $request, $id)
	{
		$input = $request->all();
		
		$validator = Validator::make($input, [
				'name' => 'required'
			]);
			
			if($validator->fails())
			{
				return $this->sendError('Validation Error.', $validator->errors());
			}
			
			$ticketType = TicketType::find($id);
			if(is_null($ticketType))
			{
				return $this->sendError('Ticket not found');
			}
			
			$ticketType->name = $input['name'];
			$ticketType->save();
			
			return $this->sendResponse($ticketType->toArray(), 'Ticket updated successfully');
			
	}
	
	/**
	*	Delete the specified resource from storage.
	*
	*	@param int $id
	*	@return \Illuminate\Http\Response
	**/
	public function destroy()
	{
		
	}
	
}

