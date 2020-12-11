<?php
namespace App\Http\Traits;
use App\User;

trait VotableTrait
{
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

    function getVoteDownStatusAttribute()
    {
        return $this->isVoteDown() ? 'on' : '';
    }


}
