<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'verified' => (bool) $this->email_verified_at,
            'created_at' => $this->created_at?->toDateTimeString(),
            'role' =>'admin',
<<<<<<< HEAD
            'contact'=>new ContactResource($this->contact),        ];
=======
            'contact' => new ContactResource($this->whenLoaded('contact')),
        ];
>>>>>>> 4307c3883626c90fdc7410bdd38355ee166b76cc
    }
}
