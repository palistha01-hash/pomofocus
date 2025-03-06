@section('user-form')
{!! Form::open(['route'=>['users.store'],'method'=>'post']) !!}
	@include('users.form')
{!! Form::close() !!}
@stop

