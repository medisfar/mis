<?php
namespace App\Traits;

use Livewire\Component;
use \App\Models\Issue;

Trait IssueTrait {
    protected $issues,$unissue;
    public $sid,$state='home',$search;
    public $user_id,$title,$description,$priority,$status,$resolved_at,$resolution_summary,$image_before,$image_after;

    public function resetIssue() {
        $this->user_id = '';
        $this->title = '';
        $this->description = '';
        $this->priority = '';
        $this->status = '';
        $this->resolved_at = '';
        $this->resolution_summary = '';
        $this->image_before = '';
        $this->image_after = '';
    }

    public function cancelIssue() {
        $this->state = 'home';
    }

    public function createIssue() {
        $this->state = 'create';
        $this->sid = null;
        $this->unissue = new Issue;
    }
public function storeIssue() {
    $this->validate([
        'title' => 'required', 
        'description' => 'required', 
        'priority' => 'required', 
        'status' => 'required',
        'image_before' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'image_after' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Store both images properly
    $path_before = '';
    if ($this->image_before) {
        $path_before = $this->image_before->store('files', 'public');
    }
    
    $path_after = '';
    if ($this->image_after) {
        $path_after = $this->image_after->store('files', 'public');
    }
    
    $dt = [
        'user_id' => \Auth::user()->id, 
        'title' => $this->title, 
        'description' => $this->description, 
        'priority' => $this->priority, 
        'status' => $this->status, 
        'resolved_at' => $this->resolved_at, 
        'resolution_summary' => $this->resolution_summary, 
        'image_before' => $path_before,
        'image_after' => $path_after  // ✓ FIXED: Now storing the file path, not the UploadedFile object
    ];
    
    $unissue = new Issue;
    $unissue->create($dt);

    $this->resetIssue();
   $this->dispatch('issueUpdate');
   $this->dispatch('hide-modal');;
}
    public function showIssue($id) {
        $this->state = 'show';
        $this->sid = $id;
        $this->unissue = Issue::find($id);
        $this->user_id = $this->unissue->user_id; 
        $this->title = $this->unissue->title; 
        $this->description = $this->unissue->description; 
        $this->priority = $this->unissue->priority; 
        $this->status = $this->unissue->status; 
        $this->resolved_at = $this->unissue->resolved_at; 
        $this->resolution_summary = $this->unissue->resolution_summary; 
        $this->image_before = $this->unissue->image_before; 
        $this->image_after = $this->unissue->image_after; 
    }

    public function editIssue($id) {
        $this->state = 'edit';
        $this->sid = $id;
        $this->unissue = Issue::find($id);
        if($this->unissue != null) {
            $this->user_id = $this->unissue->user_id; 
            $this->title = $this->unissue->title; 
            $this->description = $this->unissue->description; 
            $this->priority = $this->unissue->priority; 
            $this->status = $this->unissue->status; 
            $this->resolved_at = $this->unissue->resolved_at; 
            $this->resolution_summary = $this->unissue->resolution_summary; 
            $this->image_before = $this->unissue->image_before; 
            $this->image_after = $this->unissue->image_after; 
        }
    }

    public function updateIssue() {
        $this->validate([
            'user_id' => 'required', 
            'title' => 'required', 
            'description' => 'required', 
            'priority' => 'required', 
            'status' => 'required', 
            'resolved_at' => 'required', 
            'resolution_summary' => 'required', 
        ]);

        if ($this->sid) {
            $unissue = Issue::find($this->sid);
            $unissue->update([
                'user_id' => $this->user_id, 
                'title' => $this->title, 
                'description' => $this->description, 
                'priority' => $this->priority, 
                'status' => $this->status, 
                'resolved_at' => $this->resolved_at, 
                'resolution_summary' => $this->resolution_summary, 
                'image_before' => $this->image_before, 
                'image_after' => $this->image_after, 
            ]);
            $this->resetIssue();
           $this->dispatch('issueUpdate');
   $this->dispatch('hide-modal');
        }
    }

    public function destroyIssue($id) {
        if ($id) {
            $unissue = Issue::find($id);
            $unissue->delete();
        }
        return redirect()->route('assistance.issues');
    }
}