<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pedidos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold">Lista de pedidos</h3>
                    <a href="{{ route('pedidos.create') }}"
                       class="px-4 py-2 rounded bg-gray-800 text-white hover:bg-gray-700">
                        Novo pedido
                    </a>
                </div>

                <table class="w-full border text-center">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 border">ID</th>
                            <th class="p-2 border">Cliente</th>
                            <th class="p-2 border">Status</th>
                            <th class="p-2 border">Item</th>
                            <th class="p-2 border">Qtd</th>
                            <th class="p-2 border">Reservada</th>
                            <th class="p-2 border">Falta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedidos as $pedido)
                            @php $item = $pedido->itens->first(); @endphp
                            <tr>
                                <td class="p-2 border">{{ $pedido->id }}</td>
                                <td class="p-2 border">{{ $pedido->cliente->nome ?? '-' }}</td>
                                <td class="p-2 border">{{ $pedido->status }}</td>
                                <td class="p-2 border">{{ $item?->estoque?->nome ?? '-' }}</td>
                                <td class="p-2 border">{{ $item?->quantidade ?? 0 }}</td>
                                <td class="p-2 border">{{ $item?->quantidade_reservada ?? 0 }}</td>
                                <td class="p-2 border">{{ $item?->quantidade_em_falta ?? 0 }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>