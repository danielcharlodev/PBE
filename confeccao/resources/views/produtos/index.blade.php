<x-app-layout>
    <x-slot name="header">
        <h2 style="text-align:center; font-size:32px; font-weight:800; color:#1f2937;">
            Produtos
        </h2>
    </x-slot>

    <div style="background:#f3f4f6; min-height:100vh; padding:40px 0;">
        <div style="max-width:1200px; margin:0 auto; padding:0 24px;">

            <div style="text-align:center; margin-bottom:30px;">
                <p style="font-size:20px; color:#4b5563;">
                    Total de produtos:
                    <span style="font-weight:700; color:#111827;">{{ $produtos->count() }}</span>
                </p>
            </div>

            @if($produtos->count() > 0)
                <div
                    style="
                        display:grid;
                        grid-template-columns:repeat(3, 1fr);
                        gap:32px;
                        align-items:stretch;
                    "
                >
                    @foreach ($produtos as $produto)
                        @php
                            $categoria = strtolower($produto->categoria ?? '');

                            if ($categoria === 'roupa') {
                                $cor1 = '#8b5cf6';
                                $cor2 = '#ec4899';
                                $badgeBg = '#f3e8ff';
                                $badgeColor = '#7e22ce';
                            } elseif ($categoria === 'cama') {
                                $cor1 = '#3b82f6';
                                $cor2 = '#06b6d4';
                                $badgeBg = '#dbeafe';
                                $badgeColor = '#1d4ed8';
                            } elseif ($categoria === 'banho') {
                                $cor1 = '#f43f5e';
                                $cor2 = '#fb7185';
                                $badgeBg = '#ffe4e6';
                                $badgeColor = '#be123c';
                            } else {
                                $cor1 = '#6366f1';
                                $cor2 = '#0ea5e9';
                                $badgeBg = '#e0e7ff';
                                $badgeColor = '#3730a3';
                            }
                        @endphp

                        <div
                            style="
                                background:#ffffff;
                                border-radius:24px;
                                padding:32px 24px;
                                box-shadow:0 10px 25px rgba(0,0,0,0.08);
                                text-align:center;
                                min-height:380px;
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
                                        {{ strtoupper(substr($produto->nome, 0, 1)) }}
                                    </div>
                                </div>

                                <h3 style="font-size:28px; font-weight:800; color:#1f2937; margin-bottom:14px;">
                                    {{ $produto->nome }}
                                </h3>

                                <p style="font-size:16px; line-height:1.7; color:#6b7280; margin-bottom:26px; min-height:82px;">
                                    {{ \Illuminate\Support\Str::limit($produto->descricao ?: 'Produto cadastrado no sistema.', 100) }}
                                </p>

                                <div style="margin-bottom:22px;">
                                    <span style="font-size:34px; font-weight:900; color:#111827;">
                                        R$ {{ number_format($produto->preco, 2, ',', '.') }}
                                    </span>
                                </div>

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
                                        {{ $produto->categoria ?? 'Sem categoria' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div
                    style="
                        max-width:700px;
                        margin:0 auto;
                        background:white;
                        border-radius:24px;
                        padding:48px 32px;
                        text-align:center;
                        box-shadow:0 10px 25px rgba(0,0,0,0.08);
                        border:1px solid #e5e7eb;
                    "
                >
                    <div style="font-size:52px; margin-bottom:14px;">📦</div>
                    <h3 style="font-size:28px; font-weight:800; color:#1f2937; margin-bottom:10px;">
                        Nenhum produto cadastrado
                    </h3>
                    <p style="font-size:16px; color:#6b7280;">
                        Quando houver produtos, eles aparecerão aqui em cards organizados.
                    </p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>