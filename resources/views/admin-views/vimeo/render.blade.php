@php
    use App\Models\VimeoUri;
    use Vimeo\Vimeo;

    
    $data = $order->id; 

    
    $orderIds = VimeoUri::pluck('order_id')->toArray(); 

    // Initialize variables
    $videoId = null;
    $downloadUrl = null;

    // Check if the current order ID exists in the vimeo_uris table
    if (in_array($data, $orderIds)) {
        // Fetch the Vimeo URI record for the matching order_id
        $vimeoUriRecord = VimeoUri::where('order_id', $data)->latest('created_at')->first();
        
        if ($vimeoUriRecord) {
            $videoUri = $vimeoUriRecord->uri;
            $videoId = substr($videoUri, strrpos($videoUri, '/') + 1); // Extract video ID
            $videoId = preg_replace('/[^0-9]/', '', $videoId);

            // Initialize Vimeo client
            $vimeo = new Vimeo(env('VIMEO_CLIENT_ID'), env('VIMEO_CLIENT_SECRET'), env('VIMEO_ACCESS_TOKEN'));

            // Fetch video details from Vimeo
            $response = $vimeo->request("/videos/{$videoId}", [], 'GET');
            
            // Extract download URL if available
            if (isset($response['body']['download']) && count($response['body']['download']) > 0) {
                $downloadUrl = $response['body']['download'][0]['link'];
            }
        }
    }
@endphp

<div class="video-container" style="max-width: 640px; margin: auto; text-align: center;">
    <h1>Watch this Video!</h1>
    <div class="video-and-button" style="display: flex; align-items: center; justify-content: center;">
        @if($videoId)
            <!-- Display the video with the unique identifier -->
            <iframe src="https://player.vimeo.com/video/{{ $videoId }}" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
            <!-- Download Button -->
            @if($downloadUrl)
                <a href="{{ $downloadUrl }}" style="margin-left: 10px; padding: 10px 20px; background-color: #0073e6; color: white; text-decoration: none; border-radius: 10px; display: inline-block;" target="_blank">Download</a>
            @endif
        @else
            <p>No video found for this order.</p>
        @endif
    </div>
</div>
