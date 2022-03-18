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

use \Illuminate\Http\Request;

$router->post('/v1/b-trees/height', function (Request $request) use ($router) {
    $service = new App\Core\BinaryTree\Service\BinaryTreeConstructor();

    $data = $request->get('toTree');
    $bTree = $service->execute($data);
    $bTree->calculateHeight();

    return response()->json(['height' => $bTree->getHeight()]);
});
