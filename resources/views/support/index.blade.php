<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Support') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="" action="" enctype="multipart/form-data">
                    @csrf

                    <div class="mt-4">
                        <select name="department" class="form-select" data-control="select2" id="department_input"
                            aria-label="Default select example" data-allow-clear="true"
                            data-url="{{ route('ajax.employee') }}">
                            <option value="0" selected>Select Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mt-4">
                        <select name="employee" class="form-select" data-control="select2"
                            aria-label="Default select example" data-allow-clear="true" id="employee-input">
                        </select>
                    </div>


                    <div class="flex items-center justify-center mt-4">
                        <x-primary-button
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Submit') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
        $(document).on('change', '#department_input', function() {
        let departmentId = $(this).val();

        $('#employee-input').select2({
            placeholder: "Select Employee",
            allowClear: true,
            ajax: {
                url: $(this).data('url'),
                dataType: 'json',
                delay: 250, // Add delay to prevent excessive requests
                data: function (params) {
                    return {
                        department_id: departmentId, // Passing the department ID
                        search: params.term // Search term
                    };
                },
                processResults: function (data) {   
                    return {
                        results: $.map(data, function (item) {
                            return {
                                id: item.id,
                                text: item.name
                            };
                        })
                    };
                },
                cache: true
            }
        });
    });
</script>
    @endsection

</x-app-layout>
