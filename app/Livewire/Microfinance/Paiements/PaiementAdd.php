<?php
namespace App\Livewire\Microfinance\Paiements;
use Livewire\Component;
use \App\Models\Paiement;
class PaiementAdd extends Component
{
    public $credit_id;
    public $echeance_id;
    public $date_paiement;
    public $montant_paye;
    public $montant_restant;

    public function mount($credit_id = null, $echeance_id = null): void
    {
        $this->credit_id = $credit_id;
        $this->echeance_id = $echeance_id;
        $this->date_paiement = now()->toDateString();

        $echeance = \App\Models\Echeance::find($echeance_id);
        if ($echeance) {
            $alreadyPaid = Paiement::where("echeance_id", $echeance->id)->sum("montant_paye");
            $this->montant_restant = max(0, $echeance->montant_paye - $alreadyPaid);
            $this->montant_paye = $this->montant_restant;
        }
    }

    public function storePaiement()
    {
        $data = $this->validate([
            "credit_id" => "required|exists:credits,id",
            "echeance_id" => "required|exists:echeances,id|unique:paiements,echeance_id",
            "date_paiement" => "required|date",
            "montant_paye" => "required|numeric|min:1",
        ]);

        $echeance = \App\Models\Echeance::where("credit_id", $this->credit_id)->findOrFail($this->echeance_id);
        $alreadyPaid = Paiement::where("echeance_id", $echeance->id)->sum("montant_paye");
        $remainingBeforePayment = max(0, $echeance->montant_paye - $alreadyPaid);

        $this->validate([
            "montant_paye" => "max:".$remainingBeforePayment,
        ]);

        $data["montant_restant"] = max(0, $remainingBeforePayment - $this->montant_paye);
        Paiement::create($data);

        return redirect()->route("microfinance.credits.show", $this->credit_id);
    }

    public function render()
    {
        return view("livewire.microfinance.paiements.paiement-add");
    }
}
