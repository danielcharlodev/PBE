<?php

namespace App\Http\Controllers;

use App\Models\Produtos;

class ProdutosController extends Controller
{
    public function index()
    {
        $produtos = Produtos::orderByDesc('id')->get();

        return view('produtos.index', compact('produtos'));
    }
}