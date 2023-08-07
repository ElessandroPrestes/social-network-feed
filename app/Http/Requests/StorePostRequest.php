<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:posts',
            'image' => 'required|image|mimes:jpeg,png|max:2048',
            'description' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome não pode ter mais de 255 caracteres.',
            'image.required' => 'O campo imagem é obrigatório.',
            'image.image' => 'O campo imagem deve ser uma imagem.',
            'image.mimes' => 'A imagem deve estar no formato JPEG ou PNG.',
            'image.max' => 'O tamanho da imagem deve ser menor que 2MB.',
            'description.required' => 'O campo descrição é obrigatório.',
            'description.string' => 'O campo descrição deve ser uma string.',
        ];
    }
}
