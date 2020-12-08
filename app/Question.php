<?php

namespace App;

use Eloquent as Model;

class Question extends Model
{
    //
    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    function setTitleAttributes($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = \Illuminate\Support\Str::slug($value);
    }

    function getUrlAttribute()
    {
        return route('questions.show', $this->id);
    }

    function getDateCreatedAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    function getStatusAttribute()
    {
        if($this->answers > 0)
        {
            return empty($this->best_answer_id) ? 'answered' : 'accept-as-answered';
        }
        else
        {
            return '';
        }
    }
}
