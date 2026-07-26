<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Rowb extends Component
{
    public $label;
    public $icon;
    public $text;
    public $value;
    public $unit;

    public function __construct($label, $icon = 'bi bi-gear-fill', $text = '', $value = 0, $unit = '%')
    {
        $this->label = $label;
        $this->icon = $icon;
        $this->text = $text;
        $this->value = $value;
        $this->unit = $unit;
    }

    public function render(): View|Closure|string
    {
        return view('components.rowb');
    }
}