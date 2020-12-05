<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JSONAPIResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => (string)$this->id,
            'type' => $this->type(),
            'attributes' => $this->allowedAttributes(),
            'relationships' => $this->prepareRelationships(),
        ];
    }


    private function prepareRelationships(){
        return collect(config("jsonapi.resources.{$this->type()}.relationships"))->flatMap(function($related){
            $relatedRelation = $related['relation'];
            $relatedModel = $related['model'];
            return [
                $relatedModel => [
                    'data' => $this->{$relatedRelation},
                ],
            ];
        });
    }

}
