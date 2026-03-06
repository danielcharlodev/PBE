<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tabela de Estoque
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <h3 class="text-lg font-bold mb-4">
                    Lista de Itens do Estoque
                </h3>

                <table class="w-full border text-center">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 border">ID</th>
                            <th class="p-2 border">Item</th>
                            <th class="p-2 border">Quantidade</th>
                            <th class="p-2 border">Reservado</th>
                            <th class="p-2 border">Disponível</th>
                            <th class="p-2 border">Preço</th>
                            <th class="p-2 border">Entrada</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($estoque as $item)
                            <tr>
                                <td class="p-2 border">{{ $item->id }}</td>
                                <td class="p-2 border">{{ $item->nome }}</td>
                                <td class="p-2 border">{{ $item->quantidade }}</td>
                                <td class="p-2 border">{{ $item->reservado }}</td>
                                <td class="p-2 border font-bold text-green-600">
                                    {{ $item->disponivel }}
                                </td>
                                <td class="p-2 border">
                                    R$ {{ number_format($item->preco, 2, ',', '.') }}
                                </td>
                                <td class="p-2 border">
                                    {{ $item->data_entrada }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>