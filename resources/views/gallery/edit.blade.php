@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">edit album</div>
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form action={{route('album.update',$album->id)}} method="post"  enctype="multipart/form-data" >
                        
                            @method('patch')
                            @csrf
                            <div class="form-groub">
                                <label for="name">album name </label>
                                <input type="text" name='name' placeholder="album name" value='{{$album->name}}'>
                            </div>
                            <div class="form-groub">
                                <label for="photo">select photo </label>
                                <input type="file" name="photo[]"  multiple>
                            </div>
                            
                            <button type="submit" class='btn btn-primary'>
                                edit {{$album->name}} album
                            </button>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection