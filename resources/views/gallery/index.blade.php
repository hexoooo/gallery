@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">gallery</div>

                <div class="card-body">
                <div class="card">
                    <div class="card-header">albums</div>
                        <div class="card-body">
                            <div class="row mt-4">
@if (isset($albums))
@if (session('success'))
    <div class="alert alert-success">
      {{session('success')}}
    </div>
@endif
    

                            @foreach ($albums as $album)
                            <div class="col-sm-4">
                                <div class="position-relative">
                                    <div class="position-relative">
                                            <a href={{route('album.show',$album->id)}}>
                                        
                                            <div class="ribbon-wrapper ribbon-lg">
                                               
                                                    {{$album->name}}
                                                
                                                    @if (isset($album->photos()->first()->name))
                                        </div>
                                            <img src="{{asset('albums/images/'.$album->directory_name.'/'.$album->photos()->first()->name)}}" alt="Photo 1" class="img-fluid" width="200px" height='200px'>

                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                </div>
                
            </div>
        </div>
        <a class="ui-button ui-corner-all ui-widget btn btn-primary"href={{route('album.create')}}> add album</a>
        </div>
    </div>
</div>
@endsection