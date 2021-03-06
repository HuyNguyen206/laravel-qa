<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Question extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $question;
    public function __construct($question)
    {
        //
        $this->question = $question;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.question');
    }
}
