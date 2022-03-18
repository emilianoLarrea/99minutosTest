<?php

namespace App\Core\BinaryTree\Service;

use App\Core\BinaryTree\Model\BinaryTree;

class BinaryTreeConstructor
{
    public function execute(array $data): BinaryTree {
        $bTree = new BinaryTree();
        foreach ($data as $id) {
            $bTree->addNodeById($id);
        }
        return $bTree;
    }
}
