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
				{{ Form::model($client, ['route' => 'admin.clients.update']) }}
				{{ Form::hidden('id_client', $client->id, ['id' => 'id_client']) }}
			@else
				{{ Form::open(['route' => 'admin.clients.create']) }}
			@endif

			<div class="form-group">
			{{ Form::label('name', 'Nome') }}
			{{ Form::input('text', 'name', null, ['class' => 'form-control', 'autofocus', 'placeholder' => 'Your Name']) }}
			</div>
			<div class="form-group">
			{{ Form::label('lastname', 'Sobrenome') }}
			{{ Form::input('text', 'lastname', null, ['class' => 'form-control', 'placeholder' => 'Yout Lastname']) }}
			</div>
			<div class="form-group">
			{{ Form::label('email', 'E-mail') }}
			{{ Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => 'Your Lastname']) }}
			</div>
			<div class="form-group">
			{{ Form::label('phone', 'Telefone') }}
			{{ Form::input('number', 'phone', null, ['class' => 'form-control', 'placeholder' => 'Your Phone']) }}
			</div>
			<div class="form-group">
			{{ Form::label('active', 'Status') }}
			{{ Form::select('active', [0 => 'Desativado', 1 => 'Ativado'], null, ['class' => 'form-control']) }}
			</div>
			{{ Form::submit('Salvar', ['class' => 'btn btn-primary btn-block']) }}
			{{ Form::close() }}
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