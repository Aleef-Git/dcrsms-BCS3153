<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-x-auto">
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        
                        <form action="{{ route('account.update') }}" method="POST" enctype="multipart/form-data">
                       
                            @method('PUT')
                            <label class="label" for="first_name">First Name</label>
                            <input type="text" name="first_name" class="input input-bordered" value="{{ $rider->first_name }}">
                            <label class="label" for="last_name">Last Name</label>
                            <input type="text" name="last_name" class="input input-bordered" value="{{ $rider->last_name }}">
                            <label class="label" for="phone_number">Phone Number</label>
                            <input type="text" name="phone_number" class="input input-bordered" value="{{ $rider->phone_number }}">
                            <label class="label" for="address">Address</label>
                            <textarea class="textarea textarea-bordered min-w-full" name="address" style="min-height:100px">{{ $rider->address }}</textarea>
                    
                             <x-label for="license" :value="__('License')" />
                             <x-input type="file" id="license" class="block mt-1 w-full" name="license" /> 
                        
                            <x-label for="roadtax" :value="__('Roadtax')" />
                             <x-input type="file" id="roadtax" class="block mt-1 w-full" name="roadtax" />
            
                            <br></br>
                            <a class="btn btn-sm" href="{{ route('dashboard') }}">Back</a>
                           
                            <input class="btn btn-sm" type="submit">

                        </form>
                    </div>                      
                </div>
            </div>
        </div>
    </div>
  
</x-app-layout>
