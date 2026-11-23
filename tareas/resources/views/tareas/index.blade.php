@extends('layouts.app')

@section('titulo', 'Control de tareas')

@section('contenido')
    <h1>Control de tareas</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Fecha límite</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tareas as $tarea)
                <tr>
                    <td>{{ $tarea->id }}</td>
                    <td>{{ $tarea->codigo }}</td>
                    <td>{{ $tarea->titulo }}</td>
                    <td>{{ $tarea->descripcion ?: '—' }}</td>
                    <td>{{ $tarea->fecha_limite->format('d/m/Y') }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $tarea->estado)) }}</td>
                    <td>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="vacio">No hay tareas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection