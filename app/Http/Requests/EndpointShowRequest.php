<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EndpointShowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // we are accessing $this->endpoint from route model binding
        return $this->user()->can('show', $this->endpoint);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
