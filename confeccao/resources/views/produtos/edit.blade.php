<x-app-layout>
    <x-slot name="header">
        <h2 style="text-align:center; font-size:32px; font-weight:800; color:#1f2937;">
            Editar Produto
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

                <form method="POST" action="{{ route('produtos.update', $produto->id) }}">
                    @csrf
                    @method('PUT')

                    <div style="margin-bottom:22px;">
                        <label style="font-weight:700; display:block; margin-bottom:8px; color:#374151;">
                            Nome do Produto
                        </label>
                        <input
                            type="text"
                            name="nome"
                            value="{{ old('nome', $produto->nome) }}"
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
                            onfocus="this.style.borderColor='#f59e0b';this.style.boxShadow='0 0 0 3px rgba(245,158,11,0.2)'"
                            onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'"
                        >
                    </div>

                    <div style="margin-bottom:22px;">
                        <label style="font-weight:700; display:block; margin-bottom:8px; color:#374151;">
                            Descrição
                        </label>
                        <textarea
                            name="descricao"
                            rows="4"
                            style="
                                width:100%;
                                padding:14px 16px;
                                border-radius:12px;
                                border:1px solid #d1d5db;
                                font-size:15px;
                                outline:none;
                                resize:none;
                                transition:all 0.2s;
                            "
                            onfocus="this.style.borderColor='#f59e0b';this.style.boxShadow='0 0 0 3px rgba(245,158,11,0.2)'"
                            onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'"
                        >{{ old('descricao', $produto->descricao) }}</textarea>
                    </div>

                    <div style="margin-bottom:22px;">
                        <label style="font-weight:700; display:block; margin-bottom:8px; color:#374151;">
                            Preço
                        </label>
                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            name="preco"
                            value="{{ old('preco', $produto->preco) }}"
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
                            onfocus="this.style.borderColor='#f59e0b';this.style.boxShadow='0 0 0 3px rgba(245,158,11,0.2)'"
                            onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'"
                        >
                    </div>

                    <div style="margin-bottom:30px;">
                        <label style="font-weight:700; display:block; margin-bottom:8px; color:#374151;">
                            Categoria
                        </label>
                        <input
                            type="text"
                            name="categoria"
                            value="{{ old('categoria', $produto->categoria) }}"
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
                            onfocus="this.style.borderColor='#f59e0b';this.style.boxShadow='0 0 0 3px rgba(245,158,11,0.2)'"
                            onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'"
                        >
                    </div>

                    <div style="text-align:center; display:flex; justify-content:center; gap:14px; flex-wrap:wrap;">
                        <a
                            href="{{ route('produtos.index') }}"
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
                                background:linear-gradient(135deg,#f59e0b,#f97316);
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