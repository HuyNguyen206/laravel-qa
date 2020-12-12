<?php

namespace App\View\Components;

use App\Question;
use Illuminate\View\Component;

class Vote extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $model, $voteUpTitle, $voteDownTitle, $lowerModel, $canVoteUp, $canVoteDown, $voteCount;
    public function __construct($model, $voteUpTitle, $voteDownTitle, $lowerModel, $upperModel)
    {
        //
        $this->model= $model;
        $this->voteUpTitle= $voteUpTitle;
        $this->voteDownTitle= $voteDownTitle;
        $this->lowerModel= $lowerModel;
        $this->canVoteUp= "voteUp".$upperModel;
        $this->canVoteDown= "voteDown".$upperModel;
        if($model instanceof Question)
        {
            $this->voteCount = $model->votes;
        }
        else
        {
            $this->voteCount = $model->votes_count;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.vote');
    }
}
