<?php

namespace App;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    //
    use SoftDeletes;
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
        if($this->answers > 0)
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
}
