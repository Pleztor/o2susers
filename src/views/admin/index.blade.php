@extends(\Config::get('o2susers.layout'))

@section('content')
	<h1>Users</h1>

	<a href="/admin/users/create" class="btn btn-default">
		<span class="glyphicon glyphicon-plus-circle"></span>
		Add User
	</a>

	@foreach ($users as $row)
		<div class="row">
			<div class="col-sm-12">
				<a href="/admin/users/{{$row->id}}/edit">{{ $row->name }} [ {{ $row->email }} ]</a>
			</div>
		</div>
	@endforeach
@stop