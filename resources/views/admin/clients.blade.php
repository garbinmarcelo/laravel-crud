@extends('template.admin')

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h1>Cadastrar Cliente</h1>
			@if(Session::has('mensagem'))
				<div class="alert alert-success">
					{{ Session::get('mensagem') }}
				</div>
			@endif
			@if(count($errors) > 0)
				<div class="alert alert-danger">
					<ul class="list-unstiled">
						@foreach($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			@if(Request::is('admin/client/edit/*'))
				<form method="post" action="{{ route('admin.clients.update') }}">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<input type="hidden" name="id_client" value="{{$client->id}}" /> 
			@else
				<form method="post" action="{{ route('admin.clients.create') }}">
				{{ csrf_field() }}
				{{ method_field('POST') }}
			@endif

			<div class="form-group">
				<label for="name">Nome</label>
				<input type="text" name="name" class="form-control" placeholder="Name" value="{{ $client->name or null }}" /> 
			</div>
			<div class="form-group">
				<label for="lastname">Sobrenome</label>
				<input type="text" name="lastname" class="form-control" placeholder="Lastname" value="{{ $client->lastname or null }}" /> 
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" name="email" class="form-control" placeholder="E-mail" value="{{ $client->email or null }}" />
			</div>
			<div class="form-group">
				<label for="phone">Telefone</label>
				<input type="number" name="phone" class="form-control" placeholder="Phone" value="{{ $client->phone or null }}" />
			</div>
			<div class="form-group">
				<label for="active">Status</label>
				<select name="active" class="form-control">
					<option value="0" {{ (isset($client->active) && $client->active === 0)? 'selected' : '' }}>Desativado</option>
					<option value="1" {{ (isset($client->active) && $client->active === 1)? 'selected' : '' }}>Ativado</option>
				</select>
			</div>
			<button type="submit" class="btn btn-primary btn-block">Salvar</button> 
			</form> 
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h3>Listagem de Clientes</h3>
			<hr />
			<table class="table table-hover table-hover">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Nome</th>
						<th class="text-center">Sobrenome</th>
						<th class="text-center">E-mail</th>
						<th class="text-center">Telefone</th>
						<th class="text-center">Status</th>
						<th class="text-center">Ação</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($clients as $client)
					<tr>
						<td class="text-center">{{  $client->id }}</td>
						<td class="text-center">{{  $client->name }}</td>
						<td class="text-center">{{  $client->lastname }}</td>
						<td class="text-center">{{  $client->email }}</td>
						<td class="text-center">{{  $client->phone }}</td>
						<td class="text-center">{{  ($client->active === 1) ? 'Ativado' : 'Desativado' }}</td>
						<td class="text-center" width="180">
							<a class="btn btn-primary pull-left" href="{{ route('admin.clients.edit', $client->id) }}" role="button">Alterar</a>
							<form method="post" action="{{ route('admin.clients.delete', $client->id) }}">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
								<button class="btn btn-danger pull-right" type="submit">Deletar</button>
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection