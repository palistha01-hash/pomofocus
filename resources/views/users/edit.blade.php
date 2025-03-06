@section('users-editform')
{!! Form::model($users,['route'=>['users.update',$users->id],'method'=>'put','id'=>"employeeForm"]) !!}
    @include('users.form')
{!! Form::close() !!}

@stop