<?php

namespace App\Rules;

use App\Support\DocumentoBr;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\Model;

class DocumentoUnico implements ValidationRule
{
    public function __construct(
        protected string $modelClass,
        protected string $column,
        protected ?int $ignorarId = null,
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $digitos = DocumentoBr::apenasDigitos(is_string($value) ? $value : null);

        if ($digitos === null) {
            return;
        }

        /** @var Model $model */
        $model = new $this->modelClass;

        $existe = $model->newQuery()
            ->where($this->column, $digitos)
            ->when($this->ignorarId, fn ($query) => $query->where('id', '!=', $this->ignorarId))
            ->exists();

        if ($existe) {
            $fail('Este documento já está cadastrado no sistema.');
        }
    }
}
