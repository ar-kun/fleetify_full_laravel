<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Department') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="mt-4 grid grid-cols-2 gap-6">
                    <p><strong>{{ __('Name:') }}</strong> {{ $employee->name }}</p>
                    <p><strong>{{ __('Department:') }}</strong> {{ $employee->department->department_name ?? 'N/A' }}</p>
                    <p><strong>{{ __('Address:') }}</strong> {{ $employee->address }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
