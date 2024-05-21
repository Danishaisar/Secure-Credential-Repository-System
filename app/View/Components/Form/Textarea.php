<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Textarea extends Component
{
    public $id;
    public $name;
    public $value;
    public $class;

    public function __construct($id, $name, $value = '', $class = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
        $this->class = $class;
    }

    public function render()
    {
        return view('components.form.textarea');
    }
}
