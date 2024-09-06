<?php

namespace App\Http\Requests\Admin;

use App\Traits\ResponseHandler;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Validator;

/**
 * Class VideomsgRequest
 *
 * @property int $id
 * @property string $message
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class VideomsgRequest extends FormRequest
{
    use ResponseHandler;

    protected $stopOnFirstFailure = true;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'heading' => 'required|array',
            'heading.*' => 'required|string',
            'message' => 'required|array',
            'message.*' => 'required|string',
            'lang' => 'required|array',
            'lang.*' => 'required|string|size:2',
        ];
    }

    public function messages(): array
    {
        return [
            'heading.required' => translate('the_heading_field_is_required!'),
            'heading.*.required' => translate('the_heading_field_is_required!'),
            'heading.*.string' => translate('the_heading_field_must_be_a_string!'),
            'message.required' => translate('the_message_field_is_required!'),
            'message.*.required' => translate('the_message_field_is_required!'),
            'message.*.string' => translate('the_message_field_must_be_a_string!'),
            'lang.required' => translate('the_language_field_is_required!'),
            'lang.*.required' => translate('the_language_field_is_required!'),
            'lang.*.string' => translate('the_language_field_must_be_a_string!'),
            'lang.*.size' => translate('the_language_field_must_be_two_characters!'),
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $defaultLangKey = array_search('en', $this->input('lang', []));
            if ($defaultLangKey === false || empty($this->input('message')[$defaultLangKey])) {
                $validator->errors()->add('message', translate('the_message_field_is_required_for_default_language!'));
            }
        });
    }
}
