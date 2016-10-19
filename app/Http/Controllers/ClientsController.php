<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Client;
use Session;
use Redirect;

class ClientsController extends Controller
{
	public function index($id = NULL)
	{
		if(!empty($id) && is_numeric($id)){
			$client = Client::find($id);
		}else{
			$client = null;
		}

		$clients = Client::all();

		return view('admin.clients', [
			'clients' => $clients,
			'client'  => $client,
		]);
	}

	public function save(Request $request)
	{
		$this->validate($request, [
        	'name'	   => 'required|max:255',
        	'lastname' => 'required|max:255',
        	'email'    => 'required|email|max:255',
    	]);

		$client = new Client();

		if(!empty($request->id_client) && is_numeric($request->id_client)){
			$client = Client::findOrFail($request->id_client);
			$client = $client->update($request->all());
			Session::flash('mensagem', 'Cliente editado com sucesso!');
		}else{
			$client = $client->create($request->all());
			Session::flash('mensagem', 'Cliente cadastrado com sucesso!');
		}

		return Redirect::to('admin');
	}

	public function delete($id)
	{
		$client = Client::findOrFail($id);
		
		$client->delete();

		Session::flash('mensagem', 'Cliente deletado com sucesso');

		return Redirect::to('admin');
	}
}
