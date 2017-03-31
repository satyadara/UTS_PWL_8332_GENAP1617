@extends('layouts.app')

@section('content')
	<div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-info">
                    <div class="panel-heading">
                    	<h2>Perbarui Topik</h2>
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
                    {!! Form::open(array('url' => array('updatetopik', $topik->id_topik), 'method' => 'PUT')) !!}
		    			{!! Form::token() !!}
		                {!!  csrf_field()!!}
				            <div class="form-group ">
		                        <h3>{{Form::label('label_judul','Judul')}}</h2>
				                {!! Form::text('judul_topik', $topik->judul_topik , ['class' => 'form-control', 'required' => '']) !!}
			                </div>
				            <div class="form-group">
				                {!! Form::textarea('isi_topik', $topik->isi_topik, ['id' => 'summernote', 'class' => 'form-control', 'required' => '']) !!}
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

	<script type="text/javascript">
	    $(document).ready(function(){
	        $('#summernote').summernote({
	        	height:300,
	        })
	    });
	</script>
@stop