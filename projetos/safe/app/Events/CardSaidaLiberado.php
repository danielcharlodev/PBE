<?php

namespace App\Events;

use App\Models\CardSaida;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CardSaidaLiberado
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public CardSaida $card
    ) {}
}
