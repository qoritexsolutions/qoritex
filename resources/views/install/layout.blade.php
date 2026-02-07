<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation Wizard - {{ config('app.name', 'Qoritex') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="gradient-bg text-white py-6 shadow-lg">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-cog fa-spin text-3xl"></i>
                        <h1 class="text-2xl font-bold">Installation Wizard</h1>
                    </div>
                    <div class="text-sm opacity-90">
                        {{ config('app.name', 'Qoritex') }}
                    </div>
                </div>
            </div>
        </header>

        <!-- Progress Steps -->
        <div class="bg-white border-b border-gray-200 py-4">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-center space-x-4">
                    @php
                        $steps = [
                            ['route' => 'install.index', 'label' => 'Welcome', 'icon' => 'fa-flag'],
                            ['route' => 'install.requirements', 'label' => 'Requirements', 'icon' => 'fa-list-check'],
                            ['route' => 'install.database', 'label' => 'Database', 'icon' => 'fa-database'],
                            ['route' => 'install.admin', 'label' => 'Admin Account', 'icon' => 'fa-user-shield'],
                            ['route' => 'install.complete', 'label' => 'Complete', 'icon' => 'fa-check-circle'],
                        ];
                        $currentStep = request()->route()->getName();
                    @endphp

                    @foreach($steps as $index => $step)
                        <div class="flex items-center">
                            <div class="flex flex-col items-center">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $currentStep === $step['route'] ? 'bg-purple-600 text-white' : (array_search($step, $steps) < array_search(collect($steps)->firstWhere('route', $currentStep), $steps) ? 'bg-green-500 text-white' : 'bg-gray-300 text-gray-600') }}">
                                    <i class="fas {{ $step['icon'] }}"></i>
                                </div>
                                <span class="text-xs mt-2 {{ $currentStep === $step['route'] ? 'text-purple-600 font-semibold' : 'text-gray-500' }}">
                                    {{ $step['label'] }}
                                </span>
                            </div>
                            @if(!$loop->last)
                                <div class="w-16 h-0.5 {{ array_search($step, $steps) < array_search(collect($steps)->firstWhere('route', $currentStep), $steps) ? 'bg-green-500' : 'bg-gray-300' }} mx-2"></div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1 py-12">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl mx-auto">
                    @yield('content')
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-6">
            <div class="container mx-auto px-4 text-center">
                <p class="text-sm opacity-75">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Qoritex') }}. All rights reserved.
                </p>
            </div>
        </footer>
    </div>
</body>
</html>
