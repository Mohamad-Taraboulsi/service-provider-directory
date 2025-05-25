<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Services\ProviderService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProviderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Could use 'exists:categories,name' but i can benefit from minimizing queries for later functions
        $categoryNames = (new ProviderService)->getCategories()->pluck('name')->toArray();
        $validCategories = array_merge(['all'], $categoryNames);

        return [
            'category' => ['string', Rule::in($validCategories)],
        ];
    }
}
