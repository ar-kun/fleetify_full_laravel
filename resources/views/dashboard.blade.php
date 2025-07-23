<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <div class="flex items-start justify-start p-5">
                            <form id="attendance-form-in" action="{{ route('attendance.in') }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="employee_id" value="{{ auth()->user()->employee_id }}">
                                @php
                                    $isVisibleCheckIn = false;

                                    if ($attendance && $attendance->clock_in && $attendance->clock_in->isToday()) {
                                        $isVisibleCheckIn = true;
                                    }
                                @endphp
                                <button type="submit"
                                    class="text-white cursor-pointer {{ $isVisibleCheckIn ? 'bg-slate-400 focus:ring-4 focus:ring-slate-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-slate-600 dark:hover:bg-slate-700 focus:outline-none dark:focus:ring-slate-800' : 'bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800 shadow-[2px_2px_2px_1px_rgb(0_0_255_/_0.2)] hover:shadow-none' }}"
                                    {{ $isVisibleCheckIn ? 'disabled' : '' }}>
                                    <i class="fa-solid fa-clock"></i> Check In
                                </button>
                            </form>
                            <form id="attendance-form-out" action="{{ route('attendance.out') }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('POST')
                                @php
                                    $isVisibleCheckOut = false;

                                    if (
                                        !$attendance ||
                                        ($attendance && !$attendance->clock_in) ||
                                        ($attendance && $attendance->clock_out && $attendance->clock_out->isToday())
                                    ) {
                                        $isVisibleCheckOut = true;
                                    }
                                @endphp
                                <input type="hidden" name="employee_id" value="{{ auth()->user()->employee_id }}">
                                <input type="hidden" name="attendance_id"
                                    value="{{ $attendance->attendance_id ?? '' }}">
                                <button type="submit"
                                    class="text-white cursor-pointer {{ $isVisibleCheckOut ? 'bg-slate-400 focus:ring-4 focus:ring-slate-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-slate-600 dark:hover:bg-slate-700 focus:outline-none dark:focus:ring-slate-800' : 'bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800 shadow-[2px_2px_2px_1px_rgb(0_0_255_/_0.2)] hover:shadow-none' }}"
                                    {{ $isVisibleCheckOut ? 'disabled' : '' }}>
                                    <i class="fa-solid fa-clock"></i> Check Out
                                </button>
                            </form>
                        </div>
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
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
                                        {{ $item->employee->name ?? 'N/A' }}
                                    </th>
                                    <td class="px-6 py-4 text-center">
                                        {{ $item->attendance_type == \App\Models\AttendanceHistory::CHECK_IN ? 'Check In' : 'Check Out' }}
                                    </td>
                                    @php
                                        $maxClockInTime = $attendance->employee->department->max_clock_in_time;
                                        $maxClockOutTime = $attendance->employee->department->max_clock_out_time;
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
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
