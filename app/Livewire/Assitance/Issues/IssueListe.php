<?php
namespace App\Livewire\Assitance\Issues;
use Livewire\Component;
use \App\Traits\IssueTrait;
use \App\Models\Issue;
use Livewire\WithPagination;
class IssueListe extends Component {
use IssueTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['unissueUpdate' => 'refresh'];
public function refresh(){
    $this->issues = \App\Models\Issue::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Issue::query();
	if($this->search!==null) 
	$qr=\App\Models\Issue::where('user_id',$this->search);
	$this->issues=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unissue=\App\Models\Issue::find($this->sid);
	return view('livewire.assitance.issues.issue-liste',
	   ['issues'=>$this->issues,'issue'=>$this->unissue]);
}

public function resetIssue() {
	 $this->user_id  = '';
	 $this->title  = '';
	 $this->description  = '';
	 $this->priority  = '';
	 $this->status  = '';
	 $this->resolved_at  = '';
	 $this->resolution_summary  = '';
}
}