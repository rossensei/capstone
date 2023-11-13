<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'size' => $this->size,
            'category' => $this->category->cat_name,
            'qty' => $this->qty,
            'unit' => $this->unit->name,
            'expiry_date' => $this->unit->expiry_date,
        ];
    }
}
