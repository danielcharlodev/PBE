<?php

namespace App\Filament\Resources\Pedidos\Pages;

use App\Filament\Resources\MovimentacaoEstoques\MovimentacaoEstoqueResource;
use App\Filament\Resources\Pedidos\Concerns\ValidaEstoquePedido;
use App\Filament\Resources\Pedidos\PedidoResource;
use App\Services\PedidoEstoqueService;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;

class CreatePedido extends CreateRecord
{
    use ValidaEstoquePedido;

    protected static string $resource = PedidoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->validarEstoquePedido($data);

        return $data;
    }

    protected function afterCreate(): void
    {
        $pedido = $this->record->load(['cliente', 'produto', 'movimentacaoEstoque']);

        $total = $pedido->calcularValorTotal();
        $pedido->updateQuietly(['valor_total' => $total]);

        Log::info('Auditoria: Novo Pedido Comercial Gerado', [
            'pedido_id' => $pedido->id,
            'valor_total' => $total,
            'operador' => auth()->user()?->email ?? 'Sistema',
        ]);

        if ($pedido->status === 'Finalizado') {
            PedidoEstoqueService::registrarSaida($pedido);
            $pedido->load('movimentacaoEstoque');

            if ($pedido->movimentacaoEstoque) {
                Notification::make()
                    ->title('Estoque atualizado')
                    ->body('Movimentação de saída criada e estoque do produto reduzido.')
                    ->success()
                    ->actions([
                        Action::make('ver')
                            ->label('Ver movimentação')
                            ->url(MovimentacaoEstoqueResource::getUrl('view', ['record' => $pedido->movimentacaoEstoque])),
                    ])
                    ->send();
            }
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
