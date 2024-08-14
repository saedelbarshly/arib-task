<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('task.update', ['task' => $task->id]) }}">
                    @method('PUT')
                    @csrf
                    <div class="mb-6">
                        <x-input-label for="name" :value="__('Task Name')"
                            class="block text-gray-700 text-sm font-bold mb-2" />
                        <x-text-input id="name" value="{{ $task->name }}"
                            class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-green-200 focus:border-green-500"
                            type="text" name="name" required autofocus autocomplete="name"
                            placeholder="Enter Task Name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600" />
                    </div>

                    <div class="mt-4">
                        <select name="employee_id" class="form-select" aria-label="Default select example">
                            <option selected>assigned to</option>
                            @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}" {{ $employee->id == $task->employee_id ? 'selected' : '' }}>
                                {{ $employee->name }}</option>
                        @endforeach
                        </select>
                    </div>

                    <div class="flex items-center justify-center">
                        <x-primary-button
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Submit') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
