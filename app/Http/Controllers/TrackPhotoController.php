<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;

class TrackPhotoController extends Controller
{
    public function store(Request $request)
    {
        $photo = $request->file('photo');

        $name = md5($photo->getClientOriginalName()) . date('YmdHis') . '.' . $photo->getClientOriginalExtension();

        $saved = $photo->storeAs('public/photos', $name);

        $track = Track::find($request->track);

        Track::find($request->track)->images()->create([
            'trai_path' => $saved,
        ]);
    }
}
