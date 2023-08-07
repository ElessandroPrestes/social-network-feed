<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * @OA\Schema(
     *     schema="PostResource",
     *     title="PostResource",
     *     @OA\Property(property="id", type="integer"),
     *     @OA\Property(property="uuid", type="string"),
     *     @OA\Property(property="name", type="string"),
     *     @OA\Property(property="image", type="string"),
     *     @OA\Property(property="description", type="string"),
     *     @OA\Property(property="created_at", type="string", format="date-time"),
     *     @OA\Property(property="updated_at", type="string", format="date-time")
     * )
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'name'  => $this->name,
            'image' => $this->image,
            'description' => $this->description,
            'created_at' =>$this->created_at->format('d-m-Y:i:s'),
            'updated_at' =>$this->updated_at->format('d-m-Y:i:s'),
        ];
    }
}
