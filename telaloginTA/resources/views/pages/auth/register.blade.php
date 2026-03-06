<x-layouts::auth>
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Crie sua conta')" :description="__('Insira seus dados abaixo para criar sua conta.')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-6">
            @csrf
            <!-- Name -->
            <flux:input
                name="name"
                :label="__('Nome')"
                :value="old('name')"
                type="text"
                required
                autofocus
                autocomplete="name"
                :placeholder="__('Nome Completo')"
            />

            <!-- Email Address -->
            <flux:input
                name="email"
                :label="__('Endereço de Email')"
                :value="old('email')"
                type="email"
                required
                autocomplete="email"
                placeholder="email@exemplo.com"
            />
            <flux:input
    name="telefone"
    :label="__('Telefone')"
    :value="old('telefone')"
    type="tel"
    required
    autocomplete="tel"
    placeholder="(11) 91234-5678"
/>

            <!-- Password -->
            <flux:input
                name="password"
                :label="__('Senha')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Senha')"
                viewable
            />

            <!-- Confirm Password -->
            <flux:input
                name="password_confirmation"
                :label="__('Confirme sua Senha')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Confirme sua Senha')"
                viewable
            />

            <div class="flex items-center justify-end">
                <flux:button type="submit" variant="primary" class="w-full" data-test="register-user-button">
                    {{ __('Criar') }}
                </flux:button>
            </div>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            <span>{{ __('Ja possui uma conta?') }}</span>
            <flux:link :href="route('login')" wire:navigate>{{ __('Login') }}</flux:link>
        </div>
    </div>
</x-layouts::auth>
