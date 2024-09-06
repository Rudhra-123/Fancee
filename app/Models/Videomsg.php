<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\App;

/**
 * @property int $id
 * @property string $heading
 * @property string $message
 * @property string $language
 */

class Videomsg extends Model
{
    use HasFactory;

    protected $table = 'videomsg';

    protected $fillable = [
        'heading',
        'message',
        'language',
    ];

    protected $casts = [
        'id' => 'integer',
        'heading' => 'string',
        'message' => 'string',
        'language' => 'string',
    ];

    public function translations(): MorphMany
    {
        return $this->morphMany('App\Models\Translation', 'translationable');
    }

    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope('translate', function (Builder $builder) {
            $builder->with(['translations' => function ($query) {
                if (request()->is('api/*')) {
                    return $query->where('locale', App::getLocale());
                } else {
                    return $query->where('locale', getDefaultLanguage());
                }
            }]);
        });
    }
}
