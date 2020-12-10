<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    protected $guarded = [];
    function question()
    {
        return $this->belongsTo(Question::class);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }

    protected static function booted()
    {
        static::created(function($answer){
            $answer->question()->increment('answers_count');
        });
        static::deleted(function($answer){
            $answer->question()->decrement('answers_count');
        });

    }

    function getStatusAttribute()
    {
        return $this->isBestAnswer() ? 'vote-accepted' : '';
    }

    function getDateCreatedAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    function getIsBestAttribute()
    {
        return $this->isBestAnswer();
    }

    function isBestAnswer()
    {
        return $this->question->best_answer_id == $this->id;
    }

}
