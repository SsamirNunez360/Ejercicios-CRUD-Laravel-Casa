<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TareaController extends Controller
{
    public function index()
    {
        $tareas = Tarea::orderBy('id')->get();

        return view('tareas.index', compact('tareas'));
    }

    public function create()
    {
        return view('tareas.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'codigo' => ['required', 'string', 'max:20', 'unique:tareas,codigo'],
            'titulo' => ['required', 'string', 'max:120'],
            'descripcion' => ['nullable', 'string'],
            'fecha_limite' => ['required', 'date'],
            'estado' => ['required', 'in:' . implode(',', Tarea::ESTADOS)],
        ]);

        $tarea = new Tarea();
        $tarea->codigo = $datos['codigo'];
        $tarea->titulo = $datos['titulo'];
        $tarea->descripcion = $datos['descripcion'] ?? null;
        $tarea->fecha_limite = $datos['fecha_limite'];
        $tarea->estado = $datos['estado'];
        $tarea->save();

        return redirect()
            ->route('tareas.index')
            ->with('exito', 'Tarea creada correctamente.');
    }

    public function edit($id)
    {
        $tarea = Tarea::findOrFail($id);

        return view('tareas.edit', compact('tarea'));
    }

    public function update(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);

        $datos = $request->validate([
            'codigo' => ['required', 'string', 'max:20', Rule::unique('tareas', 'codigo')->ignore($tarea)],
            'titulo' => ['required', 'string', 'max:120'],
            'descripcion' => ['nullable', 'string'],
            'fecha_limite' => ['required', 'date'],
            'estado' => ['required', 'in:' . implode(',', Tarea::ESTADOS)],
        ]);

        $tarea->codigo = $datos['codigo'];
        $tarea->titulo = $datos['titulo'];
        $tarea->descripcion = $datos['descripcion'] ?? null;
        $tarea->fecha_limite = $datos['fecha_limite'];
        $tarea->estado = $datos['estado'];
        $tarea->save();

        return redirect()
            ->route('tareas.index')
            ->with('exito', 'Tarea actualizada correctamente.');
    }

    public function destroy($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();

        return redirect()
            ->route('tareas.index')
            ->with('exito', 'Tarea eliminada correctamente.');
    }
}