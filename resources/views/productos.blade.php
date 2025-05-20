@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Productos disponibles</h1>

    @foreach ($productos as $producto)
        <div class="border p-3 rounded mb-4 shadow-sm">
            <h4>{{ $producto->nombre }}</h4>
            <p>{{ $producto->descripcion }}</p>
            <strong>${{ number_format($producto->precio, 2) }}</strong><br>
            <form method="POST" action="{{ route('carrito.agregar', $producto->id) }}">
                @csrf
                <button type="submit" class="btn btn-primary mt-2">Agregar al carrito</button>
            </form>
        </div>
    @endforeach

    @if ($productos->isEmpty())
        <p>No hay productos disponibles en este momento.</p>
    @endif
</div>
@endsection
