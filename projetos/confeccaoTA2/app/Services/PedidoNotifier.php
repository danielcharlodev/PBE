<?php

namespace App\Services;

use App\Filament\Resources\Pedidos\PedidoResource;
use App\Models\Pedido;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Collection;

class PedidoNotifier
{
    public static function pedidoCriado(Pedido $pedido): void
    {
        self::enviar(
            $pedido,
            titulo: 'Novo pedido #' . $pedido->id,
            cor: 'success',
        );
    }

    public static function pedidoAtualizado(Pedido $pedido): void
    {
        self::enviar(
            $pedido,
            titulo: 'Pedido #' . $pedido->id . ' atualizado',
            cor: 'info',
        );
    }

    protected static function enviar(Pedido $pedido, string $titulo, string $cor): void
    {
        $pedido->loadMissing(['cliente', 'produto']);

        $corpo = sprintf(
            'Cliente: %s · Produto: %s (%s un.) · Status: %s · Valor: R$ %s',
            $pedido->cliente?->nome ?? '—',
            $pedido->produto?->nome ?? '—',
            $pedido->quantidade ?? 1,
            $pedido->status ?? '—',
            number_format((float) $pedido->valor_total, 2, ',', '.'),
        );

        $destinatarios = self::destinatarios();

        if ($destinatarios->isEmpty()) {
            return;
        }

        $notificacao = Notification::make()
            ->title($titulo)
            ->body($corpo)
            ->{$cor}()
            ->icon('heroicon-o-shopping-bag')
            ->actions([
                Action::make('ver')
                    ->label('Abrir pedido')
                    ->button()
                    ->url(PedidoResource::getUrl('view', ['record' => $pedido]))
                    ->markAsRead(),
            ]);

        foreach ($destinatarios as $usuario) {
            $notificacao->sendToDatabase($usuario, isEventDispatched: true);
        }
    }

    /**
     * @return Collection<int, User>
     */
    protected static function destinatarios(): Collection
    {
        return User::query()
            ->where(function ($query): void {
                $query
                    ->whereHas('roles', fn ($q) => $q->whereIn('name', ['Admin', 'Gerente Comercial']))
                    ->orWhereHas('permissions', fn ($q) => $q->where('name', 'acessar_pedidos'))
                    ->orWhereHas('roles.permissions', fn ($q) => $q->where('name', 'acessar_pedidos'));
            })
            ->get()
            ->unique('id');
    }
}
