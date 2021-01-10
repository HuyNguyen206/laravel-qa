<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $appends = ['url', 'avatar'];
    function questions()
    {
        return $this->hasMany(Question::class, 'user_id');
    }

    function answers()
    {
        return $this->hasMany(Answer::class);
    }

    function getUrlAttribute()
    {
//        return route('questions.show', $this->id);
        return '#';
    }

    function getAvatarAttribute()
    {
        $email = "someone@somewhere.com";
        $size = 40;
        $grav_url = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?s=" . $size;

        return $grav_url;
    }

    function favoriteQuestions()
    {
        return $this->belongsToMany(Question::class, 'favorites')->withTimestamps(); // 'question_id','user_id');
    }

    function voteQuestions()
    {
        return $this->morphedByMany(Question::class, 'votable');
    }

    function voteAnswers()
    {
        return $this->morphedByMany(Answer::class, 'votable');
    }

    function voteQuestion(Question $question, $vote)
    {
        $voteQuestions = $this->voteQuestions();
        $this->_vote($voteQuestions, $question, $vote);
    }

    function voteAnswer(Answer $answer, $vote)
    {
        $voteAnswers = $this->voteAnswers();
        $this->_vote($voteAnswers, $answer, $vote, false);
    }

    private function _vote($relationMethod, $model, $vote, $isQuestion = true)
    {
        if ($relationMethod->wherePivot('votable_id', $model->id)->exists()) {
            $relationMethod->updateExistingPivot($model->id, ['vote' => $vote]);
        } else {
            $relationMethod->attach($model->id, ['vote' => $vote]);
        }
        $votesUp = (int)$model->votesUp()->sum('vote');
        $votesDown = (int)$model->votesDown()->sum('vote');
        if ($isQuestion)
        {
            $model->votes = $votesUp + $votesDown;
        }
        else
        {
            $model->votes_count = $votesUp + $votesDown;
        }
        $model->save();
    }

    function posts()
    {
        $type = request()->get('type','all');
        if($type === 'Q')
        {
            $posts = $this->questions;
        }
        else if ($type === 'A')
        {
            $posts = $this->answers;
        }
        else
        {
            $posts = ($this->questions)->toBase()->merge($this->answers);
        }
        $data = collect();
        foreach ($posts as $post)
        {
            $item['created_at'] =  $post->created_at->format('M d Y');
            if($post instanceof Question)
            {
                $item['type'] = 'Q';
                $item['title'] = $post->title;
                $item['accepted'] = (bool) $post->best_answer_id;
                $item['votes_count'] = $post->votes;
            }
            elseif($post instanceof Answer)
            {
                $item['type'] = 'A';
                $item['title'] = $post->body;
                $item['accepted'] =  $post->question->best_answer_id === $post->id;
                $item['votes_count'] = $post->votes_count;
            }
            $data->push($item);
        }
        return $data->sortByDesc('votes_count')->values()->all();

    }


}
