<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:28px; font-weight:800; color:#1f2937; text-align:center;">
            Dashboard
        </h2>
    </x-slot>

    <div style="background:#f3f4f6; min-height:100vh; padding:40px 0;">
        <div style="max-width:1280px; margin:auto; padding:0 20px;">

            <div style="
                background:linear-gradient(135deg,#4f46e5,#7c3aed);
                color:white;
                padding:34px 30px;
                border-radius:24px;
                margin-bottom:34px;
                box-shadow:0 16px 35px rgba(79,70,229,0.22);
                text-align:center;
            ">
                <h1 style="font-size:38px; font-weight:900; margin-bottom:10px;">
                    Bem-vindo, {{ Auth::user()->name }} 👋
                </h1>

                <p style="font-size:18px; opacity:0.95;">
                    Gerencie seu sistema de forma rápida, organizada e elegante.
                </p>
            </div>

            <div style="
                display:grid;
                grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
                gap:24px;
                margin-bottom:36px;
            ">

                <a href="{{ route('clientes.index') }}"
                   style="
                        background:white;
                        border-radius:24px;
                        padding:30px 22px;
                        box-shadow:0 10px 25px rgba(0,0,0,0.08);
                        text-align:center;
                        text-decoration:none;
                        border:1px solid #e5e7eb;
                        transition:all 0.25s ease;
                        color:inherit;
                   "
                   onmouseover="this.style.transform='translateY(-8px)';this.style.boxShadow='0 20px 35px rgba(0,0,0,0.14)'"
                   onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 10px 25px rgba(0,0,0,0.08)'"
                >
                    <div style="font-size:42px; margin-bottom:14px;">👥</div>
                    <h3 style="font-size:24px; font-weight:800; color:#111827; margin-bottom:8px;">
                        Clientes
                    </h3>
                    <p style="font-size:16px; color:#6b7280;">
                        Cadastre, edite e acompanhe seus clientes.
                    </p>
                </a>

                <a href="{{ route('produtos.index') }}"
                   style="
                        background:white;
                        border-radius:24px;
                        padding:30px 22px;
                        box-shadow:0 10px 25px rgba(0,0,0,0.08);
                        text-align:center;
                        text-decoration:none;
                        border:1px solid #e5e7eb;
                        transition:all 0.25s ease;
                        color:inherit;
                   "
                   onmouseover="this.style.transform='translateY(-8px)';this.style.boxShadow='0 20px 35px rgba(0,0,0,0.14)'"
                   onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 10px 25px rgba(0,0,0,0.08)'"
                >
                    <div style="font-size:42px; margin-bottom:14px;">📦</div>
                    <h3 style="font-size:24px; font-weight:800; color:#111827; margin-bottom:8px;">
                        Produtos
                    </h3>
                    <p style="font-size:16px; color:#6b7280;">
                        Organize seus produtos e mantenha tudo em ordem.
                    </p>
                </a>

                <a href="{{ route('estoque.index') }}"
                   style="
                        background:white;
                        border-radius:24px;
                        padding:30px 22px;
                        box-shadow:0 10px 25px rgba(0,0,0,0.08);
                        text-align:center;
                        text-decoration:none;
                        border:1px solid #e5e7eb;
                        transition:all 0.25s ease;
                        color:inherit;
                   "
                   onmouseover="this.style.transform='translateY(-8px)';this.style.boxShadow='0 20px 35px rgba(0,0,0,0.14)'"
                   onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 10px 25px rgba(0,0,0,0.08)'"
                >
                    <div style="font-size:42px; margin-bottom:14px;">📚</div>
                    <h3 style="font-size:24px; font-weight:800; color:#111827; margin-bottom:8px;">
                        Estoque
                    </h3>
                    <p style="font-size:16px; color:#6b7280;">
                        Controle entradas, saídas e quantidades disponíveis.
                    </p>
                </a>

                <a href="{{ route('fornecedores.index') }}"
                   style="
                        background:white;
                        border-radius:24px;
                        padding:30px 22px;
                        box-shadow:0 10px 25px rgba(0,0,0,0.08);
                        text-align:center;
                        text-decoration:none;
                        border:1px solid #e5e7eb;
                        transition:all 0.25s ease;
                        color:inherit;
                   "
                   onmouseover="this.style.transform='translateY(-8px)';this.style.boxShadow='0 20px 35px rgba(0,0,0,0.14)'"
                   onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 10px 25px rgba(0,0,0,0.08)'"
                >
                    <div style="font-size:42px; margin-bottom:14px;">🚚</div>
                    <h3 style="font-size:24px; font-weight:800; color:#111827; margin-bottom:8px;">
                        Fornecedores
                    </h3>
                    <p style="font-size:16px; color:#6b7280;">
                        Gerencie parceiros, contatos e abastecimento.
                    </p>
                </a>

                <a href="{{ route('pedidos.index') }}"
                   style="
                        background:white;
                        border-radius:24px;
                        padding:30px 22px;
                        box-shadow:0 10px 25px rgba(0,0,0,0.08);
                        text-align:center;
                        text-decoration:none;
                        border:1px solid #e5e7eb;
                        transition:all 0.25s ease;
                        color:inherit;
                   "
                   onmouseover="this.style.transform='translateY(-8px)';this.style.boxShadow='0 20px 35px rgba(0,0,0,0.14)'"
                   onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 10px 25px rgba(0,0,0,0.08)'"
                >
                    <div style="font-size:42px; margin-bottom:14px;">🧾</div>
                    <h3 style="font-size:24px; font-weight:800; color:#111827; margin-bottom:8px;">
                        Pedidos
                    </h3>
                    <p style="font-size:16px; color:#6b7280;">
                        Acompanhe pedidos e movimentações do sistema.
                    </p>
                </a>

            </div>

            <div style="
                background:white;
                border-radius:28px;
                padding:34px 28px;
                box-shadow:0 10px 25px rgba(0,0,0,0.08);
                border:1px solid #e5e7eb;
            ">
                <h3 style="
                    font-size:30px;
                    font-weight:900;
                    text-align:center;
                    color:#111827;
                    margin-bottom:26px;
                ">
                    Ações rápidas
                </h3>

                <div style="
                    display:flex;
                    justify-content:center;
                    flex-wrap:wrap;
                    gap:18px;
                ">
                    <a href="{{ route('clientes.create') }}"
                       style="
                            background:linear-gradient(135deg,#3b82f6,#2563eb);
                            color:white;
                            padding:14px 28px;
                            border-radius:999px;
                            font-weight:800;
                            font-size:15px;
                            text-decoration:none;
                            box-shadow:0 10px 20px rgba(37,99,235,0.22);
                            transition:all 0.25s ease;
                       "
                       onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 16px 28px rgba(37,99,235,0.32)'"
                       onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 10px 20px rgba(37,99,235,0.22)'"
                    >
                        + Novo Cliente
                    </a>

                    <a href="{{ route('produtos.create') }}"
                       style="
                            background:linear-gradient(135deg,#10b981,#059669);
                            color:white;
                            padding:14px 28px;
                            border-radius:999px;
                            font-weight:800;
                            font-size:15px;
                            text-decoration:none;
                            box-shadow:0 10px 20px rgba(5,150,105,0.22);
                            transition:all 0.25s ease;
                       "
                       onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 16px 28px rgba(5,150,105,0.32)'"
                       onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 10px 20px rgba(5,150,105,0.22)'"
                    >
                        + Novo Produto
                    </a>

                    <a href="{{ route('estoque.create') }}"
                       style="
                            background:linear-gradient(135deg,#06b6d4,#0891b2);
                            color:white;
                            padding:14px 28px;
                            border-radius:999px;
                            font-weight:800;
                            font-size:15px;
                            text-decoration:none;
                            box-shadow:0 10px 20px rgba(8,145,178,0.22);
                            transition:all 0.25s ease;
                       "
                       onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 16px 28px rgba(8,145,178,0.32)'"
                       onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 10px 20px rgba(8,145,178,0.22)'"
                    >
                        + Novo Estoque
                    </a>

                    <a href="{{ route('fornecedores.create') }}"
                       style="
                            background:linear-gradient(135deg,#8b5cf6,#7c3aed);
                            color:white;
                            padding:14px 28px;
                            border-radius:999px;
                            font-weight:800;
                            font-size:15px;
                            text-decoration:none;
                            box-shadow:0 10px 20px rgba(124,58,237,0.22);
                            transition:all 0.25s ease;
                       "
                       onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 16px 28px rgba(124,58,237,0.32)'"
                       onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 10px 20px rgba(124,58,237,0.22)'"
                    >
                        + Novo Fornecedor
                    </a>

                    <a href="{{ route('pedidos.create') }}"
                       style="
                            background:linear-gradient(135deg,#f59e0b,#d97706);
                            color:white;
                            padding:14px 28px;
                            border-radius:999px;
                            font-weight:800;
                            font-size:15px;
                            text-decoration:none;
                            box-shadow:0 10px 20px rgba(217,119,6,0.22);
                            transition:all 0.25s ease;
                       "
                       onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 16px 28px rgba(217,119,6,0.32)'"
                       onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 10px 20px rgba(217,119,6,0.22)'"
                    >
                        + Novo Pedido
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>