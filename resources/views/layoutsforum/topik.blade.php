@extends('layouts.app')
@section('content')
	<div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
            	<div class="panel panel-primary">
            		<div class="panel-heading">
						<h1>{{ $topik->judul_topik }}</h1>
						<p>Penulis : {{ App\User::where('id', $topik->id_penulis)->first()->name }} || Dibuat : {{ $topik->created_at }} || Pelaksanaan : {{ $topik->waktu_mulai }} s/d {{ $topik->waktu_selesai }} || {{ $topik->kehadiran }} orang akan hadir.</p>
						{!! Form::open(array('url' => array('storeKehadiran', $topik->id_topik), 'method' => 'POST')) !!}
		    				{!! Form::token() !!}
		    				{!!  csrf_field()!!}	 
					        @if(Auth::guest())   		
						    @elseif(App\Kehadiran::where([ ['id_penulis', '=', Auth::user()->id] ,['id_topik', '=', $topik->id_topik] ])->first() == null)
				                {!! Form::submit('Hadir', ['class' => 'btn btn-info']) !!}
						    @else
						        <h3><i class="fa fa-check-square-o"></i>Hadir</h3>
						    @endif
					    {!! Form::close() !!}
					    @if(Auth::guest())
						@elseif(Auth::user()->id === $topik->id_penulis)
					        <a href=" {{ url('PerbaruiTopik', array($topik->id_topik))}} ">
					            {!! Form::button('Perbarui', ['class' => 'btn btn-primary']) !!}
					        </a>
					        <a href=" {{ url('deletetopik', array($topik->id_topik)) }} ">
					            {!! Form::button('Hapus', ['class' => 'btn btn-danger']) !!}
					        </a>
					    @elseif(Auth::user()->id_role > 0)
					        <a href=" {{ url('deletetopik', array($topik->id_topik)) }} ">
					            {!! Form::button('Hapus', ['class' => 'btn btn-danger']) !!}
					        </a>
					    @endif
            		</div>
            		<div class="panel-body">
            			<p>{!! $topik->isi_topik !!}</p>
            			<div class="col-md-12">
							{{$komentar->links()}}
            			</div>
                    	@foreach($komentar as $k)
						<div class="container">
					        <div class="row">
					            <div class="col-md-9">
					                <div class="panel panel-info">
					                    <div class="panel-heading">
					                    	<h3>{{ App\User::where('id', $k->id_penulis)->first()->name }}</h3>
					                    	<p>Dibuat : {{ $k->created_at }}</p>
					                    </div>
					                    <div class="panel-body">
					                        <div>{!! $k->isi_komentar !!}</div>
					                        @if(Auth::guest())
					                        @elseif(App\User::where('id', $k->id_penulis)->first()->id === Auth::user()->id)
					                        <div class="text-right">
					                        	<a href=" {{ url('Topik', array($topik->id_topik, $k->id_komentar)) }} ">
					                        	{{ Form::button('Perbarui', ['class' => 'btn btn-primary', 'onClick'=> 'modal()', 'data-toggle' => 'modal', 'data-target' => '#myModal'])}}
					                        	</a>
					                        	<a href=" {{ url('deletekomentar', array($topik->id_topik, $k->id_komentar)) }} ">
					                        	{{ Form::button('Hapus', ['class' => 'btn btn-danger'])}}
					                        	</a>
					                        </div>
					                        @elseif(Auth::user()->id_role > 0)
					                        <div class="text-right">
					                        	<a href=" {{ url('deletekomentar', array($topik->id_topik, $k->id_komentar)) }} ">
					                        	{{ Form::button('Hapus', ['class' => 'btn btn-danger'])}}
					                        	</a>
					                        </div>
					                        @endif
					                    </div>
					                </div>
					            </div>
					        </div>
					    </div>
					    @endforeach
	            		<div class="col-md-12">
							{{$komentar->links()}}
	            		</div>
            		</div>
            	</div>
			</div>
		</div>
		@if(Auth::user())
		<div class="row">
            <div class="col-md-10 col-md-offset-1">
            	<div class="panel panel-primary">
            		<div class="panel-heading">
						<h3>Tambah Komentar . . .</h3>
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
            			{!! Form::open(array('url' => array('komentar', $topik->id_topik), 'method' => 'POST')) !!}
		                    {!! Form::token() !!}
		                    {!!  csrf_field()!!}
		                    <div class="form-group">
		                        {!! Form::textarea('isi_komentar', '', ['id' => 'summernote', 'class' => 'form-control']) !!}
		                    </div> 
		                    <div class="text-center">
		                        {!! Form::submit('Submit Comment', ['class' => 'btn btn-success']) !!}    
		                    </div>                    
		                {!! Form::close() !!}
            		</div>
            	</div>
			</div>
		</div>
		@else
		<div class="row">
            <div class="col-md-10 col-md-offset-1">
            	<div class="panel panel-primary">
            		<div class="panel-heading">
						<h3>Tambah Komentar . . .</h3>
            		</div>
            		<div class="panel-body">
            			<h4>
            				<a href="{{ route('login') }}">Login</a> atau <a href="{{ route('register') }}">Register</a> untuk memberikan komentar . . .
            			</h4>
            		</div>
            	</div>
			</div>
		</div>
	</div>
	@endif

	
  

	<script type="text/javascript">
	    $(document).ready(function(){
	        $('#summernote').summernote({
	        	height:200,
	        })
	    });
	    var edit = function() {
		  		$('.click2edit').summernote({focus: true});
		};

		var save = function() {
		  var makrup = $('.click2edit').summernote('code');
		  $('.click2edit').summernote('destroy');
		};
		var modal = function() {
			var x = document.getElementById('wowModal');
			x.style.display = 'block';
			y.style.opacity = 0.5;
		};
		var dismodal = function() {
			var x = document.getElementById('wowModal');
			x.style.display = 'none';
		};
	</script>

@stop

