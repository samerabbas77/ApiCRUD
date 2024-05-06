<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $array = array(
            'id' => $this->id,
            'Name' => $this->name,
            'Content' => $this->content,
            'created_at' => 'No Time',
        );
        if($this->created_at)
        {
            $array['created_at']= $this->created_at;
        }else{
            $array['created_at']= 'NoTime';

        }
           

        return $array;
    }
}
