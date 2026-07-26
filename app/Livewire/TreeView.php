<?php

namespace App\Livewire;

use Livewire\Component;

class TreeView extends Component
{
    // Hardcoded hierarchical data
    public array $nodes = [
        [
            'id' => 1,
            'name' => 'Electronics',
            'children' => [
                [
                    'id' => 2,
                    'name' => 'Phones',
                    'children' => [
                        ['id' => 3, 'name' => 'Smartphones', 'children' => []],
                        ['id' => 4, 'name' => 'Accessories', 'children' => []],
                    ],
                ],
                [
                    'id' => 5,
                    'name' => 'Laptops',
                    'children' => [
                        ['id' => 6, 'name' => 'Gaming', 'children' => []],
                    ],
                ],
            ],
        ],
        [
            'id' => 7,
            'name' => 'Books',
            'children' => [
                ['id' => 8, 'name' => 'Fiction', 'children' => []],
                ['id' => 9, 'name' => 'Non-fiction', 'children' => []],
            ],
        ],
    ];

    public $selectedNodeId = null;
    public $selectedNode = null;

    /**
     * Find a node by ID recursively and return it.
     */
    private function findNode($nodes, $id)
    {
        foreach ($nodes as $node) {
            if ($node['id'] == $id) {
                return $node;
            }
            if (!empty($node['children'])) {
                $found = $this->findNode($node['children'], $id);
                if ($found) {
                    return $found;
                }
            }
        }
        return null;
    }

    public function selectNode($nodeId)
    {
        $this->selectedNodeId = $nodeId;
        $this->selectedNode = $this->findNode($this->nodes, $nodeId);
    }

    public function render()
    {
        return view('livewire.tree-view');
    }
}