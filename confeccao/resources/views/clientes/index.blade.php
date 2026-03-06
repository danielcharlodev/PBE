<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nossa Confecção
        </h2>
    </x-slot>

```
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach ($clientes as $cliente)
                    <div class="border p-4 rounded shadow-sm">

                        <div class="flex items-center justify-between">
                            <h3 class="font-bold text-lg">
                                {{ $cliente->nome }}
                            </h3>
                            <span class="text-xs text-gray-500">
                                ID: {{ $cliente->id }}
                            </span>
                        </div>

                        <p class="text-sm text-gray-600">
                            CPF: {{ $cliente->cpf }}
                        </p>

                        <p class="mt-2 text-blue-600 font-bold">
                            Telefone: {{ $cliente->telefone }}
                        </p>

                        <p class="mt-2 text-sm">
                            Reserva:
                            <span class="font-bold">
                                {{ $cliente->reserva ? 'Sim' : 'Não' }}
                            </span>
                        </p>

                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
```

</x-app-layout>
