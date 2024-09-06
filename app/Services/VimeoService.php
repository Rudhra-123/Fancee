<?php

namespace App\Services;

use Vimeo\Vimeo;

class VimeoService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Vimeo(
            config('vimeo.client_id'),
            config('vimeo.client_secret'),
            config('vimeo.access_token')
        );
    }

    public function uploadVideo($path)
    {
        return $this->client->upload($path);
    }

    public function getVideoInfo($videoId)
    {
        return $this->client->request("/videos/{$videoId}", [], 'GET');
    }

    // Add more Vimeo API methods as needed
}
