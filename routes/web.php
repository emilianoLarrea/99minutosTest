<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use App\Core\BinaryTree\Service\BreadthFirstSearcher;
use \Illuminate\Http\Request;
use App\Core\BinaryTree\Service\BinaryTreeConstructor;
use App\Core\BinaryTree\Service\BinaryTreeNodeSearcher;

$router->post('/v1/b-trees/height', function (Request $request) use ($router) {
    $service = new BinaryTreeConstructor();
    $body = $request->toArray();
    $bTree = $service->execute($body);
    $bTree->calculateHeight();
    return response()->json(['height' => $bTree->getHeight()]);
});

$router->post('/v1/b-trees/neighbors', function (Request $request) use ($router) {
    $body = $request->toArray();
    $bTreeConstructor = new BinaryTreeConstructor();
    $bTree = $bTreeConstructor->execute($body);

    $bTreeSearcher = new BinaryTreeNodeSearcher();
    $result = $bTreeSearcher
        ->fromBTree($bTree)
        ->execute($body);
    $leftNode = $result->getLeftNode();
    $rightNode = $result->getRightNode();

    $leftNodeResponse = !empty($leftNode) ? $leftNode->getId() : null;
    $rightNodeResponse = !empty($rightNode) ? $rightNode->getId() : null;

    return response()->json(['neighbors' => ['left' => $leftNodeResponse, 'right' => $rightNodeResponse]]);
});

$router->post('/v1/b-trees/bfs', function (Request $request) use ($router) {
    $body = $request->toArray();
    $bTreeConstructor = new BinaryTreeConstructor();
    $bTree = $bTreeConstructor->execute($body);

    $bTreeBTS = new BreadthFirstSearcher();
    $result = $bTreeBTS
        ->fromBTree($bTree)
        ->execute($body);
    return response()->json(['bfs' => $result]);
});
