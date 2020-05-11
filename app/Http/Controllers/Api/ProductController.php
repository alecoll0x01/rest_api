<?php

namespace App\Http\Controllers\Api;

use App\API\ApiError;
use App\Http\Controllers\Controller;
use App\Product;
use http\Env\Response;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        return response()->json($this->product->paginate(10));
    }

    public function show($id)
    {
        $product = $this->product->find($id);

        if(! $product) return \response()->json(['data' => ['msg' => 'Produto não encontrado']], 404);

        $data = ['data' => $product];
        return response()->json($data);
    }

    public function store(Request $request)
    {
        try {

            $productData = $request->all();
            $this->product->create($productData);

            $returnMsg = ['data' => ['msg' => 'Produto Criado com sucesso :)']];
            return response()->json($returnMsg, 201);

        } catch (\Exception $e) {

            if (config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1010));
            }
            return response()->json(ApiError::errorMessage('Houve um erro ao realizar a opreação', 1010));
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            $product = $this->product->find($id);
            $product->update($data);

            $returnMsg = ['data' => ['msg' => 'Produto Atualizado com sucesso :)']];

            return response()->json($returnMsg, 201);

        } catch (\Exception $e) {

            if (config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1011));
            }
            return response()->json(ApiError::errorMessage('Houve um erro ao realizar a opreação', 1011));
        }
    }

    public function delete(Product $id)
    {
        try {

            $id->delete();
            return response()->json(['data' => 'Produto: ' . $id->name . ' Removido com sucesso XD'], 200);

        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1012));
            }
            return response()->json(ApiError::errorMessage('Houve um erro ao realizar a opreação', 1012));
        }
    }
}
