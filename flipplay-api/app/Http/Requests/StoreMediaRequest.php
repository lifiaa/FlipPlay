<?php
// memvalidasi data ketika menambahkan media.
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:media,title',
            'type' => 'required|string|max:100',
            'genre' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'duration' => 'nullable|integer|min:1',
            'seasons' => 'nullable|integer|min:1',
            'episodes' => 'nullable|integer|min:1',
        ];
    }
}
