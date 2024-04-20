<?php

namespace App\Http\Controllers;

use App\Models\Personas;
use Illuminate\Http\Request;

class PersonasController extends Controller
{
    
    public function index()
    {
        $datos = Personas::orderBy('paterno', 'desc')->paginate(3);
        return view('welcome', compact('datos'));
    }

    public function create()
    {
        //formulario donde nosotros agregamos datos
        return view('agregar');
    }

    public function store(Request $request)
    {
        $personas = new Personas();
        $personas->paterno = $request->post('paterno');
        $personas->materno = $request->post('materno');
        $personas->nombre = $request->post('nombre');
        $personas->fecha_nacimiento = $request->post('fecha_nacimiento');
        $personas->save();

        return redirect()->route("personas.index")->with("success", "Agregado con éxito");
    }

    public function show($id)
    {
        //obtener un solo registro de nuestra tabla
        $personas = Personas::find($id);
        return view('eliminar', compact('personas'));
    }

    public function edit($id)
    {
        //traer los datos que se van a editar
        //y los coloca en un formulario
        $personas = Personas::find($id);
        return view('actualizar', compact('personas'));

    }

    public function update(Request $request, $id)
    {
        $personas = Personas::find($id);
        $personas->paterno = $request->post('paterno');
        $personas->materno = $request->post('materno');
        $personas->nombre = $request->post('nombre');
        $personas->fecha_nacimiento = $request->post('fecha_nacimiento');
        $personas->save();

        return redirect()->route("personas.index")->with("success", "Actualizado con éxito");
    }

    public function destroy($id)
    {
        $personas = Personas::find($id);
        $personas->delete();

        return redirect()->route("personas.index")->with("success", "Eliminado con éxito");
    }
}
