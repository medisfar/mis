<?phpnamespace App\Livewire;

use Livewire\Component;
use App\Models\Activite;

class Gantt extends Component
{
    public $sid;

    public function mount($id)
    {
        $this->sid = $id;
    }

    public function render()
    {
        $activities = Activite::where('composante_id', $this->sid)->get();
        
        $gdata = $activities->map(function ($a) {
            return [
                (string)$a->id,                // Task ID
                $a->activite,                  // Task Name
                null,                          // Resource (Optional)
                $a->date_debut,                // Start Date (Y-m-d)
                $a->date_fin,                  // End Date (Y-m-d)
                null,                          // Duration (null if using dates)
                (int)$a->completed,            // Percent Done
                null                           // Dependencies (Task ID)
            ];
        });

        return view('livewire.gantt', ['gcdata' => $gdata]);
    }
}