@extends('install.layout')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-8">
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-4 animate-bounce">
            <i class="fas fa-check-circle text-5xl text-green-500"></i>
        </div>
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Installation Complete!</h2>
        <p class="text-gray-600">Your application is ready to use</p>
    </div>

    <div class="space-y-6">
        <div class="bg-green-50 border-l-4 border-green-500 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-500 text-xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-green-800">Success!</h3>
                    <div class="mt-2 text-sm text-green-700">
                        <p>The installation has been completed successfully. Your application is now configured and ready to use.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="border-2 border-purple-200 rounded-lg p-6 hover:border-purple-400 transition">
                <div class="flex items-start space-x-3">
                    <i class="fas fa-globe text-purple-500 text-2xl mt-1"></i>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-2">Visit Your Site</h3>
                        <p class="text-sm text-gray-600 mb-3">
                            Check out your newly installed application and see if everything looks good.
                        </p>
                        <a href="{{ url('/') }}" 
                           class="inline-flex items-center text-sm text-purple-600 hover:text-purple-700 font-semibold">
                            Go to Homepage
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-2 border-blue-200 rounded-lg p-6 hover:border-blue-400 transition">
                <div class="flex items-start space-x-3">
                    <i class="fas fa-user-shield text-blue-500 text-2xl mt-1"></i>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-2">Admin Dashboard</h3>
                        <p class="text-sm text-gray-600 mb-3">
                            Login to your admin panel and start managing your application.
                        </p>
                        <a href="{{ url('/login') }}" 
                           class="inline-flex items-center text-sm text-blue-600 hover:text-blue-700 font-semibold">
                            Go to Admin Login
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-blue-50 border-l-4 border-blue-500 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-lightbulb text-blue-500 text-xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Next Steps</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <ul class="list-disc list-inside space-y-1">
                            <li>Configure your application settings in the admin panel</li>
                            <li>Set up your email configuration in the <code class="bg-blue-100 px-1 rounded">.env</code> file</li>
                            <li>Install SSL certificate for secure HTTPS connection</li>
                            <li>Set up regular backups for your database</li>
                            <li>Review security settings and permissions</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-shield-alt text-yellow-400 text-xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-yellow-800">Important Security Note</h3>
                    <div class="mt-2 text-sm text-yellow-700">
                        <p>
                            For security reasons, it's recommended to delete or restrict access to the <code class="bg-yellow-100 px-1 rounded">install</code> 
                            folder after installation is complete. The installation files have been locked to prevent re-installation.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-200 pt-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-3 flex items-center">
                <i class="fas fa-info-circle text-gray-500 mr-2"></i>
                Installation Summary
            </h3>
            <div class="grid md:grid-cols-2 gap-4 text-sm">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-check text-green-500"></i>
                    <span>Environment configured</span>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-check text-green-500"></i>
                    <span>Database tables created</span>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-check text-green-500"></i>
                    <span>Admin account created</span>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-check text-green-500"></i>
                    <span>Application optimized</span>
                </div>
            </div>
        </div>

        <div class="flex justify-center pt-6 space-x-4">
            <a href="{{ url('/') }}" 
               class="inline-flex items-center px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg transition duration-200">
                <i class="fas fa-home mr-2"></i>
                Visit Site
            </a>
            
            <a href="{{ url('/login') }}" 
               class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-md transition duration-200">
                <i class="fas fa-sign-in-alt mr-2"></i>
                Admin Login
            </a>
        </div>
    </div>
</div>
@endsection
