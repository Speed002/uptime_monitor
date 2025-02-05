<?php

namespace App\Http\Requests;

use App\Enums\EndpointFrequency;
use App\Models\Endpoint;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class EndpointStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('createEndpoint', $this->site);
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
