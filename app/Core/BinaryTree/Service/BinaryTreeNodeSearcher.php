<?php

namespace App\Core\BinaryTree\Service;

use App\Core\BinaryTree\Model\BinaryTree;
use App\Core\BinaryTree\Model\Node;
use App\Core\BinaryTree\Service\Exception\InvalidArgumentException;

class BinaryTreeNodeSearcher implements IBinaryTreeService
{
    /**
     * @var BinaryTree
     */
    protected $bTree;

    /**
     * @var int
     */
    protected $id;

    public function fromBTree(BinaryTree $bTree): self
    {
        $this->bTree = $bTree;
        return $this;
    }

    public function execute(array $data): ?Node
    {
        $this->argumentValidations($data);
        if ($this->bTree->isEmptyRoot()) {
            return null;
        }
        $rootNode = $this->bTree->getRoot();
        if ($this->isIdInNode($rootNode)) {
            return $rootNode;
        }

        return $this->searchInLeaves($rootNode);
    }

    private function isIdInNode(Node $node): bool {
        return $node->getId() == $this->getId();
    }

    private function argumentValidations(array $data): void {
        if (empty($data['node'])) {
            InvalidArgumentException::throw('node');
        }
        $this->setId($data['node']);
    }

    public function getBTree(): BinaryTree
    {
        return $this->bTree;
    }

    public function setBTree(BinaryTree $bTree): self
    {
        $this->bTree = $bTree;
        return $this;
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

    private function searchInLeaves(Node $current) {
        $exists = false;
        while($exists === false) {
            if ($this->getId() < $current->getId()) {
                if ($current->getLeftNode() === null) {
                    break;
                } elseif($this->isIdInNode($current->getLeftNode())) {
                    $exists = $current->getLeftNode();
                    break;
                }
                else {
                    $current = $current->getLeftNode();
                    return $this->searchInLeaves($current);
                }
            }
            elseif ($this->getId() > $current->getId()) {
                if ($current->getRightNode() === null) {
                    break;
                }
                elseif($this->isIdInNode($current->getRightNode())) {
                    $exists = $current->getRightNode();
                    break;
                } else {
                    $current = $current->getRightNode();
                    return $this->searchInLeaves($current);
                }
            }
        }
        return $exists;
    }
}
