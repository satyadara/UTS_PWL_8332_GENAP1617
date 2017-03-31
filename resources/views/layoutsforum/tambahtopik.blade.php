@extends('layouts.app')

@section('content')
	<div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-info">
                    <div class="panel-heading">
                    	<h2>{{ $kategori->nama_kategori }}</h2>
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
                    {!! Form::open(array('url' => array('storetopik', $kategori->nama_kategori), 'method' => 'POST')) !!}
		    			{!! Form::token() !!}
		                {!!  csrf_field()!!}
				            <div class="form-group col-md-12">
					            <div class="col-md-2">
			                        <h4>{{Form::label('label_judul','Judul Topik')}}</h4>
					            </div>
					            <div class="input-group col-md-10">
					                {!! Form::text('judul_topik', '', ['class' => 'form-control', 'required' => '']) !!}
					                <span class="input-group-addon">
				                        <span class="fa fa-dot-circle-o"></span>
				                    </span>
				                </div>
				            </div>
			                <div class="form-group col-md-6">
			                	<div class="col-md-5">
			                		<h4>{{Form::label('label_mulai','Waktu Mulai')}}</h4>
			                	</div>
				                <div class='input-group date col-md-7' id='datetimepicker1'>
				                    {!! Form::date('waktu_mulai', '', ['class' => 'form-control', 'required' => '']) !!}
				                    <span class="input-group-addon">
				                        <span class="fa fa-calendar"></span>
				                    </span>
				                </div>
				            </div>
				            <div class="form-group col-md-6">
				            	<div class="col-md-5">
			                		<h4>{{Form::label('label_selesai','Waktu Selesai')}}</h4>
			                	</div>
				                <div class='input-group date col-md-7' id='datetimepicker1'>
				                    {!! Form::date('waktu_selesai', '', ['class' => 'form-control', 'required' => '']) !!}
				                    <span class="input-group-addon">
				                        <span class="fa fa-calendar"></span>
				                    </span>
				                </div>
				            </div>
				            <div class="form-group col-md-12">
				                {!! Form::textarea('body', '', ['id' => 'summernote', 'class' => 'form-control', 'required' => '']) !!}
			                </div>
			                <div class=" form-group text-center  col-md-12">
			                	{!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
			                </div>
		    		{!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

	<script type="text/javascript">
	    $(document).ready(function(){
	        $('#summernote').summernote({
	        	height:300,
	        })
	    });
	</script>
@stop