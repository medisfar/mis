<?php

namespace App\Livewire\Lte;

use Livewire\Component;

class ChartjsComponent extends Component
{
    public string $chartId;
    public string $chartType;
    public array $chartData;
    public array $chartOptions;
    public bool $withPlugins;

    public function mount(
        string $chartId,
        string $chartType = 'bar',
        array $chartData = [],
        array $chartOptions = [],
        bool $withPlugins = false
    ) {
        $this->chartId = $chartId;
        $this->chartType = $chartType;
        $this->chartData = $chartData;
        $this->chartOptions = $chartOptions;
        $this->withPlugins = $withPlugins;
    }

    public function render()
    {
        return view('livewire.lte.chartjs-component');
    }
}