<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class PivotTable extends Component
{
    public $pivotData = [];
    public $url = null;
    public $queryTitle = '';
    public $queryDescription = '';
    public $recordCount = 0;
    public $isLoading = false;
    public $errorMessage = '';

    public function mount($url = null)
    {
        if ($url) {
            $this->url = $url;
            $this->loadData();
        }
    }

    public function loadData()
    {
        if (empty($this->url)) {
            $this->errorMessage = 'No URL provided';
            return;
        }

        $this->isLoading = true;
        $this->errorMessage = '';

        try {
            $response = Http::timeout(30)->get($this->url);
            
            if (!$response->successful()) {
                $this->errorMessage = 'Failed to fetch data: HTTP ' . $response->status();
                $this->pivotData = [];
                $this->recordCount = 0;
                $this->isLoading = false;
                return;
            }

            $result = $response->json();
            
            if (isset($result['data']) && is_array($result['data'])) {
                $this->pivotData = $result['data'];
                $this->recordCount = $result['total'] ?? count($this->pivotData);
                $this->queryTitle = $result['title'] ?? 'Data';
                $this->queryDescription = $result['description'] ?? '';
            } else {
                $this->pivotData = $result;
                $this->recordCount = count($this->pivotData);
                $this->queryTitle = 'Data';
                $this->queryDescription = '';
            }

            $this->dispatch('analyticsLoaded', [
                'data' => $this->pivotData,
                'title' => $this->queryTitle,
                'description' => $this->queryDescription,
                'recordCount' => $this->recordCount,
                'url' => $this->url
            ]);

        } catch (\Exception $e) {
            $this->errorMessage = 'Error loading data: ' . $e->getMessage();
            $this->pivotData = [];
            $this->recordCount = 0;
        }

        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.pivot-table');
    }
}