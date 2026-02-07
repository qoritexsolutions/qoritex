@extends('install.layout')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-2">Database Configuration</h2>
    <p class="text-gray-600 mb-6">Enter your database connection details</p>

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

    <form action="{{ route('install.database.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-500 text-xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Database Setup</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <p>Make sure you have created a MySQL database before proceeding. You'll need:</p>
                        <ul class="list-disc list-inside mt-2 space-y-1">
                            <li>Database name</li>
                            <li>Database username</li>
                            <li>Database password (if any)</li>
                            <li>Database host (usually <code class="bg-blue-100 px-1 rounded">localhost</code>)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Database Host -->
            <div>
                <label for="db_host" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-server text-gray-400 mr-1"></i>
                    Database Host <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="db_host" 
                       name="db_host" 
                       value="{{ old('db_host', 'localhost') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                       placeholder="localhost"
                       required>
            </div>

            <!-- Database Port -->
            <div>
                <label for="db_port" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-network-wired text-gray-400 mr-1"></i>
                    Database Port <span class="text-red-500">*</span>
                </label>
                <input type="number" 
                       id="db_port" 
                       name="db_port" 
                       value="{{ old('db_port', '3306') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                       placeholder="3306"
                       required>
            </div>
        </div>

        <!-- Database Name -->
        <div>
            <label for="db_name" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-database text-gray-400 mr-1"></i>
                Database Name <span class="text-red-500">*</span>
            </label>
            <input type="text" 
                   id="db_name" 
                   name="db_name" 
                   value="{{ old('db_name') }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                   placeholder="qoritex_db"
                   required>
        </div>

        <!-- Database Username -->
        <div>
            <label for="db_username" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-user text-gray-400 mr-1"></i>
                Database Username <span class="text-red-500">*</span>
            </label>
            <input type="text" 
                   id="db_username" 
                   name="db_username" 
                   value="{{ old('db_username') }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                   placeholder="root"
                   required>
        </div>

        <!-- Database Password -->
        <div>
            <label for="db_password" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-key text-gray-400 mr-1"></i>
                Database Password
            </label>
            <input type="password" 
                   id="db_password" 
                   name="db_password" 
                   value="{{ old('db_password') }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                   placeholder="Leave empty if no password">
        </div>

        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-lightbulb text-yellow-400 text-xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-yellow-800">Tip</h3>
                    <div class="mt-2 text-sm text-yellow-700">
                        <p>We will test your database connection before proceeding to ensure everything is configured correctly.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between pt-6">
            <a href="{{ route('install.requirements') }}" 
               class="inline-flex items-center px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Back
            </a>
            
            <button type="submit" 
                    class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-md transition duration-200">
                <i class="fas fa-plug mr-2"></i>
                Test Connection & Continue
            </button>
        </div>
    </form>
</div>
@endsection
