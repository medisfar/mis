<?php
namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Request;

class Mtabs extends Component
{
    public $tabs;
    public $activeTab;
    public function __construct($tabs)
    {
        $this->activeTab = Request::query('tab', $tabs[0]['id']);
        $this->tabs = $tabs;
    }

    public function render()
    {
        return view('components.mtabs');
    }
}