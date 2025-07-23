<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Department') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="mt-4 grid grid-cols-2 gap-6 text-center">
                    <p><strong>{{ __('Department Name:') }}</strong> {{ $department->department_name }}</p>
                    <p><strong>{{ __('Created At:') }}</strong> {{ $department->created_at->format('Y-m-d H:i:s') }}</p>
                    <p><strong>{{ __('Max Clock In Time:') }}</strong> {{ $department->max_clock_in_time }}</p>
                    <p><strong>{{ __('Max Clock Out Time:') }}</strong> {{ $department->max_clock_out_time }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
