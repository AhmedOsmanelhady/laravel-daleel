<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class DoctorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "title" => $this->title,
            "about" => $this->about,
            "mobile" => $this->mobile,
            "phone" => $this->phone,
            "address" => $this->address,
            "image" => $this->image_url,
            "created_at" => $this->human_readable_created_at,
            
            "rating" =>
                $this->reviews->count() > 0
                    ? round(
                        $this->reviews->sum("star") / $this->reviews->count(),
                        2
                    )
                    : "No rating yet",
            "reviews" => [
                "reviews" => route("reviews.index", $this->id),
            ],
        ];
    }
}
