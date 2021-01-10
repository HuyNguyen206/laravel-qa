<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
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
            'status' => $this->status,
            'votes_count' => $this->votes_count,
            'id' => $this->id,
            'user' => new UserResource($this->user),
            'date_created' => $this->date_created,
            'body_html' => $this->body_html,
            'body' => $this->body,
            'vote_down_status' => $this->vote_down_status,
            'vote_up_status' => $this->vote_up_status,
            'is_best' => $this->is_best,
            'question' => $this->question,
            'user_id' => $this->user_id
        ];
    }
}
