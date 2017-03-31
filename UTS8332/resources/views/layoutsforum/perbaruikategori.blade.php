@extends('layouts.app')

@section('content')
	<div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-info">
                    <div class="panel-heading">
                    	<h2>Perbarui Kategori</h2>
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
                    {!! Form::open(array('url' => array('updatekategori', $kategori->id_kategori), 'method' => 'put')) !!}
		    			{!! Form::token() !!}
		                {!!  csrf_field()!!}
				            <div class="form-group ">
		                        <h3>{{Form::label('nama','Nama Kategori')}}</h2>
				                {!! Form::text('nama_kategori', $kategori->nama_kategori, ['class' => 'form-control', 'required' => '']) !!}
			                </div>
				            <div class="form-group">
		                        <h3>{{Form::label('label','Keterangan Kategori')}}</h2>
				                {!! Form::textarea('keterangan', $kategori->keterangan, ['class' => 'form-control', 'required' => '']) !!}
			                </div>
			                <div class=" form-group text-center">
			                	{!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
			                </div>
		    		{!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop