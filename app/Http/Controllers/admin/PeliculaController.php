<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Importar clases del modelo
use App\Pelicula; // principal
use App\Genero;
use App\Director;
use App\Imagen;

class PeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $peliculas = Pelicula::orderBy('id', 'DESC')->paginate(10); // Obtener los registros ordenados y paginados
        // Enviar listado de registros a una vista
        $data['peliculas'] = $peliculas;
        return view('admin.pelicula.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {     // obtener listado de generos
        $data['generos'] = Genero::orderBy('genero','ASC')->pluck('genero','id');

        // obtener lista de directores 
         $data['directores'] = Director::orderBy('nombre','ASC')->pluck('nombre','id');

         // Renderizar formulario para nuevo registro
        return view('admin.pelicula.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $pelicula = new Pelicula($request->all());
     // dd($pelicula);
      $pelicula->user_id = 2;
      $pelicula->save();
      $pelicula->directores()->sync($request->directores);
      if ($request->file('imagen')) {
         $file = $request->file('imagen');
         $file_name = 'cinema_'.time().'.'.$file->getClientOriginalExtension();
         $file_path = public_path().'/imagenes/pelicula';
         $file->move($file_path,$file_name);
      }
      $imagen = new Imagen();
      $imagen->nombre  = $file_name;
      $imagen->pelicula()->associate($pelicula);
      $imagen->save();
      flash('se ha guardado correctamente la pelicula.')->success();
      return redirect()->route('pelicula.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
