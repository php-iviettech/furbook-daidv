{!! Form::open(array('url' => array('users'), 'method' => 'POST')) !!}
{{ Form::label('name', 'Name') }}
{{ Form::text('name') }}<br>
{{ Form::label('email', 'E-Mail Address') }}
{{ Form::text('email') }}<br>
{{ Form::label('password', 'Password') }}
{{ Form::text('password') }}<br>
{{ Form::label('role', 'Role') }}
{{ Form::select('role', $roles) }}<br>
{{ Form::label('Breed', 'Breed') }}
{{ Form::select('breed', $breeds) }}<br>
{{ Form::submit('Create Account') }}
{!! Form::close() !!}