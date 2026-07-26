<?php

namespace App\Livewire;

use Livewire\Component;

class ChartComponent extends Component
{
    public string $chartId = 'myChart';
    public string $chartType = 'line';
    public array $labels = [];
    public array $datasets = [];
    public array $options = [];
    
    // ⭐ Define ALL properties that might be used in Blade
    public ?array $chartData = null;
    public ?array $chartOptions = null;
    public string $title = 'Chart';
    public string $period = 'monthly';
    public int $year = 2026;
    public string $category = 'sales';
    
    public function mount($params = [])
    {
        // Set properties from params
        if (isset($params['title'])) $this->title = $params['title'];
        if (isset($params['period'])) $this->period = $params['period'];
        if (isset($params['year'])) $this->year = $params['year'];
        if (isset($params['category'])) $this->category = $params['category'];
        
        // Check if data was passed directly
        if (isset($params['data'])) {
            $this->chartData = $params['data'];
        }
        
        if (isset($params['options'])) {
            $this->chartOptions = $params['options'];
        }
        
        // Build chart from passed data or use defaults
        if ($this->chartData) {
            $this->labels = $this->chartData['labels'] ?? [];
            $this->datasets = $this->chartData['datasets'] ?? [];
            $this->chartType = $this->chartData['type'] ?? 'line';
        } else {
            $this->buildDefaultChart();
        }
        
        // Use custom options if provided
        if ($this->chartOptions) {
            $this->options = $this->chartOptions;
        }
    }
    
    private function buildDefaultChart()
    {
        $this->labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
        $this->datasets = [
            [
                'label' => 'Default Data',
                'data' => [65, 59, 80, 81, 56, 55],
                'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                'borderColor' => 'rgba(54, 162, 235, 1)',
                'borderWidth' => 2,
                'tension' => 0.3
            ]
        ];
        $this->options = [
            'responsive' => true,
            'maintainAspectRatio' => true,
            'plugins' => [
                'legend' => ['position' => 'top'],
                'title' => ['display' => true, 'text' => $this->title]
            ],
            'scales' => ['y' => ['beginAtZero' => true]]
        ];
    }
    
    public function updateChartData($data)
    {
        if (isset($data['labels'])) {
            $this->labels = $data['labels'];
        }
        if (isset($data['datasets'])) {
            $this->datasets = $data['datasets'];
        }
        if (isset($data['type'])) {
            $this->chartType = $data['type'];
        }
        if (isset($data['options'])) {
            $this->options = $data['options'];
        }
        
        $this->dispatch('refreshChart', chartId: $this->chartId);
    }
    
    public function render()
    {
        return view('livewire.chart-component');
    }
}