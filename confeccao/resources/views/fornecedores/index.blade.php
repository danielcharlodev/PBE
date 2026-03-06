<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tabela de Fornecedores
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <h3 class="text-lg font-bold mb-4">
                    Lista de Fornecedores
                </h3>

                <table class="w-full border text-center">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 border">ID</th>
                            <th class="p-2 border">Nome</th>
                            <th class="p-2 border">CNPJ</th>
                            <th class="p-2 border">Telefone</th>
                            <th class="p-2 border">Email</th>
                            <th class="p-2 border">Cidade</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($fornecedores as $fornecedor)
                            <tr>
                                <td class="p-2 border">{{ $fornecedor->id }}</td>
                                <td class="p-2 border">{{ $fornecedor->nome }}</td>
                                <td class="p-2 border">{{ $fornecedor->cnpj }}</td>
                                <td class="p-2 border">{{ $fornecedor->telefone }}</td>
                                <td class="p-2 border">{{ $fornecedor->email }}</td>
                                <td class="p-2 border">{{ $fornecedor->cidade }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>