<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ProviderRequest;
use App\Models\Provider;
use App\Services\ProviderService;

class ProviderController extends Controller
{
    public function index(ProviderRequest $providerRequest, ProviderService $providerService)
    {
        $categoryName = $providerRequest->validated('category', 'all');

        $categories = $providerService->getCategories();
        $providers = $providerService->getProvidersByCategory($categoryName);

        return view('providersPage', ['providers' => $providers, 'categories' => $categories]);
    }

    public function show(Provider $provider)
    {
        $provider->load('category');

        return view('providerProfile', ['provider' => $provider]);
    }
}
