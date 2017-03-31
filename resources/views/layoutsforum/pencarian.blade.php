@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h1>Hasil pencarian {{ $kunci }}...</h1>
				</div>
				<div class="panel-body">
					@if($cari->count() === 0)
						Tidak menemukan hasil pencarian
					@endif
					@foreach($cari as $c)
					<div class="container">
						<div class="row">
							<div class="col-md-9">
								<div class="panel panel-info">
									<div class="panel-heading">
										<a href=" {{ url('Topik', array($c->id_topik)) }} "><h3> {!! $c->judul_topik !!} </h3></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@stop