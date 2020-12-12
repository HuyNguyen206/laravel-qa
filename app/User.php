<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

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


}
