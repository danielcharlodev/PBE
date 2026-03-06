<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Produtos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold">Lista de produtos</h3>
                </div>

                <table class="w-full border text-center">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 border">ID</th>
                            <th class="p-2 border">Nome</th>
                            <th class="p-2 border">Descrição</th>
                            <th class="p-2 border">Preço</th>
                            <th class="p-2 border">Categoria</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($produtos as $produto)
                            <tr>
                                <td class="p-2 border">{{ $produto->id }}</td>
                                <td class="p-2 border">{{ $produto->nome }}</td>
                                <td class="p-2 border">{{ $produto->descricao }}</td>
                                <td class="p-2 border">
                                    R$ {{ number_format($produto->preco, 2, ',', '.') }}
                                </td>
                                <td class="p-2 border">{{ $produto->categoria }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>