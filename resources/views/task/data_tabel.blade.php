@foreach ($tasks as $task)               
<tr>
    <td class="border px-4 py-2">
        {{ $loop->iteration }}
    </td>
  <td class="border px-4 py-2">{{ $task->name }}</td>
  <td class="border px-4 py-2">{{ $task->employee->name ?? 'Not Assigned yet' }}</td>
  <td class="border px-4 py-2">{{ $task->status }}</td>
  <td class="border px-4 py-2">
    <div class="d-flex justify-content-center mt-4">
        <a href="{{ route('task.edit', ['task' => $task->id]) }}" 
           class="font-bold py-2 text-white px-4 rounded" style="background-color: blue;">
           Edit
        </a>
    </div>
</td>
</tr>
@endforeach
