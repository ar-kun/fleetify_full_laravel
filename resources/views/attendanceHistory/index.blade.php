<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Attendance History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="w-full">
                    <div class="relative overflow-x-auto sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <div class="flex items-center justify-between p-5">
                                <div class="pb-4 bg-white dark:bg-gray-900">
                                    <form method="GET" action="{{ route('attendance.history') }}" class="mb-4">
                                        <div class="relative mt-1">
                                            <div
                                                class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                                </svg>
                                            </div>
                                            <input type="text" name="search" id="table-search"
                                                value="{{ request('search') }}"
                                                class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                                                placeholder="Search for employees...">
                                        </div>
                                    </form>
                                </div>
                                <div class="pb-4 bg-white dark:bg-gray-900 flex gap-5">
                                    <form method="GET" action="{{ route('attendance.history') }}"
                                        class="flex gap-4 items-end mb-6">
                                        <div>
                                            {{-- department_id  --}}
                                            <select id="department_id" name="department_id"
                                                class="block w-full text-slate-700 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option value="" selected>All department</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}" class="text-slate-800"
                                                        @selected(request('department_id') == $department->id)>
                                                        {{ $department->department_name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
                                        </div>

                                        {{-- date_attendance --}}
                                        <div>
                                            <input type="date" name="date_attendance" id="date_attendance"
                                                value="{{ request('date_attendance') }}"
                                                class="block w-full text-slate-700 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <x-input-error :messages="$errors->get('date_attendance')" class="mt-2" />
                                        </div>

                                        <div>
                                            <button type="submit"
                                                class="px-4 py-2 bg-blue-600 text-white rounded-md cursor-pointer">Filter</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Department Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Type
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendanceHistory as $item)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->employee->department->department_name ?? 'N/A' }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->employee->name ?? 'N/A' }}
                                        </th>
                                        <td class="px-6 py-4 text-center">
                                            {{ $item->attendance_type == \App\Models\AttendanceHistory::CHECK_IN ? 'Check In' : 'Check Out' }}
                                        </td>
                                        @php
                                            $maxClockInTime = $item->employee->department->max_clock_in_time;
                                            $maxClockOutTime = $item->employee->department->max_clock_out_time;
                                        @endphp
                                        <td class="px-6 py-4 text-center">
                                            {!! $item->attendance_type == \App\Models\AttendanceHistory::CHECK_IN
                                                ? ($item->date_attendance->format('H:i:s') <= $maxClockInTime
                                                    ? '<span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">On Time</span>'
                                                    : '<span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-yellow-900 dark:text-yellow-300">Late</span>')
                                                : ($item->date_attendance->format('H:i:s') <= $maxClockOutTime
                                                    ? '<span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-yellow-900 dark:text-yellow-300">Early</span>'
                                                    : '<span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">On Time / Overtime</span>') !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            @if ($attendanceHistory->hasPages())
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="px-6 py-4">
                                            {{ $attendanceHistory->links() }}
                                        </td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
