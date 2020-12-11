<?php

namespace App;

use App\Http\Traits\VotableTrait;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    //
    use SoftDeletes, VotableTrait;
    protected $guarded = [];
    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = \Illuminate\Support\Str::slug($value);
    }

    function getUrlAttribute()
    {
        return route('questions.show', $this->slug);
    }

    function getDateCreatedAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    function getStatusAttribute()
    {
        if($this->answers_count > 0)
        {
            return empty($this->best_answer_id) ? 'answered' : 'accept-as-answered';
        }
        else
        {
            return '';
        }
    }

    function getBodyHtmlAttribute()
    {
       return \Parsedown::instance()->text($this->body);
    }

    function answers()
    {
        return $this->hasMany(Answer::class);
    }

    function favoriteUsers()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps(); // 'user_id', 'question_id');
    }

    function getIsFavoriteAttribute()
    {
        return $this->isFavorite();
    }
    function getStatusFavoriteAttribute()
    {
        return $this->isFavorite() ? 'on' : '';
    }
    function getFavoriteCountsAttribute()
    {
        return $this->favoriteUsers->count();
    }

    function isFavorite()
    {
        return \Auth::user()->favoriteQuestions->contains('id', $this->id);
    }

    function isVoteUp()
    {
        return auth()->check() ? auth()->user()->VoteQuestions()->wherePivot('votable_id', $this->id)->wherePivot('vote', 1)->count() > 0 : false;
    }


    function isVoteDown()
    {
        return auth()->check() ? auth()->user()->VoteQuestions()->wherePivot('votable_id', $this->id)->wherePivot('vote', -1)->count() > 0 : false;
    }

}
