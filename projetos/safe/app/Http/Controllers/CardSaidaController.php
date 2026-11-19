<?php

namespace App\Http\Controllers;

use App\Events\CardSaidaLiberado;
use App\Models\Aluno;
use App\Models\CardSaida;
use App\Services\CardSaidaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CardSaidaController extends Controller
{
    public function __construct(
        private CardSaidaService $cardSaidaService
    ) {}

    public function index(): View
    {
        $solicitacoes = CardSaida::with(['aluno.curso', 'diretor', 'liberadoPor'])
            ->latest()
            ->get();

        return view('solicitacoes.index', compact('solicitacoes'));
    }

    public function create(): View
    {
        return view('solicitacoes.create');
    }

    public function createSaida(): View
    {
        return view('solicitacoes.create-saida', $this->dadosFormulario());
    }

    public function createEntradaAtrasada(): View
    {
        return view('solicitacoes.create-entrada', $this->dadosFormulario());
    }

    public function storeSaida(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'aluno_id' => 'required|exists:alunos,id',
            'horario_saida' => 'required|date_format:H:i',
            'responsavel_autorizou' => 'required|string|max:255',
            'aulas_falta' => 'nullable|array',
            'aulas_falta.*' => 'integer|min:1|max:'.CardSaida::TOTAL_AULAS,
        ]);

        $aulasFalta = $this->normalizarAulas($validated['aulas_falta'] ?? []);
        $aluno = Aluno::with('curso')->findOrFail($validated['aluno_id']);

        $card = $this->cardSaidaService->criarSaida($aluno, [
            'horario_saida' => $validated['horario_saida'],
            'responsavel_autorizou' => $validated['responsavel_autorizou'],
            'qtd_faltas' => count($aulasFalta),
            'aulas_falta' => $aulasFalta,
        ], auth()->id());

        Log::info("SENAI - Saída criada: {$aluno->nome_completo}");

        return redirect()
            ->route('solicitacoes.index')
            ->with('success', 'Solicitação de saída registrada! Professor e porteiro foram notificados.');
    }

    public function storeEntradaAtrasada(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'aluno_id' => 'required|exists:alunos,id',
            'horario_entrada' => 'required|date_format:H:i',
            'responsavel_autorizou' => 'required|string|max:255',
            'aulas_falta' => 'required|array|min:1',
            'aulas_falta.*' => 'integer|min:1|max:'.CardSaida::TOTAL_AULAS,
        ], [
            'aulas_falta.required' => 'Selecione pelo menos uma aula com falta por causa da entrada.',
            'aulas_falta.min' => 'Selecione pelo menos uma aula com falta por causa da entrada.',
        ]);

        $aulasFalta = $this->normalizarAulas($validated['aulas_falta']);
        $aluno = Aluno::with('curso')->findOrFail($validated['aluno_id']);

        $this->cardSaidaService->criarEntradaAtrasada($aluno, [
            'horario_entrada' => $validated['horario_entrada'],
            'responsavel_autorizou' => $validated['responsavel_autorizou'],
            'qtd_faltas' => count($aulasFalta),
            'aulas_falta' => $aulasFalta,
        ], auth()->id());

        Log::info("SENAI - Entrada atrasada criada: {$aluno->nome_completo}");

        return redirect()
            ->route('solicitacoes.index')
            ->with('success', 'Entrada atrasada registrada! Professor e porteiro foram notificados.');
    }

    /** @deprecated Use storeSaida() */
    public function store(Request $request): RedirectResponse
    {
        return $this->storeSaida($request);
    }

    public function liberar(CardSaida $card): RedirectResponse
    {
        if (! $card->podeLiberar()) {
            return back()->with('error', 'Esta solicitação já foi liberada ou não está pendente.');
        }

        $card->update([
            'status' => CardSaida::STATUS_LIBERADO,
            'liberado_em' => now(),
            'liberado_por' => auth()->id(),
        ]);

        $card->load('aluno');
        CardSaidaLiberado::dispatch($card);

        $msg = $card->isEntradaAtrasada()
            ? 'Entrada liberada com sucesso!'
            : 'Saída liberada com sucesso!';

        Log::info("SENAI - Solicitação liberada: {$card->aluno->nome_completo} ({$card->tipo})");

        return back()->with('success', $msg);
    }

    private function dadosFormulario(): array
    {
        return [
            'alunos' => Aluno::query()->with('curso')->orderBy('nome_completo')->get(),
            'totalAulas' => CardSaida::TOTAL_AULAS,
        ];
    }

    private function normalizarAulas(array $aulas): array
    {
        return collect($aulas)
            ->map(fn ($a) => (int) $a)
            ->unique()
            ->sort()
            ->values()
            ->all();
    }
}
