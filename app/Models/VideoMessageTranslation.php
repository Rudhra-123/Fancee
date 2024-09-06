<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $video_message_id
 * @property string $locale
 * @property string $heading
 * @property string $message
 */

class VideoMessageTranslation extends Model
{
    use HasFactory;

    protected $table = 'video_message_translations';

    protected $fillable = [
        'video_message_id',
        'locale',
        'heading',
        'message',
    ];

    protected $casts = [
        'id' => 'integer',
        'video_message_id' => 'integer',
        'locale' => 'string',
        'heading' => 'string',
        'message' => 'string',
    ];

    public function videoMessage()
    {
        return $this->belongsTo(Videomsg::class);
    }
}
