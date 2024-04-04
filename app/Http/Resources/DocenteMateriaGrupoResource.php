<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DocenteMateriaGrupoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id'=>$this->id,
            'teacher'=>new TeacherResource($this->teacher),
            'subject'=>new SubjectResource($this->subject),
            'group'=>new GroupResource($this->group)
            //'teacher_id'=>TeacherResource::collection($this->whenLoaded('teacher')),
            //'subject_id'=>SubjectResource::collection($this->whenLoaded('subject')),
            //'group_id'=>GroupResource::collection($this->whenLoaded('group'))
        ];
    }
}
