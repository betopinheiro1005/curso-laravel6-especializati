@extends('admin.layouts.app')

@section('title', 'Gestão de produtos')

@section('content')
    <h1>Exibindo os produtos</h1>

    <a class="btn btn-primary" href="{{ route('products.create') }}">Cadastrar</a>

    <hr>

    <form action="{{ route('products.search') }}" method="post" class="form form-inline">
        @csrf
        <input type="text" name="filter" class="form-control" value={{ $filters['filter'] ?? '' }}>
        <button type="submit" class="btn btn-info">Pesquisar</button>
    </form>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th width="100">Imagem</th>
                <th>Nome</th>
                <th>Preço</th>
                <th width='100'>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>
                        @if ($product->image)
                            <img src="{{ url("storage/{$product->image}") }}" alt="{{ $product->name }}" style="max-width: 100px;">
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <a href="{{ route('products.show', $product->id) }}">Detalhes</a>
                        <a href="{{ route('products.edit', $product->id) }}">Editar</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="text-leftr"><h5>Não há produtos cadastrados!</h5></td>
                    <td></td>
                    <td></td>
                </tr>                
            @endforelse
        

        </tbody>
    </table>

    <br>

    @if (isset($filters))
        {!! $products->appends($filters)->links() !!}    
    @else
    {!! $products->links() !!}
    @endif

    


{{--     @component('admin.components.card')
        @slot('title')
            <h3>Título Card</h3>
        @endslot
        Um card de exemplo
    @endcomponent

    <hr>

    @include('admin.includes.alerts', ['content' => 'Alerta de preços de produtos'])

    <hr>

    @if(isset($products))
        @foreach ($products as $product)
            <p class="@if($loop->last) last @elseif($loop->first) first @endif)">{{ $product }}</p>
        @endforeach
    @endif

    <hr>

    @forelse ($products2 as $product)
        <p >{{ $product }}</p>
    @empty
        <p>Não existem produtos cadastrados!</p>        
    @endforelse

    <hr>

    @if ($teste === '123')
        '123'
    @elseif($teste === 123)
        123
    @else
        É diferente de '123' ou de 123
    @endif
    
    @unless ($teste2 === '456')
        456
    @else
        '456'
    @endunless

    @isset($teste3)
        {{ $teste3 }}
    @endisset

    @empty($teste4)
        <p>Vazio...</p>
    @endempty

    @auth
        <p>Autenticado</p>
    @else    
        <p>Não autenticado</p>
    @endauth

    @guest
        <p>Não autenticado</p>
    @endguest

    @switch($teste)
        @case(1)
            Igual a 1
            @break
        @case(2)
            Igual a 2
            @break
        @case(123)
            Igual a 123
            @break
        @default
            Default
    @endswitch
 --}}

@endsection


{{-- @push('styles')
    <style>
        .last{
            background: #CCC;
        }
        .first{
            background: yellow;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.body.style.background = '#dfdfdf'
    </script>  
@endpush --}}

