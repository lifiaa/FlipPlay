<?php
// memvalidasi data ketika memperbarui media.
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('media', 'title')->ignore($this->route('media')), //mencegah judul media duplikat
            ], //memungkinkan pembaruan sebagian data melalui PATCH
            'type' => 'sometimes|required|string|max:100',
            'genre' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'duration' => 'nullable|integer|min:1',
            'seasons' => 'nullable|integer|min:1',
            'episodes' => 'nullable|integer|min:1',
        ];
    }
}
