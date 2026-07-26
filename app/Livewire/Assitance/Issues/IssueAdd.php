<?php
namespace App\Livewire\Assitance\Issues;
use Livewire\Component;
use \App\Traits\IssueTrait;
use \App\Models\Issue;
class IssueAdd extends Component {
use IssueTrait;
protected $listeners = ['unissueUpdate' => 'refresh'];
public function refresh(){
    $this->issues = \App\Models\Issue::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Issue::query();
	$this->issues=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unissue=\App\Models\Issue::find($this->sid);
	$this->createIssue($this->sid);	return view('livewire.assitance.issues.issue-add',
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