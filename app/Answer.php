<?php

namespace App;

use App\Http\Traits\VotableTrait;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    use VotableTrait;
    protected $guarded = [];
    protected $with = ['user'];
    protected $appends = ['date_created', 'body_html'];
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
        return clean(\Parsedown::instance()->text($this->body));
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



    function isVoteUp()
    {
        return auth()->check() ? auth()->user()->VoteAnswers()->wherePivot('votable_id', $this->id)->wherePivot('vote', 1)->count() > 0 : false;
    }


    function isVoteDown()
    {
        return auth()->check() ? auth()->user()->VoteAnswers()->wherePivot('votable_id', $this->id)->wherePivot('vote', -1)->count() > 0 : false;
    }

}
