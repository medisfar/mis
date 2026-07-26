<?php
// app/Livewire/MasterDetailTree.php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Item;

class MasterDetailTree extends Component
{
    public $tree = [];
    public $filteredTree=[];
    public $selectedNode = null;
    public $nodeFields = [];
    public $res,$activeTab = 'overview';
    public $pid;
    
    public function mount($id)
    {
        
        $this->pid=$id;
        //$this->loadTree();
        //$this->nodeFields = $this->getFieldConfigurations();
    }
    public function loadTree(){
      $this->tree=json_decode(file_get_contents(public_path().'/data.json'));
//dd($this->tree);
   }
    
    private function getFieldConfigurations()
    {
        return [
            'primary' => ['name', 'code', 'type', 'status'],
            'financial' => ['price', 'quantity', 'unit_cost', 'total_value', 'discount', 'tax_rate'],
            'inventory' => ['stock_level', 'reorder_point', 'warehouse_location', 'batch_number'],
            'categorical' => ['category', 'subcategory', 'department', 'project_code'],
            'dates' => ['created_at', 'updated_at', 'purchase_date', 'expiry_date'],
            'metadata' => ['tags', 'notes', 'specifications', 'attachments_count'],
        ];
    }
    
    public function selectNode($nodeId)
    {
        $this->selectedNode = Item::with([
            'parent', 
            'children', 
            'attachments',
            'relatedItems'
        ])->find($nodeId);
        
        $this->activeTab = 'overview';
        $this->dispatch('nodeSelected', $nodeId);
    }
    
    public function render()
    {
        return view('livewire.master-detail-tree');
    }
    public function display($tree){
        echo "<ul>";
        foreach($tree as $node)
        echo "<li>$node->description<li>";
         if(count($node->children)>0){
             echo "<li>";
            $this->display($node->children);
             echo "<li>";
         }
        echo '</ul>';
    }
    public function somme(int $a){
        $this->res= $a*2;
    }
}