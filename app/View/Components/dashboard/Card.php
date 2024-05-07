<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class Card extends Component
{
    public $title; // Property to hold the title

    /**
     * Create a new component instance.
     *
     * @param string|null $title The title of the card (optional).
     */
    public function __construct($title = null)
    {
        $this->title = $title; // Initialize title from constructor, default to null if not provided
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.card');
    }
}

