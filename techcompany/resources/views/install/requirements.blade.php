@extends('install.layout')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Server Requirements</h2>

    <!-- PHP Requirements -->
    <div class="mb-8">
        <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center">
            <i class="fas fa-code text-purple-600 mr-2"></i>
            PHP Requirements
        </h3>
        <div class="space-y-2">
            @foreach($requirements as $key => $requirement)
                <div class="flex items-center justify-between p-3 rounded-lg {{ $requirement['status'] ? 'bg-green-50' : 'bg-red-50' }}">
                    <div class="flex items-center space-x-3">
                        <i class="fas {{ $requirement['status'] ? 'fa-check-circle text-green-500' : 'fa-times-circle text-red-500' }}"></i>
                        <span class="text-sm font-medium text-gray-700">{{ $requirement['name'] }}</span>
                        @if(isset($requirement['current']))
                            <span class="text-xs text-gray-500">(Current: {{ $requirement['current'] }})</span>
                        @endif
                    </div>
                    <span class="text-xs font-semibold {{ $requirement['status'] ? 'text-green-600' : 'text-red-600' }}">
                        {{ $requirement['status'] ? 'Installed' : 'Missing' }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Folder Permissions -->
    <div class="mb-8">
        <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center">
            <i class="fas fa-folder-open text-purple-600 mr-2"></i>
            Folder Permissions
        </h3>
        <div class="space-y-2">
            @foreach($permissions as $folder => $isWritable)
                <div class="flex items-center justify-between p-3 rounded-lg {{ $isWritable ? 'bg-green-50' : 'bg-red-50' }}">
                    <div class="flex items-center space-x-3">
                        <i class="fas {{ $isWritable ? 'fa-check-circle text-green-500' : 'fa-times-circle text-red-500' }}"></i>
                        <span class="text-sm font-medium text-gray-700">{{ $folder }}</span>
                    </div>
                    <span class="text-xs font-semibold {{ $isWritable ? 'text-green-600' : 'text-red-600' }}">
                        {{ $isWritable ? 'Writable' : 'Not Writable' }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Error Message if Requirements Not Met -->
    @if(!$allRequirementsMet || !$allPermissionsSet)
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Requirements Not Met</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <p>
                            Please fix the issues above before proceeding with the installation.
                            @if(!$allPermissionsSet)
                                <br><br>
                                <strong>To fix permissions, run:</strong>
                                <code class="bg-red-100 px-2 py-1 rounded block mt-2">
                                    chmod -R 775 storage bootstrap/cache
                                </code>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-500 text-xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-green-800">All Requirements Met!</h3>
                    <div class="mt-2 text-sm text-green-700">
                        <p>Your server meets all the requirements. You can proceed with the installation.</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Navigation Buttons -->
    <div class="flex justify-between pt-6">
        <a href="{{ route('install.index') }}" 
           class="inline-flex items-center px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg transition duration-200">
            <i class="fas fa-arrow-left mr-2"></i>
            Back
        </a>
        
        @if($allRequirementsMet && $allPermissionsSet)
            <a href="{{ route('install.database') }}" 
               class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-md transition duration-200">
                Continue
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        @else
            <button type="button" 
                    onclick="window.location.reload()"
                    class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-200">
                <i class="fas fa-sync-alt mr-2"></i>
                Recheck
            </button>
        @endif
    </div>
</div>
@endsection
