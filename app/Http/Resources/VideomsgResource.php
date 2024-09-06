<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class VideomsgResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'data' => $this->collection->map(function ($model) {
                return [
                    'id' => $model->id,
                    'message' => $model->message, // Updated to reflect the Videomsg model
                ];
            }),
            'meta' => [
                'total' => $this->collection->count(),
            ],
        ];
    }

    /**
     * Customize the outgoing response for the resource.
     *
     * @param  Request  $request
     * @param  Response  $response
     * @return void
     */
    public function withResponse($request, $response): void
    {
        $response->setStatusCode(200);
    }
}