<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Novo Pedido
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <form method="POST" action="{{ route('pedidos.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium">Cliente</label>
                        <select name="cliente_id" class="mt-1 w-full border rounded p-2">
                            @foreach ($clientes as $c)
                                <option value="{{ $c->id }}">{{ $c->nome }}</option>
                            @endforeach
                        </select>
                        @error('cliente_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Item do estoque</label>
                        <select name="estoque_id" class="mt-1 w-full border rounded p-2">
                            @foreach ($produtos as $p)
                                <option value="{{ $p->id }}">
                                    {{ $p->nome }} (disp: {{ $p->disponivel }})
                                </option>
                            @endforeach
                        </select>
                        @error('estoque_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Quantidade</label>
                        <input type="number" name="quantidade" min="1" class="mt-1 w-full border rounded p-2" />
                        @error('quantidade') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex gap-2">
                        <button class="px-4 py-2 rounded bg-gray-800 text-white hover:bg-gray-700">
                            Salvar
                        </button>
                        <a href="{{ route('pedidos.index') }}" class="px-4 py-2 rounded border">
                            Voltar
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>