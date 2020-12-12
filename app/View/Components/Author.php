<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Author extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $label, $model;
    public function __construct($label, $model)
    {
        $this->label = $label;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.author');
    }
}
