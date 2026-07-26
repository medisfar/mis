<?php

namespace App\Livewire;

use Livewire\Component;

class M2Tabs extends Component
{
    public $activeTab = 'overview';
    public $tabs = [];
    public $cardHeader = true;
    public $cardClass = '';
    
    protected $queryString = ['activeTab'];
    public function clicked($text){
         return $this->js("alert($text)");
    }
    public function mount($tabs = [], $defaultTab = 'overview', $cardHeader = true)
    {
        $this->tabs = $tabs;
        $this->activeTab = $defaultTab;
        $this->cardHeader = $cardHeader;
    }

    public function switchTab($tab)
    {
        if (isset($this->tabs[$tab])) {
            $this->activeTab = $tab;
        }
    }

    public function render()
    {
        return view('livewire.m2-tabs');
    }
}