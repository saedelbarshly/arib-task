<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee Tasks') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
              <div class="flex items-center mt-4">
                <div class="flex align-middle">
                    <span>
                        <img src="{{ asset("images/$employee->image") }}" alt="image" width="40" hight="40"/>
                    </span>
                    <span>
                      {{ $employee->name }}</span>
                </div>
              </div>
              <div class="mt-6">
                  <table class="table-auto w-full text-center">
                      <thead>
                        <tr class="bg-gray-200">
                          <th scope="col" class="px-4 py-2">Id</th>
                          <th scope="col" class="px-4 py-2">Task</th>
                          <th scope="col" class="px-4 py-2">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($employee->tasks as $task)               
                        <tr>
                            <td class="border px-4 py-2">
                                {{ $loop->iteration }}
                            </td>
                          <td class="border px-4 py-2">{{ $task->name }}</td>
                          <td class="border px-4 py-2">{{ $task->status }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
              </div>
          </div>
      </div>
  </div>

  </x-app-layout>
  