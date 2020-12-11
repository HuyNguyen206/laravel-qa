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

    function voteUser()
    {
        return $this->morphToMany(User::class, 'votable')->withPivot('vote');
    }

    function votesUp()
    {
        return $this->voteUser()->wherePivot('vote', 1);
    }

    function votesDown()
    {
        return $this->voteUser()->wherePivot('vote', -1);
    }

    function getVoteUpStatusAttribute()
    {
        return $this->isVoteUp() ? 'on' : '';
    }

    function isVoteUp()
    {
        return auth()->check() ? auth()->user()->VoteAnswers()->wherePivot('votable_id', $this->id)->wherePivot('vote', 1)->count() > 0 : false;
    }

    function getVoteDownStatusAttribute()
    {
        return $this->isVoteDown() ? 'on' : '';
    }

    function isVoteDown()
    {
        return auth()->check() ? auth()->user()->VoteAnswers()->wherePivot('votable_id', $this->id)->wherePivot('vote', -1)->count() > 0 : false;
    }



}
