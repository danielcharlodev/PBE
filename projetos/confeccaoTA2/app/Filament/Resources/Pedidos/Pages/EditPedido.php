<?php

namespace App\Filament\Resources\Pedidos\Pages;

use App\Filament\Resources\MovimentacaoEstoques\MovimentacaoEstoqueResource;
use App\Filament\Resources\Pedidos\Concerns\ValidaEstoquePedido;
use App\Filament\Resources\Pedidos\PedidoResource;
use App\Services\PedidoEstoqueService;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Log;

class EditPedido extends EditRecord
{
    use ValidaEstoquePedido;

    protected static string $resource = PedidoResource::class;

    protected ?string $statusAntesDeSalvar = null;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function beforeSave(): void
    {
        $this->statusAntesDeSalvar = $this->record->status;
        $this->record->load('movimentacaoEstoque');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->validarEstoquePedido($data, $this->record);

        return $data;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (empty($data['produto_id'])) {
            $item = $this->record->itens()->first();

            if ($item) {
                $data['produto_id'] = $item->produto_id;
                $data['quantidade'] = $item->quantidade;
            }
        }

        $data['valor_total'] = $this->record->calcularValorTotal();

        return $data;
    }

    protected function afterSave(): void
    {
        $pedido = $this->record->fresh(['cliente', 'produto', 'movimentacaoEstoque']);

        $total = $pedido->calcularValorTotal();
        $pedido->updateQuietly(['valor_total' => $total]);

        Log::info('Auditoria: Pedido Comercial Editado e Atualizado', [
            'pedido_id' => $pedido->id,
            'novo_valor_total' => $total,
            'operador' => auth()->user()?->email ?? 'Sistema',
        ]);

        if ($pedido->status === 'Finalizado' && $this->statusAntesDeSalvar !== 'Finalizado') {
            PedidoEstoqueService::registrarSaida($pedido);
            $pedido->load('movimentacaoEstoque');

            Notification::make()
                ->title('Estoque atualizado')
                ->body('Movimentação de saída registrada e estoque do produto reduzido.')
                ->success()
                ->actions([
                    Action::make('ver')
                        ->label('Ver movimentação')
                        ->url(MovimentacaoEstoqueResource::getUrl('view', ['record' => $pedido->movimentacaoEstoque])),
                ])
                ->send();
        } elseif ($this->statusAntesDeSalvar === 'Finalizado' && $pedido->status !== 'Finalizado') {
            PedidoEstoqueService::cancelarSaida($pedido);
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
