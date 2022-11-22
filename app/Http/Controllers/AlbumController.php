<?php

namespace App\Http\Controllers;

use App\models\Album;
use App\models\Photo;
use Illuminate\Http\Request;
use App\Http\Requests\AlbumRequest;
use Illuminate\Support\Facades\Storage;


class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums=album::get();
        return view('gallery.index',compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gallery.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumRequest $album_request)
    {
        $album=Album::create([
            'name'=>$album_request->name,
            'directory_name'=>date(time()),
        ]);
        if(isset($album_request->photo)){
        $photos=$album_request->photo;
        foreach($photos as $photo){
            $photo_name=time().random_int(1,9999999).'.'.$photo->extension();
            $photo_path=public_path('albums\images');
            $album_id= $album->id;
            $photo->move($photo_path.'\\'.$album->directory_name,$photo_name);          
                    Photo::create([
                        'name' => $photo_name,
                        'path' => $photo_path.'\\'.$album->directory_name.'\\'.$photo_name,
                        'album_id' =>$album_id
                ]);}
        }
        return redirect()->route('album.index')->with('success','added successfully ');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photos=album::find($id)->photos()->get();
        $album_id=album::find($id)->id;
        $albums=album::all();

        return view('gallery.show',compact(['photos','album_id','albums']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $album=album::find($id);
        return view('gallery.edit',compact('album'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlbumRequest $album_request, $id)
    {
        $album=album::find($id);
        $album->update([
            'name'=>$album_request->name,
        ]);
        if(isset($album_request->photo)){
        $photos=$album_request->photo;
        foreach($photos as $photo){
            $photo_name=time().random_int(1,9999999).'.'.$photo->extension();
            $photo_path=public_path('albums\images');
            $album_id= $album->id;
            $photo->move($photo_path.'\\'.$album->directory_name,$photo_name);            
                    Photo::create([
                        'name' => $photo_name,
                        'path' => $photo_path.'\\'.$album->directory_name.'\\'.$photo_name,
                        'album_id' =>$album_id
                ]);
        }}
        return redirect()->route('album.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $album=Album::find($id);
     if($album){
        if($album->photos()->get()){
            $album->photos()->delete();
        }
        $album->forceDelete();
        Storage::disk('photos')->deleteDirectory($album->directory_name);
        return redirect()->route('album.index')->with('success','the album and its photos deleted successfully');
     }
    }
    public function move($id ,request $request)
    {

        
        $album=Album::find($id);
        $new_album=album::find($request->move);
        $photos=$album->photos()->get();
        foreach($photos as $photo){
            $new_path=$new_album->directory_name.'\\'.$photo->name;
            $old_path=$album->directory_name.'\\'.$photo->name;
            Storage::disk('photos')->move($old_path,$new_path);
            Photo::create([
                'name' => $photo->name,
                'path' => public_path('albums\images').$new_path,
                'album_id' =>$new_album->id
        ]);
        }
        Storage::disk('photos')->deleteDirectory($album->directory_name);
        if($album){

           $album->forceDelete();
           return redirect()->route('album.index')->with('success','the album and its photos deleted successfully');
        }
    }
    public function photoDestroy($id ,request $request)
    {
        $Photo=photo::find($id);
        // dd(Storage::disk('photos')->delete($Photo->path.'//'.$Photo->name));
        Storage::disk('photos')->delete($Photo->album()->first()->directory_name.'//'.$Photo->name);
        $Photo->forceDelete();
        return redirect()->route('album.show',$Photo->album()->first()->id)->with('success','photo deleted successfully');
    }
}
