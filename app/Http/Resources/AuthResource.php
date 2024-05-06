<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $array = array(
            "name"         => $this->name,
            "email"        =>$this->email,
            "created_at"   =>'No Date'
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
