@extends('layouts.app')

@section('content')
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
            <li data-target="#carousel-example-generic" data-slide-to="4"></li>
            <li data-target="#carousel-example-generic" data-slide-to="5"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src=" {{ asset('images/fladramon1.jpg') }} " alt="Fladramon" class="img-responsive">
                <div class="carousel-caption">
                        Flame Dragon Monster
                </div>
            </div>
            <div class="item">
                <img src=" {{ asset('images/garurumon1.jpg') }} " alt="Garurumon">
                <div class="carousel-caption">
                        Wolf Monster
                </div>
            </div>
            <div class="item">
                <img src=" {{ asset('images/lilymon1.jpg') }} " alt="Lilymon">
                <div class="carousel-caption">
                        Plant Monster
                </div>
            </div>
            <div class="item">
                <img src=" {{ asset('images/patamon1.jpg') }} " alt="Patamon">
                <div class="carousel-caption">
                        Pig Monster
                </div>
            </div>
            <div class="item">
                <img src=" {{ asset('images/salamon1.jpg') }} " alt="Garurumon">
                <div class="carousel-caption">
                        Mammal Monster
                </div>
            </div>
            <div class="item">
                <img src=" {{ asset('images/wargreymon1.jpg') }} " alt="Garurumon">
                <div class="carousel-caption">
                        War Grey Monster
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left fa fa-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right fa fa-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="container col-md-offset-1">
        <div class="row">
        <br>
        <div class="col-md-12">
            <h1 class="text-center">KATEGORI FORUM</h1>
            @if(Auth::guest())
            @elseif(Auth::user()->id_role > 0)
            <a href=" {{ url('tambahkategori')}} ">{{ Form::button('Tambah Kategori', ['class' => 'btn btn-success'])}}</a>
            @endif
        </div>
            @foreach($kategori as $k)
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h2>
                            <a href=" {{ url('Kategori', array($k->id_kategori)) }} ">{{ $k->nama_kategori }}</a>
                        </h2>
                        <p>Dibuat : {{ $k->created_at }}</p>
                        @if(Auth::guest())
                        @elseif(Auth::user()->id_role > 0)
                            <a href="  {{ url('perbaruikategori', array($k->id_kategori)) }} ">{{ Form::button('Perbarui', ['class' => 'btn btn-primary'])}}</a>
                            <a href="  {{ url('hapuskategori', array($k->id_kategori)) }} ">{{ Form::button('Hapus', ['class' => 'btn btn-danger'])}}</a>
                        @endif
                    </div>

                    <div class="panel-body">
                        <p> {{$k->keterangan}} </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    {{$kategori->links()}}
@stop