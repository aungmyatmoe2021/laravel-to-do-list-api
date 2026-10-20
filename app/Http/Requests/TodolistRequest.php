<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class TodolistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    // Before validation, default is pending
    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => $this->input('status', 'pending'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>'required|string|max:100',
            'description'=>'nullable|max:500',
            'status' => 'required|string|in:pending,in_progress,completed'
        ];
    }

    public function messages(){
        return [
            'title.required' => 'You need to fill title',
            'title.max' => 'Title is only accept 100 character',
            'title.string' => 'Title is only accept string',
            'description.max' => 'Description is only accept 500 character',
        ];
    }
}
