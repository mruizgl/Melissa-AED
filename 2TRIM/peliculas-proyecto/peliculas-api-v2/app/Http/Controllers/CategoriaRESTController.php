<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriaDTO;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaRESTController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Categoria::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        //
    }
}
