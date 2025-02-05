<?php

namespace App\Http\Requests;

use App\Enums\EndpointFrequency;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class EndpointUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return false; //by default .... if set to true -> it means anyonw can authorize this action
        return $this->user()->can('update', $this->endpoint);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'location' => ['required'],
            'frequency'=> ['required', new Enum(EndpointFrequency::class)] //this ensures only enums defined are entered in the database
        ];
    }
}
