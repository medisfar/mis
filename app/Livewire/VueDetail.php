<?php

namespace App\Livewire;

use App\Models\Composante;
use App\Uts;
use Livewire\Component;

class VueDetail extends Component
{
    public Composante $composante;
    
    /**
     * Mount method - appelé automatiquement par Livewire avec les paramètres
     *
     * @param Composante $composante
     * @return void
     */
    public function mount(Composante $composante)
    {
        $this->composante = $composante;
    }
    
    /**
     * Calculate percentage with safe division
     *
     * @param float $dividend
     * @param float $divisor
     * @param int $precision
     * @return float
     */
    public function calculatePercentage($dividend, $divisor, $precision = 2)
    {
        if ($divisor <= 0) {
            return 0;
        }
        
        return round(($dividend / $divisor) * 100, $precision);
    }
    
    /**
     * Get formatted percentage for display
     *
     * @param float $dividend
     * @param float $divisor
     * @return string
     */
    public function getFormattedPercentage($dividend, $divisor)
    {
        return Uts::nbf($this->calculatePercentage($dividend, $divisor), 2) . '%';
    }
    
    /**
     * Render the component
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.vue-detail');
    }
}