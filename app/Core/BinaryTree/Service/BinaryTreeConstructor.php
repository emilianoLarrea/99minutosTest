<?php

namespace App\Core\BinaryTree\Service;

use App\Core\BinaryTree\Model\BinaryTree;
use App\Core\BinaryTree\Service\Exception\InvalidArgumentException;

class BinaryTreeConstructor implements IBinaryTreeService
{
    /**
     * @var array
     */
    protected $bTreeIdsArray;

    public function execute(array $data): BinaryTree {
        $this->argumentValidations($data);
        $bTree = new BinaryTree();
        foreach ($this->getBTreeIdsArray() as $id) {
            $bTree->addNodeById($id);
        }
        return $bTree;
    }

    private function argumentValidations(array $data): void {
        if (empty($data['toTree'])) {
            InvalidArgumentException::throw('toTree');
        }
        $this->setBTreeIdsArray($data['toTree']);
    }

    public function getBTreeIdsArray(): array
    {
        return $this->bTreeIdsArray;
    }

    public function setBTreeIdsArray(array $bTreeIdsArray): self
    {
        $this->bTreeIdsArray = $bTreeIdsArray;
        return $this;
    }

}
