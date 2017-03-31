@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h1>Profil</h1>
					{!! Form::button('Perbarui', ['id' => 'btnPerbarui' ,'class' => 'btn btn-info', 'onclick' => 'enable()']) !!}
					{!! Form::button('Batal', ['id' => 'btnBatal' ,'class' => 'btn btn-info', 'onclick' => 'disable()', 'style' => 'display:none;']) !!}
				</div>
				<div class="panel-body">
					@if (count($errors) > 0)
					    <div class="alert alert-danger">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif
					{!! Form::open(array('url' => array('updateprofil'), 'method' => 'put', 'class' => 'form-inline')) !!}
		    			{!! Form::token() !!}
		                {!!  csrf_field()!!}
				            <div class="form-group col-md-12">
		                        <h3>{{Form::label('nama','Nama Lengkap',['class' => 'col-md-4'])}}</h2>
				                {!! Form::text('name', Auth::user()->name, ['id' => 'name','class' => 'form-control col-md-7', 'required', 'disabled']) !!}
			                </div>
				            <div class="form-group col-md-12">
		                        <h3>{{Form::label('label','Email',[ 'class' => 'col-md-4'])}}</h2>
				                {!! Form::email('email', Auth::user()->email, ['id' => 'email','class' => 'form-control col-md-7', 'disabled']) !!}
			                </div>
				            <div class="form-group col-md-12">
		                        <h3>{{Form::label('label','Kata Sandi Lama',['id' => 'lblpass', 'class' => 'col-md-4', 'style' => 'display:none;'])}}</h2>
				                {!! Form::password('password', ['id' => 'password', 'class' => 'form-control col-md-7', 'required',  'style' => 'display:none;']) !!}
			                </div>
				            <div class="form-group col-md-12">
		                        <h3>{{Form::label('label','Kata Sandi Baru',['id' => 'lblpass1', 'class' => 'col-md-4', 'style' => 'display:none;'])}}</h2>
				                {!! Form::password('newpassword', ['id' => 'newpassword', 'class' => 'form-control col-md-7', 'required',  'style' => 'display:none;']) !!}
			                </div>
			                <div class=" form-group text-center">
			                	{!! Form::submit('Submit', ['id' => 'submit','class' => 'btn btn-success', 'style' => 'display:none;']) !!}
			                </div>
		    		{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function enable(){
		$s = (document).getElementById('lblpass1');
		$t = (document).getElementById('newpassword');
		$u = (document).getElementById('lblpass');
		$v = (document).getElementById('password');
		$w = (document).getElementById('submit');
		$x = (document).getElementById('name');
		$y = (document).getElementById('btnPerbarui');
		$z = (document).getElementById('btnBatal');

		$s.style.display = 'block';
		$t.style.display = 'block';
		$u.style.display = 'block';
		$v.style.display = 'block';
		$w.style.display = 'block';
		$x.removeAttribute("disabled");
		$y.style.display = 'none';
		$z.style.display = 'block';
	}

	function disable(){
		$s = (document).getElementById('lblpass1');
		$t = (document).getElementById('newpassword');
		$u = (document).getElementById('lblpass');
		$v = (document).getElementById('password');
		$w = (document).getElementById('submit');
		$x = (document).getElementById('name');
		$y = (document).getElementById('btnPerbarui');
		$z = (document).getElementById('btnBatal');

		$s.style.display = 'none';
		$t.style.display = 'none';
		$u.style.display = 'none';
		$v.style.display = 'none';
		$w.style.display = 'none';
		$x.setAttribute("disabled", true);
		$y.style.display = 'block';
		$z.style.display = 'none';
	}
</script>
@stop