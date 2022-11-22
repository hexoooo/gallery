@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <a class="ui-button ui-corner-all ui-widget btn btn-primary" href="{{ route('album.index') }}">
                back to gallery
                </a>
            </div>
                <div class="card-body">
                <div class="card">
                   @if(isset($photos->first()->name))
                        
                    <div class="card-header">{{$photos->first()->album()->first()->name}} album</div>

                        
                    @else
                    <div class="card-header">this is empty album</div>
                    @endif
                        
                    <div class="card-body">
                            <div class="row mt-4">
                            @foreach ($photos as $photo)
                            <div class="col-sm-4">
                                <div class="position-relative">
                                    <div class="position-relative">

                                        
                                            <div class="ribbon-wrapper ribbon-lg">
                                                <form action="{{route('album.photo.destroy',$photo->id)}}" method="post">
                                                    @csrf
                                                    <button type='submit' class="ui-button ui-corner-all ui-widget btn btn-danger"> delete photo</button>
                                                </form>  
                                                    {{$photo->name}}
                                                
                                                
                                        </div>
                                            <img src="{{asset('albums/images/'.$photo->album()->first()->directory_name.'/'.$photo->name)}}" alt="Photo 1" class="img-fluid" width="200px" height='200px'>

                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                </div>
                
            </div>
        </div>
        <div class='card-body '>
        <a class="ui-button ui-corner-all ui-widget btn btn-primary"href={{route('album.edit',$album_id)}}> edit album</a>
        </div>
        <div class='card-body '>
        <form action="{{route('album.destroy',$album_id)}}" method="post">
            @csrf
            @method('delete')
            <button type='submit' class="ui-button ui-corner-all ui-widget btn btn-danger"> delete album</button>
        </form>  
    </div>
    @if($albums->count() >=2)
    <div class='card-body '>
        <form action="{{route('album.move',$album_id)}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlSelect1" class="form-label">select the album you want to move photos to </label>
                <select class="form-select" name='move' id="exampleFormControlSelect1" aria-label="Default select example">

                  @foreach ($albums as $album)           
                  @if ($album->id!=$album_id)
                      
                  <option selected value={{$album->id}}>{{$album->name}}</option>
                  @endif          
                  @endforeach
                </select>
              </div>
            <button type='submit' class="ui-button ui-corner-all ui-widget btn btn-danger"> move photos and delete album</button>
        </form>  
    </div>

@endif
    </div>
    </div>
</div>
@endsection