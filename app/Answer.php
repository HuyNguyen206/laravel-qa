<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
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
    }

    function getDateCreatedAttribute()
    {
        return $this->created_at->diffForHumans();
    }

}
