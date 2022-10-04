<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class DoctorCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
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
            "image" => $this->image_url,
            "city" => $this->city,
            "rating" =>
            $this->reviews->count() > 0
                ? round(
                    $this->reviews->sum("star") / $this->reviews->count(),
                    2
                )
                : "No rating yet",

        ];
    }
}
