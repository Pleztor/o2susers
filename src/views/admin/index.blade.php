@extends('app')

@section('content')
	<h1>Users</h1>

	<a href="/admin/users/create" class="btn btn-default">
		<span class="glyphicon glyphicon-plus-circle"></span>
		Add User
	</a>

	@foreach ($users as $row)
		<div class="row">
			<div class="col-sm-12">
				<a href="/admin/users/{{$row->id}}/edit">{{ $row->name }} [ {{ $row->email }} ]
			</div>
		</div>
	@endforeach
@stop