<?php

namespace App\Http\Requests;

use App\Rules\ValidLanguageRule;
use Illuminate\Foundation\Http\FormRequest;

class NewsStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'                   => 'required|min:3',
            'description'             => 'required|min:10',
            'language_code'           => ['required',new ValidLanguageRule],
            'status'                  => 'required|in:0,1',
        ];
    }
}
