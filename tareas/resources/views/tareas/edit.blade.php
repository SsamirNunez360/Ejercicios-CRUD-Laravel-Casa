@extends('layouts.app')

@section('titulo', 'Editar tarea')

@section('contenido')
    <h1>Editar tarea</h1>

    <form method="POST" action="{{ route('tareas.update', $tarea->id) }}">
        @csrf
        @method('PUT')

        <label for="codigo">Código</label>
        <input id="codigo" name="codigo" type="text" maxlength="20" value="{{ old('codigo', $tarea->codigo) }}" required>
        @error('codigo')
            <p class="error">{{ $message }}</p>
        @enderror

        <label for="titulo">Título</label>
        <input id="titulo" name="titulo" type="text" maxlength="120" value="{{ old('titulo', $tarea->titulo) }}" required>
        @error('titulo')
            <p class="error">{{ $message }}</p>
        @enderror

        <label for="descripcion">Descripción (opcional)</label>
        <textarea id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $tarea->descripcion) }}</textarea>
        @error('descripcion')
            <p class="error">{{ $message }}</p>
        @enderror

        <label for="fecha_limite">Fecha límite</label>
        <input id="fecha_limite" name="fecha_limite" type="date" value="{{ old('fecha_limite', $tarea->fecha_limite->format('Y-m-d')) }}" required>
        @error('fecha_limite')
            <p class="error">{{ $message }}</p>
        @enderror

        <label for="estado">Estado</label>
        <select id="estado" name="estado" required>
            <option value="">Seleccione...</option>
            @foreach (\App\Models\Tarea::ESTADOS as $opcion)
                <option value="{{ $opcion }}" @selected(old('estado', $tarea->estado) === $opcion)>{{ ucfirst(str_replace('_', ' ', $opcion)) }}</option>
            @endforeach
        </select>
        @error('estado')
            <p class="error">{{ $message }}</p>
        @enderror

        <p>
            <button type="submit">Actualizar</button>
            <a href="{{ route('tareas.index') }}">Cancelar</a>
        </p>
    </form>
@endsection