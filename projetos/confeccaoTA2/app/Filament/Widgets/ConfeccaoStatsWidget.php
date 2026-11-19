<?php

namespace App\Filament\Widgets;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Produto;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ConfeccaoStatsWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected ?string $heading = 'Visão geral';

    protected ?string $description = 'Resumo do sistema de confecção';

    protected function getStats(): array
    {
        $pedidosPendentes = Pedido::query()->where('status', 'Pendente')->count();
        $faturamento = Pedido::query()->sum('valor_total');

        return [
            Stat::make('Clientes', Cliente::query()->count())
                ->description('Cadastros ativos')
                ->descriptionIcon(Heroicon::OutlinedUserGroup)
                ->color('primary'),

            Stat::make('Produtos', Produto::query()->count())
                ->description('Itens no catálogo')
                ->descriptionIcon(Heroicon::OutlinedTag)
                ->color('info'),

            Stat::make('Pedidos pendentes', $pedidosPendentes)
                ->description('Aguardando produção')
                ->descriptionIcon(Heroicon::OutlinedClock)
                ->color($pedidosPendentes > 0 ? 'warning' : 'success'),

            Stat::make(
                'Faturamento',
                'R$ ' . number_format((float) $faturamento, 2, ',', '.'),
            )
                ->description('Total em pedidos')
                ->descriptionIcon(Heroicon::OutlinedBanknotes)
                ->color('success'),
        ];
    }
}
