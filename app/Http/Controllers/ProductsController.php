<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function list(Request $request)
    {
        $paginate = $request->has('limit') ? $request->limit : 50;

        $query = Product::query();

        if ($request->has('description')) {
            $query->where('description', 'like', "%{$request->description}%");
        }

        $product = $query->orderBy('description', 'asc')->paginate($paginate);

        // Removendo campos do JSON de retorno
        // $servicoEmissor->getCollection()->transform(function ($servicoEmissor) {
        //     unset($servicoEmissor->deleted_at);
        //     return $servicoEmissor;
        // });
        

        return response()->json(['product' => $product]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:20',
            'description' => 'required',
            'status' => 'boolean',
            'price' => 'numeric',
            'color' => 'nullable|string|max:255',
        ]);

        $product = Product::create($request->all());

        $response = [
            'success' => 'Product saved successfully.',
            'data' => $product,
        ];

        return response()->json($response);
    }
}
