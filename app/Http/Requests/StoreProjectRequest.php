<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:100',
            'author' => 'required|string|max:50',
            'description' => 'required|string|max:1000',
            'type_id' => 'required|exists:types,id'
        ];
    }

    /**
     * Get the validation messages.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'title.required' => 'The title is required',
            'title.string' => 'the title must be a text',
            'title.max' => 'The title must be :max characters',

            'author.required' => 'The author is required',
            'author.string' => 'The author must be a text',
            'author.max' => 'The author must be :max characters',

            'description.required' => 'The description is required',
            'description.string' => 'The description must be a text',
            'description.max' => 'The description must be :max characters',

            'type_id.required' => 'The type is required',
            'type_id.exists' => 'the type must be selected from the proposed options!',
        ];
    }
}
