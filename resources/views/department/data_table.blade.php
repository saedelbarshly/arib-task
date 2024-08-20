@foreach ($departments as $department)               
<tr>
    <td class="border px-4 py-2">
        {{ ($departments->currentPage() - 1) * $departments->perPage() + $loop->iteration }}
    </td>
  <td class="border px-4 py-2">{{ $department->name }}</td>
  <td class="border px-4 py-2">{{ $department->employees()->count() }}</td>
  <td class="border px-4 py-2">
    <div class="d-flex justify-content-center mt-4">
        <a href="{{ route('department.edit', ['department' => $department->id]) }}" 
           class="font-bold py-2 text-white px-4 rounded" style="background-color: blue;">
           Edit
        </a>
        <a href="#" 
        class="font-bold py-2 text-white px-4 rounded bg-danger delete-department" 
        style="background-color: red;" 
        data-department-id="{{ $department->id }}" 
        data-employee-count="{{ $department->employees()->count() }}">
        Delete
     </a>
    </div>
</td>
</tr>
@endforeach

{{ $departments->links() }}

