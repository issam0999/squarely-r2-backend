<?php

namespace App\Http\Resources;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
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
<<<<<<< HEAD
            'center_id' => $this->center_id,
            'avatarImg' => 'C:\Users\ihajjali\Documents\squarely-r2\squarely-app\app-frontend\public\images\avatars',//$this->image,
=======
            'image_url' => $this->image ? $this->getImageUrl($this->image) : null,
>>>>>>> 4307c3883626c90fdc7410bdd38355ee166b76cc
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'type_id' => $this->type_id,
            'date_of_birth' => $this->date_of_birth,
            'country_id' => $this->country_id,
            'city_id' => $this->city_id,
            'status' => $this->status === Contact::STATUS_ACTIVE,
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
