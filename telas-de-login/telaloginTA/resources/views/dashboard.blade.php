<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        {{-- Topo: 3 cards --}}
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            {{-- React --}}
            <div class="rounded-xl border border-black/10 bg-sky-200 p-5">
                <div class="flex items-center justify-between">
                    <h3 class="text-base font-semibold text-black">React</h3>
                    <span class="text-xs px-2 py-1 rounded-full bg-white/60 text-black border border-black/10">
                        Front-end
                    </span>
                </div>
                <p class="mt-3 text-sm text-black">
                    Biblioteca pra criar interfaces com componentes. Ótimo pra telas bem dinâmicas.
                </p>
                <p class="mt-2 text-xs text-black/80">
                    “Montar a tela com peças”.
                </p>
            </div>

            {{-- Svelte --}}
            <div class="rounded-xl border border-black/10 bg-amber-200 p-5">
                <div class="flex items-center justify-between">
                    <h3 class="text-base font-semibold text-black">Svelte</h3>
                    <span class="text-xs px-2 py-1 rounded-full bg-white/60 text-black border border-black/10">
                        Front-end
                    </span>
                </div>
                <p class="mt-3 text-sm text-black">
                    Compila seu código e entrega um app leve. Menos coisa sobrando, mais velocidade.
                </p>
                <p class="mt-2 text-xs text-black/80">
                    Direto ao ponto.
                </p>
            </div>

            {{-- Vue --}}
            <div class="rounded-xl border border-black/10 bg-emerald-200 p-5">
                <div class="flex items-center justify-between">
                    <h3 class="text-base font-semibold text-black">Vue</h3>
                    <span class="text-xs px-2 py-1 rounded-full bg-white/60 text-black border border-black/10">
                        Front-end
                    </span>
                </div>
                <p class="mt-3 text-sm text-black">
                    Fácil de começar e muito forte pra crescer. Reatividade bem suave e organizada.
                </p>
                <p class="mt-2 text-xs text-black/80">
                    Equilíbrio total.
                </p>
            </div>
        </div>

        {{-- Parte de baixo: 4 cards --}}
        <div class="rounded-xl border border-black/10 bg-neutral-100 p-6">
            <div class="flex flex-col gap-4">
                <div>
                    <h2 class="text-lg font-semibold text-black">Back-end & Testes</h2>
                    <p class="mt-1 text-sm text-black/80">
                        É Um resumo rápido do que você vai ver no projeto.
                    </p>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    {{-- Livewire --}}
                    <div class="rounded-xl border border-black/10 bg-fuchsia-200 p-5">
                        <h3 class="text-base font-semibold text-black">Livewire</h3>
                        <p class="mt-2 text-sm text-black">
                            Deixa a tela interativa usando PHP. Você clica e atualiza sem escrever um monte de JS.
                        </p>
                        <p class="mt-2 text-xs text-black/80">
                            Blade + “mágica” do Livewire.
                        </p>
                    </div>

                    {{-- Framework (Laravel) --}}
                    <div class="rounded-xl border border-black/10 bg-indigo-200 p-5">
                        <h3 class="text-base font-semibold text-black">Framework (Laravel)</h3>
                        <p class="mt-2 text-sm text-black">
                            É a base do sistema: rotas, controllers, banco, validação e segurança tudo no lugar.
                        </p>
                        <p class="mt-2 text-xs text-black/80">
                            Organiza o projeto de verdade.
                        </p>
                    </div>

                    {{-- Pest --}}
                    <div class="rounded-xl border border-black/10 bg-lime-200 p-5">
                        <h3 class="text-base font-semibold text-black">Pest</h3>
                        <p class="mt-2 text-sm text-black">
                            Testes em PHP com uma escrita curtinha e mais “humana”. Bom pra testar sem dor.
                        </p>
                        <p class="mt-2 text-xs text-black/80">
                            Rápido e limpo.
                        </p>
                    </div>

                    {{-- PHPUnit --}}
                    <div class="rounded-xl border border-black/10 bg-rose-200 p-5">
                        <h3 class="text-base font-semibold text-black">PHPUnit</h3>
                        <p class="mt-2 text-sm text-black">
                            O clássico dos testes em PHP. É mais verboso, mas é o padrão do mercado.
                        </p>
                        <p class="mt-2 text-xs text-black/80">
                            Base de muita coisa.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>