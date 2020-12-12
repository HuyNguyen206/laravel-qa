<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Answer extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $question, $answer;
    public function __construct($question, $answer)
    {
        //
        $this->question = $question;
        $this->answer = $answer;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.answer');
    }
}
