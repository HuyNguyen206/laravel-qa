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
            $question = $answer->question;
            $question->decrement('answers_count');
            if($question->best_answer_id == $answer->id)
            {
                $question->best_answer_id = null;
                $question->save();
            }
        });

    }

    function getStatusAttribute()
    {
            return $this->id == $this->question->best_answer_id ? 'vote-accepted' : '';
    }

    function getDateCreatedAttribute()
    {
        return $this->created_at->diffForHumans();
    }

}
