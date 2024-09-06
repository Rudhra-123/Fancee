<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\Repositories\VideomsgRepositoryInterface;
use App\Contracts\Repositories\TranslationRepositoryInterface;
use App\Http\Requests\Admin\VideomsgRequest;
use App\Http\Resources\VideomsgResource;
use App\Traits\PaginatorTrait;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Enums\ViewPaths\Admin\videomsg;
use Illuminate\Support\Facades\Log;

class VideomsgController extends Controller
{
    use PaginatorTrait;

    public function __construct(
        private readonly VideomsgRepositoryInterface $videomsgRepo,
        private readonly TranslationRepositoryInterface $translationRepo
    ) { }

    /**
     * Display a listing of the resource.
     *
     * @param Request|null $request
     * @param string|null $type
     * @return View
     */
    public function index(Request|null $request, string $type = null): View
    {
        return $this->getAddView($request);
    }

    /**
     * Get the list of videomsgs.
     *
     * @return JsonResponse
     */
    public function getList(): JsonResponse
    {
        $videomsgs = $this->videomsgRepo->getList(dataLimit: 'all');
        return response()->json(VideomsgResource::collection($videomsgs));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return View
     */
    public function getAddView(Request $request): View
    {
        $videomsgs = $this->videomsgRepo->getListWhere(searchValue: $request->get('searchValue'), dataLimit: getWebConfig(name: 'pagination_limit'));
        $language = getWebConfig(name: 'pnc_language') ?? [];
        $defaultLanguage = $language[0] ?? 'en'; // Ensure there's a default language
        return view(videomsg::LIST[VIEW], compact('videomsgs', 'language', 'defaultLanguage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string|int $id
     * @return View
     */
    public function getUpdateView(string|int $id): View
    {
        $videomsg = $this->videomsgRepo->getFirstWhere(params: ['id' => $id], relations: ['translations']);
        $language = getWebConfig(name: 'pnc_language') ?? [];
        $defaultLanguage = $language[0] ?? 'en'; // Ensure there's a default language
        return view(videomsg::UPDATE[VIEW], compact('videomsg', 'language', 'defaultLanguage'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VideomsgRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function add(VideomsgRequest $request): JsonResponse|RedirectResponse
{
    $dataArray = [
        'message' => $request->input('message')[array_search('en', $request->input('lang'))],
    ];

    $savedVideomsg = $this->videomsgRepo->add(data: $dataArray);
    $this->translationRepo->add(request: $request, model: 'App\Models\Videomsg', id: $savedVideomsg->id);

    // Ensure toastr is called correctly
    Toastr::success(translate('videomsg_added_successfully'));
    return back();
}

public function update(VideomsgRequest $request): RedirectResponse
{
    $dataArray = [
        'message' => $request->input('message')[array_search('en', $request->input('lang'))],
    ];

    $this->videomsgRepo->update(id: $request->input('id'), data: $dataArray);
    $this->translationRepo->update(request: $request, model: 'App\Models\Videomsg', id: $request->input('id'));

    Toastr::success('Video message updated successfully');
    return back();
}


    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
       public function delete(Request $request): JsonResponse
    {
        $id = $request->input('id');

        if (!$id) {
            return response()->json(['message' => translate('id_not_provided')], 400);
        }

        try {
            // Attempt to delete the video message
            $videoDeleted = $this->videomsgRepo->delete(['id' => $id]);

            if (!$videoDeleted) {
                return response()->json(['message' => translate('video_deletion_failed')], 500);
            }

            // Attempt to delete the translation
            $translationDeleted = $this->translationRepo->delete('App\Models\Videomsg', $id);

            if (!$translationDeleted) {
                return response()->json(['message' => translate('translation_deletion_failed')], 500);
            }

            return response()->json(['message' => translate('videomsg_deleted_successfully')]);
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Delete function error: ' . $e->getMessage());

            return response()->json(['message' => translate('an_error_occurred')], 500);
        }
    }

}