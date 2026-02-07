@extends('install.layout')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-8">
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-purple-100 rounded-full mb-4">
            <i class="fas fa-rocket text-4xl text-purple-600"></i>
        </div>
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Welcome to {{ config('app.name', 'Qoritex') }}</h2>
        <p class="text-gray-600">Let's get your application up and running!</p>
    </div>

    <div class="space-y-6">
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-500 text-xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Before You Begin</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <p>Please ensure you have the following ready:</p>
                        <ul class="list-disc list-inside mt-2 space-y-1">
                            <li>Database name, username, and password</li>
                            <li>Write permissions for storage and cache directories</li>
                            <li>PHP 8.1 or higher installed</li>
                            <li>Required PHP extensions enabled</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="border border-gray-200 rounded-lg p-6">
                <div class="flex items-start space-x-3">
                    <i class="fas fa-bolt text-yellow-500 text-2xl mt-1"></i>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-2">Quick Installation</h3>
                        <p class="text-sm text-gray-600">
                            The installer will guide you through setting up your database, 
                            creating an admin account, and configuring your application.
                        </p>
                    </div>
                </div>
            </div>

            <div class="border border-gray-200 rounded-lg p-6">
                <div class="flex items-start space-x-3">
                    <i class="fas fa-shield-alt text-green-500 text-2xl mt-1"></i>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-2">Secure Setup</h3>
                        <p class="text-sm text-gray-600">
                            All credentials are securely stored in your environment file. 
                            Database connection is tested before proceeding.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-yellow-400 text-xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-yellow-800">Important Note</h3>
                    <div class="mt-2 text-sm text-yellow-700">
                        <p>
                            This installer will modify your <code class="bg-yellow-100 px-1 rounded">.env</code> file 
                            and run database migrations. Please ensure you have backed up any existing data.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end pt-6">
            <a href="{{ route('install.requirements') }}" 
               class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-md transition duration-200">
                Get Started
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</div>
@endsection
