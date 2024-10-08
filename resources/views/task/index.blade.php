<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between mt-4">
                    <input type="text" placeholder="Search task name" name="search" id="search" class="border p-2">
                    <a href="{{ route('task.create') }}" 
                       class="font-bold py-2 text-white px-4 rounded" style="background-color: green">
                       Create Task
                    </a>
                </div>
                <div class="mt-6">
                    <table class="table-auto w-full text-center">
                        <thead>
                            <tr class="bg-gray-200">
                                <th scope="col" class="px-4 py-2">Id</th>
                                <th scope="col" class="px-4 py-2">Name</th>
                                <th scope="col" class="px-4 py-2">Assign to</th>
                                <th scope="col" class="px-4 py-2">Status</th>
                                <th scope="col" class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be loaded here via AJAX -->
                        </tbody>
                    </table>
                    <div id="pagination-links" class="mt-4">
                        <!-- Pagination links will be loaded here via AJAX -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function fetch_data(page, query) {
                $.ajax({
                    url: "{{ route('task.data') }}",
                    method: 'GET',
                    data: {
                        page: page,
                        query: query
                    },
                    success: function(response) {
                        $('tbody').html(response.data);
                        $('#pagination-links').html(response.links);
                    }
                });
            }

            fetch_data(1, '');

            $('#search').on('keyup', function() {
                let query = $(this).val();
                fetch_data(1, query);
            });

            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                let query = $('#search').val();
                fetch_data(page, query);
            });
        });
    </script>
    @endsection
</x-app-layout>
