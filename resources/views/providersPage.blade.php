<?php

declare(strict_types=1);

?>
@extends('layouts.app')

@section('title', 'Providers')

@section('content')

    <body class="bg-gray-50 text-gray-900">

        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold text-center mb-8">Service Providers</h1>

            <form method="GET" class="mb-6 flex justify-center">
                <select name="category" onchange="this.form.submit()"
                    class="block w-full max-w-xs px-4 py-2 rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="all">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->name }}"
                            {{ request('category') === $category->name ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </form>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($providers as $provider)
                    <a href="{{ route('providers.show', $provider) }}"
                        class="group relative block bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                        <img src="{{ asset($provider->logo) }}" alt="{{ $provider->name }} logo"
                            class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300"
                            loading="lazy">
                        <div class="p-4">
                            <h2 class="text-xl font-semibold text-blue-800 mb-2 group-hover:underline">
                                {{ $provider->name }}
                            </h2>
                            <p class="text-gray-600 text-sm mb-3">
                                {{ Str::limit($provider->description, 100) }}
                            </p>
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded">
                                {{ $provider->category->name }}
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>

    </body>
@endsection
