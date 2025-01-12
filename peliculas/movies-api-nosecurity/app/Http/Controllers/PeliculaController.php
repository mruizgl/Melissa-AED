<?php

namespace App\Http\Controllers;

use App\Http\Resources\PeliculaResource;
use App\Models\Pelicula;
use Illuminate\Http\Request;

class PeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PeliculaResource::collection(Pelicula::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $movie = new Pelicula();
        $movie->titulo = $request->titulo;
        $movie->year = $request->year;
        $movie->descripcion = $request->descripcion;
        $movie->trailer = $request->trailer;
        $movie->caratula = $request->caratula;

       
        $movie->save();

        if ($request->has('categorias')) {

            $movie->categoriasPeliculas()->attach($request->categorias);
        }

        if ($request->has('actores')) {
            $movie->actoresPeliculas()->attach($request->actores);
        }

        if ($request->has('directores')) {
            $movie->directoresPeliculas()->attach($request->directores);
        }

    
        return response()->json('saved', 201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new PeliculaResource($movie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $movie->update($request->only('titulo', 'year', 'descripcion', 'trailer', 'caratula', 'categorias', 'actores', 'directores'));

        if ($request->has('categorias')) {
            $movie->categoriasPeliculas()->sync($request->categorias);
        }
        if ($request->has('actores')) {
            $movie->actoresPeliculas()->sync($request->actores);
        }
        if ($request->has('directores')) {
            $movie->directoresPeliculas()->sync($request->directores);
        }

        return new PeliculaResource($movie);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie->categoriasPeliculas()->detach();
        $movie->actoresPeliculas()->detach();
        $movie->directoresPeliculas()->detach();

        $movie->delete();
        return response()->json(null, 204);
    }
}
