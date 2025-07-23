<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-end">
                    <form id="attendance-form-in"
                        action="{{ route('attendance.in') }}"
                        method="POST" style="display: inline;">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="employee_id" value="{{ auth()->user()->employee_id }}">
                        <button type="submit"
                            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800 shadow-[2px_2px_2px_1px_rgb(0_0_255_/_0.2)] hover:shadow-none cursor-pointer">
                            <i class="fa-solid fa-clock"></i> Check In
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
