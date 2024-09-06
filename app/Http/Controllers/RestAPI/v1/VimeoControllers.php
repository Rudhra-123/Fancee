<?php

namespace App\Http\Controllers\RestAPI\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\VimeoService;
use App\Models\VimeoUri;
use Illuminate\Http\JsonResponse;

class VimeoControllers extends Controller
{
    protected $vimeoService;

    public function __construct(VimeoService $vimeoService)
    {
        $this->vimeoService = $vimeoService;
    }

    public function uploadVideoApi(Request $request): JsonResponse
    {
        // Validate the request
        $request->validate([
            'video' => 'required|mimes:mp4,mov,avi|max:20000', // Adjust max size as needed
        ]);

        // Upload the video to Vimeo
        $videoPath = $request->file('video')->getPathName();
        $videoUri = $this->vimeoService->uploadVideo($videoPath);

        // Save the video URI to the database
        VimeoUri::create([
            'uri' => $videoUri,
            'order_id' => $request->input('order_id') // Save the order_id if needed
        ]);

        $videoId = str_replace('/videos/', '', $videoUri);

        // Return the video URI 
        return response()->json([
            'success' => true,
            'message' => 'Video uploaded successfully!',
            'videoUri' => $videoUri,
            'video_id' => $videoId, 
            'order_id' => $request->input('order_id')
        ]);
    }

    public function getVideoByOrderId($orderId): JsonResponse
    {
        // Fetch the latest video record based on order_id
        $vimeoUri = VimeoUri::where('order_id', $orderId)
                            ->latest() // Sort by the 'created_at' column in descending order
                            ->first();
       
        // Check if the video exists
        if (!$vimeoUri) {
            return response()->json([
                'success' => false,
                'message' => 'Video not found for the given order ID!'
            ], 404);
        }
    
        // Remove '/videos/' from the videoUri
        $videoUri = str_replace('/videos/', '', $vimeoUri->uri);
    
        // Return the latest video ID
        return response()->json([
            'success' => true,
            'video_id' => $videoUri,  // The latest video ID without '/videos/' prefix
            'order_id' => $orderId
        ]);
    }
    
}
