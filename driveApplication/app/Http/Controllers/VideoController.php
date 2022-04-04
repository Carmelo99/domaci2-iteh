<?php

namespace App\Http\Controllers;

use App\Http\Resources\VideoResource;
use App\Models\Video;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::all();
        return response()->json(['videos' => VideoResource::collection($videos)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:100',
            'length' => 'required|integer',
            'resolution' => 'required|integer',
            'owner' => 'required|max:50',
            'folder_id'=>'required'
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors(), 'Validation Error']);
        }

        $video = Video::create([
            'name'=>$request->name,
            'length'=>$request->length,
            'resolution'=>$request->resolution,
            'owner'=>$request->owner,
            'folder_id'=>$request->folder_id,
            'user_id'=>Auth::user()->id 
        ]);

        return response()->json(['video' => new VideoResource($video), 'message' => 'Video created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        return response()->json(['video' => new VideoResource($video)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:100',
            'length' => 'required|integer',
            'resolution' => 'required|integer',
            'owner' => 'required|max:50',
            'folder_id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors(), 'Validation Error']);
        }

        $video->update($data);

        return response()->json(['video' => new VideoResource($video), 'message' => 'Video updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        $video->delete();

        return response()->json(['message' => 'Video deleted successfully']);
    }
}
