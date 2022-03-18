<?php

namespace App\Core\BinaryTree\Service;

use App\Core\BinaryTree\Model\BinaryTree;
use App\Core\BinaryTree\Model\Node;

class BreadthFirstSearcher implements IBinaryTreeService
{
    /**
     * @var BinaryTree
     */
    protected $bTree;

    /**
     * @var array
     */
    protected $queue = [];
    /**
     * @var array
     */
    protected $path = [];

    public function fromBTree(BinaryTree $bTree): self
    {
        $this->bTree = $bTree;
        return $this;
    }

    public function execute(array $data)
    {
        $this->bfs($this->bTree->getRoot());
        return $this->path;
    }

    public function bfs(Node $rootNode)
    {
        array_push($this->path, $rootNode->getId());
        if(!empty($rootNode->getLeftNode())) {
            array_push($this->queue, $rootNode->getLeftNode());
        }
        if(!empty($rootNode->getRightNode())) {
            array_push($this->queue, $rootNode->getRightNode());
        }
        if(!empty($this->queue)){
            $nextNode = array_shift($this->queue);
            $this->bfs($nextNode);
        }
    }
}
