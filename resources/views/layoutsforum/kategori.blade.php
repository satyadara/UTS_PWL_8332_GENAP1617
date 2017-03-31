@extends('layouts.app')
@section('content')
	<div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
            	<div class="panel panel-primary">
            		<div class="panel-heading">
						<h2>{{ $kategori->nama_kategori }}</h2>
						<p class="text-right"><a href=" {{ url('tambahtopik', array($kategori->id_kategori)) }} ">{{ Form::button('Tambah Topik', ['class' => 'btn btn-success'])}}</a></p>
            		</div>
            		<div class="panel-body">
            			<div class="col-md-7">
							{{$topik->links()}}
            			</div>
                    	@foreach($topik as $t)
						<div class="container">
					        <div class="row">
					            <div class="col-md-9">
					                <div class="panel panel-info">
					                    <div class="panel-heading">
					                    	<h4><a href=" {{ url('Topik', array($t->id_topik)) }} ">{{ $t->judul_topik }}</a></h4>
					                        <p><h6>Penulis : {{ App\User::where('id', $t->id_penulis)->first()->name }} || Dibuat : {{ $t->created_at }} || Pelaksanaan : {{ $t->waktu_mulai }} s/d {{ $t->waktu_selesai }} || {{ $t->kehadiran }} orang akan hadir.</h6></p>
					                        @if(Auth::guest())
					                        @elseif(Auth::user()->id === $t->id_penulis)
					                        <a href=" {{ url('PerbaruiTopik', array($t->id_topik))}} ">
					                        	{!! Form::button('Perbarui', ['class' => 'btn btn-primary']) !!}
					                        </a>
					                        <a href=" {{ url('deletetopik', array($t->id_topik)) }} ">
					                        	{!! Form::button('Hapus', ['class' => 'btn btn-danger']) !!}
					                        </a>
					                        @elseif(Auth::user()->id_role > 0)
					                        <a href=" {{ url('deletetopik', array($t->id_topik)) }} ">
					                        	{!! Form::button('Hapus', ['class' => 'btn btn-danger']) !!}
					                        </a>
					                        @endif
					                    </div>
					                    <div class="panel-body text-right">
					                    	{!! Form::open(array('url' => array('storeKehadiran', $t->id_topik), 'method' => 'POST')) !!}
		    									{!! Form::token() !!}
		    									{!!  csrf_field()!!}
					                        	@if(Auth::guest())
						                    	@elseif(App\Kehadiran::where([ ['id_penulis', '=', Auth::user()->id] ,['id_topik', '=', $t->id_topik] ])->first() == null)
				                					{!! Form::submit('Hadir', ['class' => 'btn btn-info']) !!}
						                    	@else
						                    		<h3><i class="fa fa-check-square-o"></i>Hadir</h3>
						                    	@endif
					                    	{!! Form::close() !!}
					                    </div>
					                </div>
					            </div>
					        </div>
					    </div>
					    @endforeach
	            		<div class="col-md-8">
							{{$topik->links()}}
	            		</div>
            		</div>
            	</div>
			</div>
		</div>
	</div>
@stop

