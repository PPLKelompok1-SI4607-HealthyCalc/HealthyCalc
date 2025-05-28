<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActivityRequest extends FormRequest
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
            'activity_name' => 'required|string|max:255',
            'duration_minutes' => 'required|integer|min:1',
            'intensity_level' => 'required|in:Tinggi,Sedang,Rendah',
            'calories_burned' => 'required|integer|min:0',
            'activity_date' => 'required|date',
            // 'user_id' => 'required|exists:users,id', // Uncomment if you want to validate user_id
        ];
    }
}
