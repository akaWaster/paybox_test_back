<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class PaymentCollection extends ResourceCollection
{
    public $collects = PaymentResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return Collection
     */

    public function toArray($request)
    {
        return $this->collection;
    }
}
