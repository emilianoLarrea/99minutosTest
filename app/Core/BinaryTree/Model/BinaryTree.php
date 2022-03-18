<?php

namespace App\Core\BinaryTree\Model;

class BinaryTree
{
    /**
     * @var ?Node
     */
    protected $root = null;
    /**
     * @var int
     */
    protected $height = 0;

    protected function isEmptyRoot(): bool {
        return empty($this->root);
    }

    protected function insert(Node $node, Node $current): ?Node
    {
        $id = $node->getId();
        $added = null;

        while (empty($added)) {
            if ($node->getId() < $current->getId()) {
                if(empty($current->getLeftNode())) {
                    $current->setLeftNode($node);
                    $current->setRightNode($current->getRightNode());
                    $added = $node;
                    break;
                } else {
                    return $this->insert($node, $current->getLeftNode());
                }
            } else {
                if(empty($current->getRightNode())) {
                    $current->setLeftNode($current->getLeftNode());
                    $current->setRightNode($node);
                    $added = $node;
                    break;
                } else {
                    return $this->insert($node, $current->getRightNode());
                }
            }
        }
        return $added;
    }

    public function addNodeById($id) {
        $node = new Node($id);
        if ($this->isEmptyRoot()) {
            $this->root = $node;
            return true;
        } else {
            return $this->insert($node, $this->root);
        }
    }

    public function getRoot(): ?Node
    {
        return $this->root;
    }

    public function calculateHeight(): void
    {
        if ($this->isEmptyRoot()) {
            $this->height = 0;
        } elseif ($this->getRoot()->getLeftNode() == null && $this->getRoot()->getRightNode() == null) {
            $this->height = 1;
        } else {
            $height = 1;
            $this->height = max($this->_calculateHeight($this->getRoot()->getLeftNode(), $height), $this->_calculateHeight($this->getRoot()->getRightNode(), $height));
        }
    }

    protected function _calculateHeight(?Node $node, int $height): int {
        if (empty($node)) {
            return $height;
        } else {
            $height++;
        }
        $leftNode = $node->getLeftNode();
        $rightNode = $node->getRightNode();
        if (empty($leftNode) && empty($rightNode)) {
            return $height;
        }
        return max($this->_calculateHeight($leftNode, $height), $this->_calculateHeight($rightNode, $height));
    }

    public function getHeight(): int
    {
        return $this->height;
    }
}


