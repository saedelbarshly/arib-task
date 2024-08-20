@foreach ($employees as $employee)               
<tr>
  <td>
      {{ ($employees->currentPage() - 1) * $employees->perPage() + $loop->iteration }}
  </td>
  <td class="border px-4 py-2">{{ $employee->name }}</td>
  <td class="border px-4 py-2">{{ $employee->salary }}</td>
  <td class="border px-4 py-2"><img src="{{ asset("images/$employee->image") }}" alt="image" width="70" hight="70"/></td>
  <td class="border px-4 py-2">{{ $employee->phone }}</td>
  <td class="border px-4 py-2">{{ $employee->email }}</td>
  <td class="border px-4 py-2">{{ $employee?->department?->name }}</td>
  <td class="border px-4 py-2">
    <div class="d-flex justify-content-center mt-4">
        <a href="{{ route('employee.show', ['employee' => $employee->id]) }}" 
            class="font-bold py-2 text-white px-4 rounded" style="background-color:#d1ae2c;">
            view Tasks
         </a>
        <a href="{{ route('employee.edit', ['employee' => $employee->id]) }}" 
           class="font-bold py-2 text-white px-4 rounded" style="background-color: blue;">
           Edit
        </a>
        <a href="{{ route('employee.delete', ['employee' => $employee->id]) }}" 
           class="font-bold py-2 text-white px-4 rounded bg-danger" style="background-color: red;">
           Delete
        </a>
    </div>
</td>
</tr>
@endforeach

{{ $employees->links() }}
