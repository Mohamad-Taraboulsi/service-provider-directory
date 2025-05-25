<?php

declare(strict_types=1);

?>
@extends('layouts.app')

@section('title', $provider->name)

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-10">

        <div class="mb-6">
            <a href="{{ route('providers.index') }}" class="text-blue-600 hover:underline text-sm">
                ← Back to all providers
            </a>
        </div>

        <div class="w-full mb-6">
            <img src="{{ asset($provider->logo) }}" alt="{{ $provider->name }} logo"
                 class="w-full max-h-100 object-cover rounded-lg shadow" />
        </div>

        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $provider->name }}</h1>

        <div class="mb-4">
            <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
                {{ $provider->category->name }}
            </span>
        </div>

        <p class="text-gray-700 leading-relaxed">
            {{ $provider->description }}
        </p>

    </div>
@endsection
