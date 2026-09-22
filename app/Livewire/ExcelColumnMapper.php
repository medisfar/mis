<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Schema;
use Livewire\Component;
use Livewire\WithFileUploads;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelColumnMapper extends Component
{
    use WithFileUploads;

    public $file;
    public array $tables = [];
    public string $table = '';
    public array $dbColumns = [];
    public array $excelColumns = [];
    public array $sample = [];
    public array $mapping = [];
    public bool $saved = false;

    protected $rules = [
        'file' => 'required|file|mimes:xlsx,xls,csv,txt|max:20480',
        'table' => 'required|string',
    ];

    public function mount(): void
    {
        $this->tables = collect(Schema::getTables())
            ->map(fn ($table) => is_array($table) ? ($table['name'] ?? '') : $table)
            ->filter(fn ($table) => $table && ! in_array($table, ['migrations', 'password_reset_tokens', 'sessions', 'cache', 'cache_locks', 'jobs', 'job_batches', 'failed_jobs']))
            ->sort()->values()->all();
    }

    public function updatedTable(): void
    {
        $this->dbColumns = $this->table ? Schema::getColumnListing($this->table) : [];
        $this->mapping = collect($this->mapping)->map(fn ($target) => in_array($target, $this->dbColumns, true) ? $target : '')->all();
        $this->saved = false;
    }

    public function inspectFile(): void
    {
        $this->validateOnly('file');
        $reader = IOFactory::createReaderForFile($this->file->getRealPath());
        $reader->setReadDataOnly(true);
        $sheet = $reader->load($this->file->getRealPath())->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true);
        $header = array_values(array_map(fn ($value) => trim((string) $value), array_shift($rows) ?: []));
        $header = array_values(array_filter($header, fn ($value) => $value !== ''));
        $this->excelColumns = $header;
        $this->sample = collect($rows)->take(5)->map(function ($row) use ($header) {
            $values = array_values($row);
            return collect($header)->mapWithKeys(fn ($name, $index) => [$name => $values[$index] ?? ''])->all();
        })->all();
        $this->mapping = collect($header)->mapWithKeys(fn ($column) => [$column => $this->guessColumn($column)])->all();
        $this->saved = false;
    }

    private function guessColumn(string $column): string
    {
        $normal = strtolower(preg_replace('/[^a-z0-9]/i', '', $column));
        return collect($this->dbColumns)->first(fn ($db) => strtolower(preg_replace('/[^a-z0-9]/i', '', $db)) === $normal) ?? '';
    }

    public function saveMapping(): void
    {
        $this->validate(['table' => 'required|string', 'mapping' => 'array']);
        session()->put('excel_column_mapping', ['table' => $this->table, 'mapping' => $this->mapping]);
        $this->saved = true;
    }

    public function render()
    {
        return view('livewire.excel-column-mapper');
    }
}
