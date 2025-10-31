<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Message -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-semibold mb-2">Welcome back, {{ Auth::user()->name }}!</h3>
                    <p class="text-gray-600">
                        You are logged in as 
                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ Auth::user()->isSuperUser() ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ Auth::user()->role?->name ?? 'No Role' }}
                        </span>
                    </p>
                </div>
            </div>

            @if(Auth::user()->isSuperUser())
                <!-- Admin Quick Links -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="p-3 bg-indigo-500 rounded-full">
                                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h4 class="text-lg font-semibold text-gray-900">User Management</h4>
                                    <p class="text-gray-600 text-sm">Manage system users and their accounts</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Manage Users
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="p-3 bg-green-500 rounded-full">
                                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h4 class="text-lg font-semibold text-gray-900">Role Management</h4>
                                    <p class="text-gray-600 text-sm">Manage user roles and permissions</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('admin.roles.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Manage Roles
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Regular User Message -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <p class="text-lg">You have view-only access to this application.</p>
                        <p class="text-gray-600 mt-2">Contact your administrator if you need additional permissions.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
