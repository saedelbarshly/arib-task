<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('employee.update',['employee' => $employee->id]) }}"  enctype="multipart/form-data">
                    @method('PUT')
                    @csrf    
                        <div>
                            <x-input-label for="first_name" :value="__('First Name')" class="block text-gray-700 text-sm font-bold mb-2" />
                            <x-text-input id="first_name" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-green-200 focus:border-green-500" 
                                          type="text" name="first_name" value="{{ $first_name }}" required autofocus autocomplete="first_name" placeholder="Enter first Name"/>
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2 text-red-600" />
                        </div>
    
                        <div>
                            <x-input-label for="last_name" :value="__('Last Name')" class="block text-gray-700 text-sm font-bold mb-2" />
                            <x-text-input id="last_name" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-green-200 focus:border-green-500" 
                                          type="text" name="last_name" value="{{ $last_name}}" required autofocus autocomplete="last_name" placeholder="Enter last Name"/>
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2 text-red-600" />
                        </div>
                
    
                    <div class="mt-4">
                        <select name="department_id" class="form-select" aria-label="Default select example">
                            <option value="0" selected>Select Department</option>
                            @foreach ($departments as $department)
                            <option value="{{ $department->id }}" {{ $department->id == $employee->department_id ? 'selected' : '' }}>
                                {{ $department->name }}</option>
                        @endforeach
                        </select>
                    </div>

                    <div>

                        <x-input-label for="image" :value="__('Image')" class="block text-gray-700 text-sm font-bold mb-2" />
                        <x-text-input id="image" class="form-control block mt-1 w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-green-200 focus:border-green-500" 
                        type="file" name="image" id="formFile" autofocus autocomplete="image"/>            
                        <x-input-error :messages="$errors->get('last_name')" class="mt-2 text-red-600" />
                    </div>
                      
    
                    <div class="mt-4">
                        <x-input-label for="salary" :value="__('Salary')" />
                        <x-text-input id="salary" class="block mt-1 w-full" type="text" name="salary" value="{{ $employee->salary }}" required autofocus autocomplete="salary"/>
                        <x-input-error :messages="$errors->get('salary')" class="mt-2 text-red-600" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="phone" :value="__('Phone')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{ $employee->phone }}" required autofocus autocomplete="phone" placeholder="01123456789"/>
                        <x-input-error :messages="$errors->get('phone')" class="mt-2 text-red-600" />
                    </div>
            
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $employee->email }}" required autocomplete="email" placeholder="test@gmail.com"/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
                    </div>
    
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
                    </div>
    
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600" />
                    </div>
    
                    <div class="flex items-center justify-center mt-4">
                        <x-primary-button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Submit') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

</x-app-layout>
