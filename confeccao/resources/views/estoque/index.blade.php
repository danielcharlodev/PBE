<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; flex-direction:column; align-items:center; gap:20px;">
            <h2 style="font-size:32px; font-weight:800; color:#1f2937;">
                Estoque
            </h2>

            <a href="{{ route('estoque.create') }}"
               style="
                    background:linear-gradient(135deg,#10b981,#14b8a6);
                    color:white;
                    padding:14px 28px;
                    border-radius:999px;
                    font-weight:700;
                    font-size:14px;
                    letter-spacing:1px;
                    text-transform:uppercase;
                    text-decoration:none;
                    box-shadow:0 10px 20px rgba(16,185,129,0.25);
                    transition:all 0.25s ease;
               "
               onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 16px 30px rgba(16,185,129,0.35)'"
               onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 10px 20px rgba(16,185,129,0.25)'"
            >
                + Novo Item
            </a>
        </div>
    </x-slot>

    <div style="background:#f3f4f6; min-height:100vh; padding:40px 0;">
        <div style="max-width:1200px; margin:0 auto; padding:0 24px;">

            @if(session('success'))
                <div style="
                    max-width:700px;
                    margin:0 auto 30px auto;
                    background:#dcfce7;
                    color:#166534;
                    padding:16px 20px;
                    border-radius:16px;
                    font-weight:700;
                    text-align:center;
                    border:1px solid #bbf7d0;
                    box-shadow:0 8px 20px rgba(0,0,0,0.05);
                ">
                    {{ session('success') }}
                </div>
            @endif

            <div style="text-align:center; margin-bottom:30px;">
                <p style="font-size:20px; color:#4b5563;">
                    Total de itens no estoque:
                    <span style="font-weight:700; color:#111827;">{{ $estoque->count() }}</span>
                </p>
            </div>

            @if($estoque->count() > 0)
                <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:32px; align-items:stretch;">
                    @foreach ($estoque as $item)
                        @php
                            $baixo = $item->disponivel <= 5;
                            $cor1 = $baixo ? '#ef4444' : '#22c55e';
                            $cor2 = $baixo ? '#f97316' : '#14b8a6';
                            $badgeBg = $baixo ? '#fee2e2' : '#dcfce7';
                            $badgeColor = $baixo ? '#b91c1c' : '#15803d';
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
                                        {{ strtoupper(substr($item->nome, 0, 1)) }}
                                    </div>
                                </div>

                                <h3 style="font-size:26px; font-weight:800; color:#1f2937; margin-bottom:14px;">
                                    {{ $item->nome }}
                                </h3>

                                <p style="font-size:15px; color:#6b7280; margin-bottom:10px;">
                                    Quantidade: <strong style="color:#111827;">{{ $item->quantidade }}</strong>
                                </p>

                                <p style="font-size:15px; color:#6b7280; margin-bottom:10px;">
                                    Reservado: <strong style="color:#111827;">{{ $item->reservado }}</strong>
                                </p>

                                <p style="font-size:15px; color:#6b7280; margin-bottom:10px;">
                                    Disponível: <strong style="color:#111827;">{{ $item->disponivel }}</strong>
                                </p>

                                <p style="font-size:15px; color:#6b7280; margin-bottom:10px;">
                                    Entrada: <strong style="color:#111827;">{{ $item->data_entrada ?? 'Não informada' }}</strong>
                                </p>

                                <div style="margin-bottom:22px;">
                                    <span style="font-size:30px; font-weight:900; color:#111827;">
                                        R$ {{ number_format($item->preco, 2, ',', '.') }}
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
                                        {{ $baixo ? 'Estoque baixo' : 'Estoque normal' }}
                                    </span>
                                </div>

                                <div style="margin-top:22px; display:flex; justify-content:center; gap:12px; flex-wrap:wrap;">
                                    <a href="{{ route('estoque.edit', $item->id) }}"
                                       style="
                                            display:inline-block;
                                            background:linear-gradient(135deg,#f59e0b,#d97706);
                                            color:white;
                                            padding:12px 26px;
                                            border-radius:999px;
                                            font-weight:700;
                                            font-size:13px;
                                            letter-spacing:1px;
                                            text-transform:uppercase;
                                            text-decoration:none;
                                            box-shadow:0 8px 18px rgba(0,0,0,0.15);
                                            transition:all 0.25s ease;
                                       "
                                       onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 16px 28px rgba(0,0,0,0.25)'"
                                       onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 8px 18px rgba(0,0,0,0.15)'"
                                    >
                                        Editar
                                    </a>

                                    <button
                                        type="button"
                                        onclick="abrirModalExcluir('{{ $item->id }}', '{{ addslashes($item->nome) }}')"
                                        style="
                                            display:inline-block;
                                            background:linear-gradient(135deg,#ef4444,#dc2626);
                                            color:white;
                                            padding:12px 26px;
                                            border-radius:999px;
                                            font-weight:700;
                                            font-size:13px;
                                            letter-spacing:1px;
                                            text-transform:uppercase;
                                            border:none;
                                            cursor:pointer;
                                            box-shadow:0 8px 18px rgba(0,0,0,0.15);
                                            transition:all 0.25s ease;
                                        "
                                        onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 16px 28px rgba(0,0,0,0.25)'"
                                        onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 8px 18px rgba(0,0,0,0.15)'"
                                    >
                                        Excluir
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="
                    max-width:700px;
                    margin:0 auto;
                    background:white;
                    border-radius:24px;
                    padding:48px 32px;
                    text-align:center;
                    box-shadow:0 10px 25px rgba(0,0,0,0.08);
                    border:1px solid #e5e7eb;
                ">
                    <div style="font-size:52px; margin-bottom:14px;">📦</div>

                    <h3 style="font-size:28px; font-weight:800; color:#1f2937; margin-bottom:10px;">
                        Nenhum item em estoque
                    </h3>

                    <p style="font-size:16px; color:#6b7280; margin-bottom:25px;">
                        Quando houver itens, eles aparecerão aqui em cards organizados.
                    </p>

                    <a href="{{ route('estoque.create') }}"
                       style="
                            background:linear-gradient(135deg,#10b981,#14b8a6);
                            color:white;
                            padding:14px 28px;
                            border-radius:999px;
                            font-weight:700;
                            text-transform:uppercase;
                            text-decoration:none;
                            box-shadow:0 10px 20px rgba(16,185,129,0.25);
                            transition:all 0.25s ease;
                       "
                    >
                        Cadastrar primeiro item
                    </a>
                </div>
            @endif
        </div>
    </div>

    <div id="modalExcluir" style="
        position:fixed;
        inset:0;
        background:rgba(0,0,0,0.45);
        display:none;
        align-items:center;
        justify-content:center;
        z-index:9999;
        padding:20px;
    ">
        <div style="
            background:white;
            width:100%;
            max-width:460px;
            border-radius:24px;
            padding:34px 30px;
            box-shadow:0 25px 50px rgba(0,0,0,0.25);
            text-align:center;
            border:1px solid #e5e7eb;
        ">
            <div style="
                width:72px;
                height:72px;
                margin:0 auto 18px auto;
                border-radius:999px;
                display:flex;
                align-items:center;
                justify-content:center;
                background:#fee2e2;
                color:#dc2626;
                font-size:32px;
                font-weight:800;
            ">
                !
            </div>

            <h3 style="font-size:28px; font-weight:900; color:#111827; margin-bottom:10px;">
                Excluir item
            </h3>

            <p style="font-size:16px; color:#6b7280; margin-bottom:8px;">
                Você está prestes a excluir este item do estoque:
            </p>

            <p id="nomeItemExcluir" style="font-size:20px; font-weight:800; color:#1f2937; margin-bottom:28px;">
                Nome do item
            </p>

            <form id="formExcluirItem" method="POST">
                @csrf
                @method('DELETE')

                <div style="display:flex; justify-content:center; gap:12px; flex-wrap:wrap;">
                    <button
                        type="button"
                        onclick="fecharModalExcluir()"
                        style="
                            background:#e5e7eb;
                            color:#374151;
                            padding:14px 28px;
                            border:none;
                            border-radius:999px;
                            font-size:15px;
                            font-weight:700;
                            cursor:pointer;
                            transition:all 0.25s ease;
                        "
                        onmouseover="this.style.transform='translateY(-3px)'"
                        onmouseout="this.style.transform='translateY(0)'"
                    >
                        Cancelar
                    </button>

                    <button
                        type="submit"
                        style="
                            background:linear-gradient(135deg,#ef4444,#dc2626);
                            color:white;
                            padding:14px 28px;
                            border:none;
                            border-radius:999px;
                            font-size:15px;
                            font-weight:700;
                            cursor:pointer;
                            box-shadow:0 10px 20px rgba(0,0,0,0.12);
                            transition:all 0.25s ease;
                        "
                        onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 15px 30px rgba(0,0,0,0.18)'"
                        onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 10px 20px rgba(0,0,0,0.12)'"
                    >
                        Sim, excluir
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function abrirModalExcluir(id, nome) {
            document.getElementById('nomeItemExcluir').innerText = nome;
            document.getElementById('formExcluirItem').action = "{{ url('/estoque') }}/" + id;
            document.getElementById('modalExcluir').style.display = 'flex';
        }

        function fecharModalExcluir() {
            document.getElementById('modalExcluir').style.display = 'none';
        }

        document.getElementById('modalExcluir').addEventListener('click', function(e) {
            if (e.target === this) {
                fecharModalExcluir();
            }
        });
    </script>
</x-app-layout>