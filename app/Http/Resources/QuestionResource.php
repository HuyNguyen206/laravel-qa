<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'body_html' => $this->body_html,
            'user_id' => $this->user_id,
            'body' => $this->body,
            'slug' => $this->slug,
            'favorite_counts' => $this->favorite_counts,
            'status_favorite' => $this->status_favorite,
            'vote_up_status'=> $this->vote_up_status,
            'vote_down_status' => $this->vote_down_status,
        ];
    }
}
