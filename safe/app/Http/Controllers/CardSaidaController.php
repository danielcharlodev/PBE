<?php

namespace App\Http\Controllers;

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
        $cards = CardSaida::with(['aluno', 'diretor', 'liberadoPor'])
            ->latest()
            ->get();

        return view('cards.index', compact('cards'));
    }

    public function create(): View
    {
        $alunos = Aluno::query()->orderBy('nome_completo')->get();

        return view('cards.create', [
            'alunos' => $alunos,
            'totalAulas' => CardSaida::TOTAL_AULAS,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'aluno_id' => 'required|exists:alunos,id',
            'horario_saida' => 'required|date_format:H:i',
            'responsavel_autorizou' => 'required|string|max:255',
            'aulas_falta' => 'nullable|array',
            'aulas_falta.*' => 'integer|min:1|max:'.CardSaida::TOTAL_AULAS,
        ]);

        $aulasFalta = collect($validated['aulas_falta'] ?? [])
            ->map(fn ($a) => (int) $a)
            ->unique()
            ->sort()
            ->values()
            ->all();

        $aluno = Aluno::findOrFail($validated['aluno_id']);

        $card = $this->cardSaidaService->criar($aluno, [
            'horario_saida' => $validated['horario_saida'],
            'responsavel_autorizou' => $validated['responsavel_autorizou'],
            'qtd_faltas' => count($aulasFalta),
            'aulas_falta' => $aulasFalta,
        ], auth()->id());

        Log::info("SAFE - Card de saída criado: {$aluno->nome_completo} às {$card->horario_saida}");

        return redirect()
            ->route('cards.index')
            ->with('success', 'Card de saída criado! Professor e portaria foram notificados.');
    }

    public function liberar(CardSaida $card): RedirectResponse
    {
        if (! $card->podeLiberar()) {
            return back()->with('error', 'Este aluno já foi liberado ou não possui card ativo.');
        }

        $card->update([
            'status' => CardSaida::STATUS_LIBERADO,
            'liberado_em' => now(),
            'liberado_por' => auth()->id(),
        ]);

        Log::info("SAFE - Aluno liberado na portaria: {$card->aluno->nome_completo}");

        return back()->with('success', 'Aluno liberado no portão com sucesso!');
    }
}
