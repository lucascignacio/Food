<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProduct extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $id = $this->segment(3);

        $rules = [
            'title' => ['required', 'min:3', 'max:255', "unique:products,title,{$id},id"],
            'description' => ['required', 'min:3', 'max:500'],
            'image' => ['required', 'image'],
            'price' => "required|regex:/^\d+(\.\d{1,2})?$/",
        ];

        if($this->method() == 'PUT') {
            $rules['image'] = ['nullable', 'image'];
        }

        return $rules;
    }
}
