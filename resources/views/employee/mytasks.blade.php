<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <span>
                <img src="{{ asset("images/$employee->image") }}" alt="image" width="40" hight="40" />
            </span>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $employee->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center mt-4">

                </div>
                <div class="mt-6">
                    <table class="table-auto w-full text-center">
                        <thead>
                            <tr class="bg-gray-200">
                                <th scope="col" class="px-4 py-2">Id</th>
                                <th scope="col" class="px-4 py-2">Task</th>
                                <th scope="col" class="px-4 py-2">Status</th>
                                <th scope="col" class="px-4 py-2">Action</th>
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
                                    <td class="border px-4 py-2">
                                        <div class="d-flex justify-content-center mt-3">
                                            <a href="#" class="font-bold py-2 text-white px-4 rounded"
                                                style="background-color:#2cd153;" data-bs-toggle="modal"
                                                data-bs-target="#statusModal" data-task-id="{{ $task->id }}">
                                                Change Status
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Change Task Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="statusForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="task_id" id="taskId">
                        <select name="status" class="form-select" aria-label="Default select example">
                            <option value="pending" selected>Pending</option>
                            <option value="start">Start</option>
                            <option value="done">Done</option>
                        </select>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    @section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const statusModal = document.getElementById('statusModal');
            const statusForm = document.getElementById('statusForm');

            statusModal.addEventListener('show.bs.modal', (event) => {
                const button = event.relatedTarget;
                const taskId = button.getAttribute('data-task-id');
                statusForm.action = `{{ route('change.status', ':task') }}`.replace(':task', taskId);
                document.getElementById('taskId').value = taskId;
            });

            document.getElementById('saveChanges').addEventListener('click', () => {
                statusForm.submit();
            });
        });
    </script>
@endsection


</x-app-layout>
