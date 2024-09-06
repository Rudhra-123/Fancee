<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VimeoService;



use App\Contracts\Repositories\BusinessSettingRepositoryInterface;
// use App\Enums\ViewPaths\Admin\Order;
use App\Enums\ViewPaths\Admin\VimeoAPI;
use App\Http\Controllers\BaseController;
use App\Utils\Helpers;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Vimeo\Laravel\VimeoManager;
use Illuminate\Support\Facades\Log;
use App\Models\VimeoUri;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;







class VimeoController extends Controller
{
    protected $vimeoService;
    private $businessSettingRepo;

    public function __construct(VimeoService $vimeoService, BusinessSettingRepositoryInterface $businessSettingRepo)
    {
        $this->vimeoService = $vimeoService;
        $this->businessSettingRepo = $businessSettingRepo;
    }
    public function index(Request|null $request, string $type = null): View
    {
        return $this->getView();
    }

    public function upload(Request $request)
    {
        // Validate the request
        
        
        $request->validate([
            'video' => 'required|mimes:mp4,mov,avi|max:20000', // Adjust max size as needed
        ]);
    
        // Upload the video to Vimeo
        $videoPath = $request->file('video')->getPathName();
        $videoUri = $this->vimeoService->uploadVideo($videoPath);
        //dd($videoUri);

        // VimeoUri::create(['uri' => $videoUri]);
        VimeoUri::create([
            'uri' => $videoUri,
            'order_id' => $request->input('order_id'), // Save the order_id
        ]);



        // Redirect to a view where you want to display the video
        //return redirect()->route('render.video', ['videoUri' => $videoUri]);
        
         return redirect()->back()->with('videoUri', $videoUri);
    }
    
  


   


    public function getVideoInfo($id): JsonResponse
    {
        // Fetch video info using the video ID (assuming the ID is the primary key)
        $video = VimeoUri::find($id);
        //dd($video);
    
        if (!$video) {
            return response()->json([
                'success' => false,
                'message' => 'Video not found',
            ], 404);
        }
    
        return response()->json([
            'success' => true,
            'data' => $video,
        ]);
    }


    public function getView(): View
    {
        
        $vimeoClientID = Helpers::get_business_settings('vimeo_client_id');
        $vimeoClientSecret = Helpers::get_business_settings('vimeo_client_secret');
        $vimeoAccessToken = Helpers::get_business_settings('vimeo_access_token');
    
        return view(VimeoAPI::VIEW->value, compact('vimeoClientID', 'vimeoClientSecret', 'vimeoAccessToken'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'vimeo_client_id' => 'required|string',
            'vimeo_client_secret' => 'required|string',
            'vimeo_access_token' => 'required|string',
        ]);
        //dd($request);
        // Update environment variables
        $envFilePath = base_path('.env');
        if (File::exists($envFilePath)) {
            File::put($envFilePath, str_replace(
                [
                    'VIMEO_CLIENT_ID=' . env('VIMEO_CLIENT_ID'),
                    'VIMEO_CLIENT_SECRET=' . env('VIMEO_CLIENT_SECRET'),
                    'VIMEO_ACCESS_TOKEN=' . env('VIMEO_ACCESS_TOKEN'),
                ],
                [
                    'VIMEO_CLIENT_ID=' . $request->input('vimeo_client_id'),
                    'VIMEO_CLIENT_SECRET=' . $request->input('vimeo_client_secret'),
                    'VIMEO_ACCESS_TOKEN=' . $request->input('vimeo_access_token'),
                ],
                File::get($envFilePath)
            ));
        }
        dd($envFilePath);

        // Clear config cache to reflect changes
        Artisan::call('config:cache');

        

        $this->businessSettingRepo->updateOrInsert(type: 'vimeo_client_id', value: $request['vimeo_client_id'] ?? '');
        $this->businessSettingRepo->updateOrInsert(type: 'vimeo_client_secret', value: $request['vimeo_client_secret'] ?? '');
        $this->businessSettingRepo->updateOrInsert(type: 'vimeo_access_token', value: $request['vimeo_access_token'] ?? '');
       // $this->businessSettingRepo->updateOrInsert(type: 'vimeo_api_status', value: $request->get('status', 0));
        
        Toastr::success(translate('config_data_updated'));
        return back();
    }
    
}
