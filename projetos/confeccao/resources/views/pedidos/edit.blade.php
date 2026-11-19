<x-app-layout>
    <x-slot name="header">
        <h2 style="text-align:center; font-size:32px; font-weight:800; color:#1f2937;">
            Editar Pedido
        </h2>
    </x-slot>

    <div style="background:#f3f4f6; min-height:100vh; padding:60px 0;">
        <div style="max-width:700px; margin:0 auto; padding:0 24px;">

            <div
                style="
                    background:white;
                    border-radius:24px;
                    padding:40px 36px;
                    box-shadow:0 15px 35px rgba(0,0,0,0.08);
                    border:1px solid #e5e7eb;
                "
            >

                @if ($errors->any())
                    <div style="
                        background:#fee2e2;
                        color:#991b1b;
                        padding:16px;
                        border-radius:12px;
                        margin-bottom:24px;
                        font-weight:600;
                    ">
                        <ul style="margin:0; padding-left:18px;">
                            @foreach ($errors->all() as $error)
                                <li style="margin-bottom:6px;">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @php
                    $item = $pedido->itens->first();
                @endphp

                <form method="POST" action="{{ route('pedidos.update', $pedido->id) }}">
                    @csrf
                    @method('PUT')

                    <div style="margin-bottom:22px;">
                        <label style="font-weight:700; display:block; margin-bottom:8px; color:#374151;">
                            Cliente
                        </label>
                        <select
                            name="cliente_id"
                            required
                            style="
                                width:100%;
                                padding:14px 16px;
                                border-radius:12px;
                                border:1px solid #d1d5db;
                                font-size:15px;
                                outline:none;
                                background:white;
                                transition:all 0.2s;
                            "
                            onfocus="this.style.borderColor='#22c55e';this.style.boxShadow='0 0 0 3px rgba(34,197,94,0.2)'"
                            onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'"
                        >
                            <option value="">Selecione um cliente</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ old('cliente_id', $pedido->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div style="margin-bottom:22px;">
                        <label style="font-weight:700; display:block; margin-bottom:8px; color:#374151;">
                            Produto / Item do Estoque
                        </label>
                        <select
                            name="estoque_id"
                            required
                            style="
                                width:100%;
                                padding:14px 16px;
                                border-radius:12px;
                                border:1px solid #d1d5db;
                                font-size:15px;
                                outline:none;
                                background:white;
                                transition:all 0.2s;
                            "
                            onfocus="this.style.borderColor='#22c55e';this.style.boxShadow='0 0 0 3px rgba(34,197,94,0.2)'"
                            onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'"
                        >
                            <option value="">Selecione um item</option>
                            @foreach($produtos as $produto)
                                <option value="{{ $produto->id }}" {{ old('estoque_id', $item?->estoque_id) == $produto->id ? 'selected' : '' }}>
                                    {{ $produto->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div style="margin-bottom:30px;">
                        <label style="font-weight:700; display:block; margin-bottom:8px; color:#374151;">
                            Quantidade
                        </label>
                        <input
                            type="number"
                            name="quantidade"
                            min="1"
                            value="{{ old('quantidade', $item?->quantidade) }}"
                            required
                            style="
                                width:100%;
                                padding:14px 16px;
                                border-radius:12px;
                                border:1px solid #d1d5db;
                                font-size:15px;
                                outline:none;
                                transition:all 0.2s;
                            "
                            onfocus="this.style.borderColor='#22c55e';this.style.boxShadow='0 0 0 3px rgba(34,197,94,0.2)'"
                            onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'"
                        >
                    </div>

                    <div style="
                        background:#f9fafb;
                        border:1px solid #e5e7eb;
                        border-radius:16px;
                        padding:18px 20px;
                        margin-bottom:30px;
                    ">
                        <h3 style="font-size:18px; font-weight:800; color:#1f2937; margin-bottom:12px;">
                            Informações atuais do pedido
                        </h3>

                        <p style="font-size:15px; color:#6b7280; margin-bottom:8px;">
                            Status:
                            <strong style="color:#111827;">{{ ucfirst($pedido->status) }}</strong>
                        </p>

                        <p style="font-size:15px; color:#6b7280; margin-bottom:8px;">
                            Data do pedido:
                            <strong style="color:#111827;">{{ $pedido->data_pedido }}</strong>
                        </p>

                        <p style="font-size:15px; color:#6b7280; margin-bottom:8px;">
                            Quantidade reservada:
                            <strong style="color:#111827;">{{ $item?->quantidade_reservada ?? 0 }}</strong>
                        </p>

                        <p style="font-size:15px; color:#6b7280; margin-bottom:0;">
                            Quantidade em falta:
                            <strong style="color:#111827;">{{ $item?->quantidade_em_falta ?? 0 }}</strong>
                        </p>
                    </div>

                    <div style="text-align:center; display:flex; justify-content:center; gap:14px; flex-wrap:wrap;">
                        <a
                            href="{{ route('pedidos.index') }}"
                            style="
                                background:#e5e7eb;
                                color:#374151;
                                padding:14px 32px;
                                text-decoration:none;
                                border-radius:999px;
                                font-size:16px;
                                font-weight:700;
                                display:inline-block;
                                transition:all 0.25s ease;
                            "
                            onmouseover="this.style.transform='translateY(-3px)'"
                            onmouseout="this.style.transform='translateY(0)'"
                        >
                            Cancelar
                        </a>

                        <button
                            type="submit"
                            style="
                                background:linear-gradient(135deg,#22c55e,#14b8a6);
                                color:white;
                                padding:14px 40px;
                                border:none;
                                border-radius:999px;
                                font-size:16px;
                                font-weight:700;
                                cursor:pointer;
                                box-shadow:0 10px 20px rgba(0,0,0,0.1);
                                transition:all 0.25s ease;
                            "
                            onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 15px 30px rgba(0,0,0,0.18)'"
                            onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 10px 20px rgba(0,0,0,0.1)'"
                        >
                            Salvar Alterações
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>