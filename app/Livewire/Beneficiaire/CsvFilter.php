<?php

namespace App\Livewire\Beneficiaire;

use Livewire\Component;

class CsvFilter extends Component
{
    public string $site = '';
    public string $foyer = '';
    public string $mereConseillere = '';
    public array $sites = [];
    public array $foyers = [];
    public array $mereConseilleres = [];
    public array $headers = [];
    public array $rows = [];

    public function mount(): void
    {
        $this->loadCsv();
    }

    public function updatedSite(): void
    {
        $this->foyer = '';
        $this->mereConseillere = '';
        $this->loadCsv();
    }

    public function updatedFoyer(): void
    {
        $this->mereConseillere = '';
        $this->loadCsv();
    }

    public function updatedMereConseillere(): void
    {
        $this->loadCsv();
    }

    private function loadCsv(): void
    {
        $path = public_path('MCMNBaseUnifiee.csv');
        $this->sites = [];
        $this->foyers = [];
        $this->mereConseilleres = [];
        $this->headers = [];
        $this->rows = [];

        if (!is_readable($path) || ($handle = fopen($path, 'r')) === false) {
            return;
        }

        $this->headers = array_map('trim', fgetcsv($handle, 0, ';') ?: []);
        $siteIndex = array_search('Site', $this->headers, true);
        $foyerIndex = array_search('Foyer', $this->headers, true);
        $mereConseillereIndex = array_search('Mere conseillere', $this->headers, true);
        $lineNumber = 1;

        while (($data = fgetcsv($handle, 0, ';')) !== false) {
            $lineNumber++;
            if (count($data) === 1 && trim((string) $data[0]) === '') {
                continue;
            }

            $data = array_pad($data, count($this->headers), '');
            $rowSite = trim((string) ($data[$siteIndex] ?? ''));
            $rowFoyer = trim((string) ($data[$foyerIndex] ?? ''));
            $rowCounselor = trim((string) ($data[$mereConseillereIndex] ?? ''));
            $rowMereConseillere = strtolower(preg_replace('/\s+/', '-', $rowFoyer . '-' . $rowCounselor));
            if ($rowSite !== '') {
                $this->sites[$rowSite] = $rowSite;
            }
            if ($rowFoyer !== '' && ($this->site === '' || $rowSite === $this->site)) {
                $this->foyers[$rowFoyer] = $rowFoyer;
            }
            if ($rowFoyer !== '' && $rowCounselor !== '' && ($this->site === '' || $rowSite === $this->site)
                && ($this->foyer === '' || $rowFoyer === $this->foyer)) {
                $this->mereConseilleres[$rowMereConseillere] = $rowMereConseillere;
            }

            if (($this->site === '' || $rowSite === $this->site)
                && ($this->foyer === '' || $rowFoyer === $this->foyer)
                && ($this->mereConseillere === '' || $rowMereConseillere === $this->mereConseillere)) {
                $this->rows[] = ['line' => $lineNumber, 'values' => array_map('trim', $data)];
            }
        }

        fclose($handle);
        natcasesort($this->sites);
        natcasesort($this->foyers);
        natcasesort($this->mereConseilleres);
    }

    public function render()
    {
        return view('livewire.beneficiaire.csv-filter');
    }
}
