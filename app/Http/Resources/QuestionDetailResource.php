<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionDetailResource extends JsonResource
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
            'votes' => $this->votes,
            'status' => $this->status,
            'answers_count' => $this->answers_count,
            'views' => $this->views,
            'url' => $this->url,
            'title' => $this->title,
            'id' => $this->id,
            'user' => new UserResource($this->user),
            'date_created' => $this->date_created,
            'best_answer_id' => $this->best_answer_id,
            'body' => $this->body,
            'body_html' => $this->body_html,
            'vote_down_status' => $this->vote_down_status,
            'vote_up_status' => $this->vote_up_status,
            'status_favorite' => $this->status_favorite,
        ];
    }
}
