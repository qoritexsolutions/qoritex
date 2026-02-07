@extends('install.layout')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-2">Create Admin Account</h2>
    <p class="text-gray-600 mb-6">Set up your application and create the administrator account</p>

    @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Error</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('install.process') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Application Settings -->
        <div class="border-b border-gray-200 pb-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center">
                <i class="fas fa-cog text-purple-600 mr-2"></i>
                Application Settings
            </h3>

            <div class="space-y-4">
                <!-- Application Name -->
                <div>
                    <label for="app_name" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-tag text-gray-400 mr-1"></i>
                        Application Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="app_name" 
                           name="app_name" 
                           value="{{ old('app_name', 'Qoritex') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           placeholder="Your Application Name"
                           required>
                </div>

                <!-- Application URL -->
                <div>
                    <label for="app_url" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-link text-gray-400 mr-1"></i>
                        Application URL <span class="text-red-500">*</span>
                    </label>
                    <input type="url" 
                           id="app_url" 
                           name="app_url" 
                           value="{{ old('app_url', request()->getSchemeAndHttpHost()) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           placeholder="https://yourdomain.com"
                           required>
                    <p class="text-xs text-gray-500 mt-1">The URL where your application will be accessible</p>
                </div>
            </div>
        </div>

        <!-- Admin Account -->
        <div>
            <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center">
                <i class="fas fa-user-shield text-purple-600 mr-2"></i>
                Administrator Account
            </h3>

            <div class="space-y-4">
                <!-- Admin Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user text-gray-400 mr-1"></i>
                        Full Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           placeholder="John Doe"
                           required>
                </div>

                <!-- Admin Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope text-gray-400 mr-1"></i>
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           placeholder="admin@yourdomain.com"
                           required>
                </div>

                <!-- Admin Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock text-gray-400 mr-1"></i>
                        Password <span class="text-red-500">*</span>
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           placeholder="Enter a strong password"
                           required>
                    <p class="text-xs text-gray-500 mt-1">Minimum 8 characters</p>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock text-gray-400 mr-1"></i>
                        Confirm Password <span class="text-red-500">*</span>
                    </label>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           placeholder="Re-enter your password"
                           required>
                </div>
            </div>
        </div>

        <div class="bg-blue-50 border-l-4 border-blue-500 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-500 text-xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">What Happens Next?</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <p>When you click "Install Application", we will:</p>
                        <ul class="list-disc list-inside mt-2 space-y-1">
                            <li>Generate your application encryption key</li>
                            <li>Run database migrations to create tables</li>
                            <li>Create your administrator account</li>
                            <li>Optimize and cache your application configuration</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between pt-6">
            <a href="{{ route('install.database') }}" 
               class="inline-flex items-center px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Back
            </a>
            
            <button type="submit" 
                    class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition duration-200">
                <i class="fas fa-rocket mr-2"></i>
                Install Application
            </button>
        </div>
    </form>
</div>

<script>
    // Show loading state when form is submitted
    document.querySelector('form').addEventListener('submit', function() {
        const button = this.querySelector('button[type="submit"]');
        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Installing...';
    });
</script>
@endsection
