<?php

namespace App\Http\Resources;

use App\Enums\EndpointFrequency;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EndpointResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'location' => $this->location,
            'frequency_label' => EndpointFrequency::from($this->frequency)->label(),//returning the frequency label from $this->frequency
                                                // enum::from() returns an enum value, hence appending ->label() to get the label() from it
            'frequency_value' => EndpointFrequency::from($this->frequency)->value,
            'latest_check' => CheckResource::make($this->check), //returns the latest check
            'url' => $this->url(),
            'site' => SiteResource::make($this->site),
            'checks' => CheckResource::collection($this->checks)

        ];
    }
}
