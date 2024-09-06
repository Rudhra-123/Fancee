<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\Models\Video;

class TestEmailSender extends Mailable
{
    use Queueable, SerializesModels;

    protected $video;
    protected $downloadLink;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Video $video)
    {
        $this->video = $video;
        $this->downloadLink = Storage::url($video->path);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your video from fancee Solutions')
                    ->view('email-templates.mail-tester')
                    ->with(['downloadLink' => $this->downloadLink])
                    ->attachData($this->video->data, 'video.mp4', [
                        'mime' => 'video/mp4',
                    ]);
    }
}
