<?php

namespace App\Livewire;

use App\Models\Xlconfig as XlconfigModel;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;
use Livewire\WithFileUploads;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Xlconfig extends Component
{
    use WithFileUploads;

    public $excelFile;
    public $configs;
    public ?int $editing = null;
    public $selectedConfigId = '';
    public string $name = '';
    public array $lines = [];
    public array $tables = [];
    public array $excelHeaders = [];

    protected $rules = [
        'excelFile' => 'required|file|mimes:xlsx,xls,csv,txt|max:20480',
    ];

    public function mount(): void
    {
        $this->refreshConfigs();
        $this->tables = collect(Schema::getTables())
            ->map(fn ($table) => is_array($table) ? ($table['name'] ?? '') : $table)
            ->filter(fn ($table) => $table && $table !== 'migrations')
            ->sort()->values()->all();
    }

    public function refreshConfigs(): void
    {
        $this->configs = XlconfigModel::with('lines')->orderBy('name')->get();
    }

    public function create(): void
    {
        $this->resetEditor();
        $this->selectedConfigId = '';
        $this->lines = [['line' => '', 'table' => '', 'field' => '']];
    }

    public function chooseConfig(): void
    {
        if (! $this->selectedConfigId) {
            $this->create();
            return;
        }
        $this->edit((int) $this->selectedConfigId);
    }

    public function edit(int $id): void
    {
        $config = XlconfigModel::with('lines')->findOrFail($id);
        $this->editing = $config->id;
        $this->selectedConfigId = $config->id;
        $this->name = $config->name;
        $this->lines = $config->lines->map(fn ($line) => ['id' => $line->id, 'line' => $line->line, 'table' => $line->table, 'field' => $line->field])->toArray();
        $this->excelHeaders = $config->headers ?: collect($this->lines)
            ->filter(fn ($line) => trim((string) ($line['line'] ?? '')) !== '')
            ->values()
            ->map(fn ($line, $index) => ['number' => $index + 1, 'name' => $line['line']])
            ->all();
    }

    public function addLine(): void { $this->lines[] = ['line' => '', 'table' => '', 'field' => '']; }
    public function removeLine(int $index): void { unset($this->lines[$index]); $this->lines = array_values($this->lines); }
    public function fieldsForTable(string $table): array { return $table ? Schema::getColumnListing($table) : []; }

    public function importExcelConfig(): void
    {
        $this->validateOnly('excelFile');
        $extension = strtolower($this->excelFile->getClientOriginalExtension());
        if (in_array($extension, ['csv', 'txt'], true)) {
            $rows = [];
            $handle = fopen($this->excelFile->getRealPath(), 'r');
            $firstLine = fgets($handle);
            $delimiter = substr_count($firstLine, ';') > substr_count($firstLine, ',') ? ';' : ',';
            rewind($handle);
            while (($row = fgetcsv($handle, 0, $delimiter)) !== false) $rows[] = $row;
            fclose($handle);
        } else {
            $reader = IOFactory::createReaderForFile($this->excelFile->getRealPath());
            $reader->setReadDataOnly(true);
            $rows = $reader->load($this->excelFile->getRealPath())->getActiveSheet()->toArray(null, true, true, false);
        }

        if (count($rows) < 1) {
            $this->addError('excelFile', 'The file does not contain a header row.');
            return;
        }

        $hasConfigRows = count($rows) >= 3 && $this->looksLikeConfigRows($rows[0], $rows[1]);
        $tables = $hasConfigRows ? array_values($rows[0]) : [];
        $fields = $hasConfigRows ? array_values($rows[1]) : [];
        $headers = array_values($rows[$hasConfigRows ? 2 : 0]);
        if (trim($this->name) === '') {
            $this->name = pathinfo($this->excelFile->getClientOriginalName(), PATHINFO_FILENAME);
        }
        $this->excelHeaders = [];

        foreach ($headers as $index => $header) {
            $header = trim((string) $header);
            if ($header === '') continue;
            $this->excelHeaders[] = ['number' => $index + 1, 'name' => $header];
        }

        if (! $this->editing) {
            $this->lines = [[
                'line' => '',
                'table' => $hasConfigRows ? trim((string) ($tables[0] ?? '')) : '',
                'field' => $hasConfigRows ? trim((string) ($fields[0] ?? '')) : '',
            ]];
        } elseif (empty($this->lines) || collect($this->lines)->last(fn ($line) => empty($line['id'])) === null) {
            $this->lines[] = ['line' => '', 'table' => '', 'field' => ''];
        }

        if (count($this->excelHeaders) === 0) {
            $this->addError('excelFile', 'No headers were found.');
            return;
        }

        // Reading the file is itself a save operation for the header list.
        // This allows the headers to be selected even before any mapping line is saved.
        $config = $this->editing
            ? XlconfigModel::findOrFail($this->editing)
            : (XlconfigModel::where('name', $this->name)->first() ?? new XlconfigModel());
        $config->name = $this->name;
        $config->headers = $this->excelHeaders;
        $config->save();
        $this->editing = $config->id;
        $this->selectedConfigId = $config->id;
        $this->refreshConfigs();
    }

    private function looksLikeConfigRows(array $tables, array $fields): bool
    {
        $matches = 0;
        foreach ($tables as $index => $table) {
            $table = trim((string) $table);
            $field = trim((string) ($fields[$index] ?? ''));
            if ($table !== '' && $field !== '' && in_array($table, $this->tables, true) && in_array($field, $this->fieldsForTable($table), true)) {
                $matches++;
            }
        }
        return $matches > 0;
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'lines' => 'required|array|min:1',
            'lines.*.line' => 'required|string|max:255',
            'lines.*.table' => 'required|string|max:255',
            'lines.*.field' => 'required|string|max:255',
        ]);
        $config = $this->editing
            ? XlconfigModel::findOrFail($this->editing)
            : (XlconfigModel::where('name', $this->name)->first() ?? new XlconfigModel());
        $config->name = $this->name;
        $config->headers = $this->excelHeaders;
        $config->save();
        $config->lines()->delete();
        foreach ($this->lines as $line) $config->lines()->create($line);
        $this->resetEditor();
        $this->refreshConfigs();
        session()->flash('status', 'Configuration saved.');
    }

    public function saveLine(int $index): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            "lines.$index.line" => 'required|string|max:255',
            "lines.$index.table" => 'required|string|max:255',
            "lines.$index.field" => 'required|string|max:255',
        ]);

        $config = $this->editing
            ? XlconfigModel::findOrFail($this->editing)
            : (XlconfigModel::where('name', $this->name)->first() ?? new XlconfigModel());
        if (! $config->exists) {
            $config->name = $this->name;
            $config->headers = $this->excelHeaders;
            $config->save();
        }
        $this->editing = $config->id;
        $config->headers = $this->excelHeaders;
        $config->save();

        $line = $this->lines[$index];
        if (! empty($line['id'])) {
            $config->lines()->whereKey($line['id'])->update([
                'line' => $line['line'], 'table' => $line['table'], 'field' => $line['field'],
            ]);
        } else {
            $saved = $config->lines()->create([
                'line' => $line['line'], 'table' => $line['table'], 'field' => $line['field'],
            ]);
            $this->lines[$index]['id'] = $saved->id;
        }

        if ($index === count($this->lines) - 1) {
            $this->lines[] = ['line' => '', 'table' => '', 'field' => ''];
        }

        $this->refreshConfigs();
        session()->flash('status', 'Line saved.');
    }

    public function delete(int $id): void { XlconfigModel::findOrFail($id)->delete(); $this->refreshConfigs(); }
    private function resetEditor(): void { $this->editing = null; $this->name = ''; $this->lines = []; }
    public function render() { return view('livewire.xlconfig'); }
}
