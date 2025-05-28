<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecipeRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'calories' => 'nullable|numeric|min:0',
            'protein' => 'nullable|numeric|min:0',
            'carb' => 'nullable|numeric|min:0',
            'fat' => 'nullable|numeric|min:0',
            'nutrition_type' => 'nullable|in:Diet,Tinggi Protein,Rendah Kalori,Vegetarian',
            'time' => 'nullable|integer|min:0',
            'ingridients' => 'required|string',
            'steps' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ];
    }
}
