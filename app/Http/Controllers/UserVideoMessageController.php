<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserVideoMessage;

class UserVideoMessageController extends Controller
{
    public function index()
    {
        $videomsgs = UserVideoMessage::paginate(10);
        return view('index', compact('videomsgs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'heading' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        UserVideoMessage::create($request->all());

        return redirect()->back()->with('success', 'Video message created successfully.');
    }
}