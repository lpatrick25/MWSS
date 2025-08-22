<?php

namespace App\Http\Resources\Concessionaire;

use App\Http\Resources\Resource;

class ConcessionaireResource extends Resource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'account_number' => $this->account_number,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'extension_name' => $this->extension_name,
            'service_address' => $this->service_address,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
