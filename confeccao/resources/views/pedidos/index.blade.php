<x-app-layout>
    <x-slot name="header">
        <h2 style="text-align:center; font-size:32px; font-weight:800; color:#1f2937;">
            Pedidos
        </h2>
    </x-slot>

    <div style="background:#f3f4f6; min-height:100vh; padding:40px 0;">
        <div style="max-width:1200px; margin:0 auto; padding:0 24px;">

            <div style="text-align:center; margin-bottom:30px;">
                <p style="font-size:20px; color:#4b5563;">
                    Total de pedidos:
                    <span style="font-weight:700; color:#111827;">{{ $pedidos->count() }}</span>
                </p>
            </div>

            @if($pedidos->count() > 0)
                <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:32px; align-items:stretch;">
                    @foreach ($pedidos as $pedido)
                        @php
                            $item = $pedido->itens->first();

                            if ($pedido->status === 'reservado') {
                                $cor1 = '#22c55e';
                                $cor2 = '#14b8a6';
                                $badgeBg = '#dcfce7';
                                $badgeColor = '#15803d';
                            } elseif ($pedido->status === 'pendente') {
                                $cor1 = '#f59e0b';
                                $cor2 = '#f97316';
                                $badgeBg = '#fef3c7';
                                $badgeColor = '#b45309';
                            } elseif ($pedido->status === 'finalizado') {
                                $cor1 = '#3b82f6';
                                $cor2 = '#06b6d4';
                                $badgeBg = '#dbeafe';
                                $badgeColor = '#1d4ed8';
                            } else {
                                $cor1 = '#6b7280';
                                $cor2 = '#9ca3af';
                                $badgeBg = '#e5e7eb';
                                $badgeColor = '#374151';
                            }
                        @endphp

                        <div
                            style="
                                background:#ffffff;
                                border-radius:24px;
                                padding:32px 24px;
                                box-shadow:0 10px 25px rgba(0,0,0,0.08);
                                text-align:center;
                                min-height:430px;
                                display:flex;
                                flex-direction:column;
                                justify-content:space-between;
                                border:1px solid #e5e7eb;
                                transition:all 0.25s ease;
                            "
                            onmouseover="this.style.transform='translateY(-8px)';this.style.boxShadow='0 18px 35px rgba(0,0,0,0.14)'"
                            onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 10px 25px rgba(0,0,0,0.08)'"
                        >
                            <div>
                                <div style="display:flex; justify-content:center; margin-bottom:22px;">
                                    <div
                                        style="
                                            width:82px;
                                            height:82px;
                                            border-radius:999px;
                                            display:flex;
                                            align-items:center;
                                            justify-content:center;
                                            color:white;
                                            font-size:30px;
                                            font-weight:800;
                                            background:linear-gradient(135deg, {{ $cor1 }}, {{ $cor2 }});
                                            box-shadow:0 10px 20px rgba(0,0,0,0.12);
                                        "
                                    >
                                        {{ $pedido->id }}
                                    </div>
                                </div>

                                <h3 style="font-size:24px; font-weight:800; color:#1f2937; margin-bottom:14px;">
                                    {{ $pedido->cliente->nome ?? 'Sem cliente' }}
                                </h3>

                                <p style="font-size:15px; color:#6b7280; margin-bottom:10px;">
                                    Item: <strong style="color:#111827;">{{ $item?->estoque?->nome ?? '-' }}</strong>
                                </p>

                                <p style="font-size:15px; color:#6b7280; margin-bottom:10px;">
                                    Quantidade: <strong style="color:#111827;">{{ $item?->quantidade ?? 0 }}</strong>
                                </p>

                                <p style="font-size:15px; color:#6b7280; margin-bottom:10px;">
                                    Reservada: <strong style="color:#111827;">{{ $item?->quantidade_reservada ?? 0 }}</strong>
                                </p>

                                <p style="font-size:15px; color:#6b7280; margin-bottom:22px;">
                                    Em falta: <strong style="color:#111827;">{{ $item?->quantidade_em_falta ?? 0 }}</strong>
                                </p>

                                <div>
                                    <span
                                        style="
                                            display:inline-block;
                                            padding:10px 18px;
                                            border-radius:999px;
                                            font-size:14px;
                                            font-weight:700;
                                            background:{{ $badgeBg }};
                                            color:{{ $badgeColor }};
                                        "
                                    >
                                        {{ ucfirst($pedido->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="max-width:700px; margin:0 auto; background:white; border-radius:24px; padding:48px 32px; text-align:center; box-shadow:0 10px 25px rgba(0,0,0,0.08); border:1px solid #e5e7eb;">
                    <div style="font-size:52px; margin-bottom:14px;">🧾</div>
                    <h3 style="font-size:28px; font-weight:800; color:#1f2937; margin-bottom:10px;">Nenhum pedido cadastrado</h3>
                    <p style="font-size:16px; color:#6b7280;">Quando houver pedidos, eles aparecerão aqui em cards organizados.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>