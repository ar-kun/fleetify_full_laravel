<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Department') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form method="POST" action="{{ route('departments.update', $department->id) }}">
                    @csrf
                    @method('PUT')

                  <!-- department_name -->
                  <div>
                      <x-input-label for="department_name" :value="__('Department Name')" />
                      <x-text-input id="department_name" class="block mt-1 w-full" type="text" name="department_name" :value="old('department_name', $department->department_name)" required autofocus />
                      <x-input-error :messages="$errors->get('department_name')" class="mt-2" />
                  </div>

                  <div class="flex space-y-4 gap-5">
                    <!-- max_clock_in_time -->
                    <div class="mt-4 w-full">
                        <x-input-label for="max_clock_in_time" :value="__('Max Clock In Time')" />
                        <x-text-input id="max_clock_in_time" class="block mt-1 w-full" type="time" name="max_clock_in_time" :value="old('max_clock_in_time', $department->max_clock_in_time)" required />
                        <x-input-error :messages="$errors->get('max_clock_in_time')" class="mt-2" />
                    </div>

                    {{-- max_clock_out_time --}}
                    <div class="mt-4 w-full">
                        <x-input-label for="max_clock_out_time" :value="__('Max Clock Out Time')" />
                        <x-text-input id="max_clock_out_time" class="block mt-1 w-full" type="time" name="max_clock_out_time" :value="old('max_clock_out_time', $department->max_clock_out_time)" required />
                        <x-input-error :messages="$errors->get('max_clock_out_time')" class="mt-2" />
                    </div>
                  </div>

                  <div class="flex items-center justify-end mt-4">
                      <x-primary-button class="ms-3 cursor-pointer">
                          {{ __('Update Department') }}
                      </x-primary-button>
                  </div>
              </form>
            </div>
        </div>
    </div>
</x-app-layout>