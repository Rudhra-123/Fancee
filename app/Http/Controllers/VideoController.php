<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;


class VideoController extends Controller
{
    public function showUploadForm()
    {
        return view('admin-views.localvideoupload.upload');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'required|mimes:mp4,mov,avi|max:20000',
        ]);

        // Store the video on the server
        $videoPath = $request->file('video')->store('videos', 'public');
        //dd($videoPath);

        // Save video information in the database
        $video = new Video();
        $video->title = $request->input('title');
        $video->path = $videoPath;
        $video->save();

        //Mail::to($request->input('email'))->send(new SendMail($video));

       

        return redirect()->back()->with('success', 'Video uploaded successfully.');
    }
}
