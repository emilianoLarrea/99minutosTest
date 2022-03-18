<?php

namespace App\Core\BinaryTree\Model;

class Node {
    /**
     * @var int
     */
    protected $id;
    /**
     * @var ?Node
     */
    protected $leftNode;
    /**
     * @var ?Node
     */
    protected $rightNode;

    public function __construct(int $id, ?Node $leftNode = null, ?Node $rightNode = null)
    {
        $this->id = $id;
        $this->leftNode = $leftNode;
        $this->rightNode = $rightNode;
    }

    public function setLeftNode($node){
       $this->leftNode = $node;
    }

    public function setRightNode($node){
       $this->rightNode = $node;
    }

    public function getLeftNode(): ?Node {
       return $this->leftNode;
    }

    public function getRightNode(): ?Node {
       return $this->rightNode;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }


}
