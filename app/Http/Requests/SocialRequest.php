<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SocialRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array {
        $rule = 'max:255';
        return [
            'title' => $rule,
            'url' => $rule,
            'icon' => $rule,
            'status' => 'boolean'
        ];
    }

    public function messages(): array {
        $max = ' 255 simvoldan çox ola bilməz.';
        return [
            'title.max' => 'Ad' . $max,
            'url.max' => 'URL' . $max,
            'icon.max' => 'İkon' . $max,
        ];
    }
}
