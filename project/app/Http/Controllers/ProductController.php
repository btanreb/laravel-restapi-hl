<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Interfaces\ProductInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    use ApiResponse;

    private $productRepository;

    /**
     * Create a new constructor for this controller
     */
    public function __construct(ProductInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->response(
            'All products',
            $this->productRepository->getAll()->toArray()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return Illuminate\Http\JsonResponse
     */
    public function store(StoreProductRequest $request)
    {
        return $this->response(
            'New product created',
            $this->productRepository->store($request->all())->toArray(),
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return $this->response(
            'Product details',
            $this->productRepository->getById($id)->toArray()
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->response(
            'Product updated',
            $this->productRepository->update($id, $request->all())->toArray()
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return $this->response(
            'Product deleted',
            $this->productRepository->delete($id)->toArray()
        );
    }
}
