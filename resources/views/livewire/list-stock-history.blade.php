<div>
@push('pagetitle', 'Stock History')
      <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        @if(count($stocks)>0)
                            <thead class="bg-white">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    User
                                </th>
                                  <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Product Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Warehouse
                                </th>
                             
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Amount
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Unit
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action
                                </th>

                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                            @foreach ($stocks as $product)
                                <tr>
                                       <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                        <img class="h-10 w-10 rounded-full"
                                                             src="{{ $product->user->profile_photo_url }}" alt="">
                                                
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $product->user->name }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ $product->user->email }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div
                                                    class="text-sm font-medium text-gray-900 font-semibold">
                                                    {{ $product->ingredient->name }}
                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div
                                            class="text-sm text-gray-900 font-semibold uppercase">
                                            {{$product->warehouse->name}}
                                        </div>
                                    </td>
                                   
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $product->amount }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="  px-2 inline-flex text-xs leading-5 font-semibold rounded-full ">
                                            @if($product->unit == 1)
                                                Gram
                                                @elseif($product->unit == 2)
                                                Kilogram
                                                @elseif($product->unit == 3)
                                                Tonne
                                                @else
                                                'Unknown'
                                                @endif
                                        </span>
                                    </td>
{{--                                    <td class="px-6 py-4 whitespace-nowrap">--}}
{{--                                        <span--}}
{{--                                            class=" {{$product->is_supplied  ? 'status-active':'status-inActive'}} px-2 inline-flex text-xs leading-5 font-semibold rounded-full ">--}}
{{--                                            {{$product->is_supplied ?'Active':'Inactive'}}--}}
{{--                                        </span>--}}
{{--                                    </td>--}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $product->created_at->diffForHumans() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @if (Auth::user()->roles->pluck('title')[0] == 'Admin')
                                            
                        
                                        <button wire:click="deleteId({{ $product->id }})"
                                                class="text-red-600 hover:text-red-500 inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach


                            <!-- More people... -->
                            </tbody>
                        @else
                            @component('components.empty-state')
                                @slot('title')
                                    No History Found
                                @endslot

                                Product
                            @endcomponent
                        @endif
                    </table>


                </div>
                <div class="my-4 lg:px-4">
                    {{$stocks->links()}}
                </div>
            </div>
        </div>
    </div>

    <!-- Delete school Confirmation Modal -->
    
    
    <x-jet-dialog-modal wire:model="confirmDeletion">
        <x-slot name="title">
            {{ __('Delete History') }}
        </x-slot>
    
        <x-slot name="content">
            {{ __('Are you sure you want to delete history? Once history is deleted, all of its resources and data will be permanently deleted. ') }}
    
        </x-slot>
    
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmDeletion')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
    
            <x-jet-danger-button class="ml-3" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete History') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
