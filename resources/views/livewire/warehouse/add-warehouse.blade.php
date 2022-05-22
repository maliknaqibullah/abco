<div>
@push('pagetitle', 'Warehouse')
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6 mb-5">
        <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-nowrap">
            <div class="ml-4 mt-2">
                <h3 class="text-lg leading-6 font-medium text-gray-900"> Add Warehouse</h3>
            </div>
            <div class="ml-4 mt-2 flex-shrink-0">
                <button wire:click="create()" wire:loading.attr="disabled" type="button"
                        class="relative inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-sky-600 hover:bg-sky-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Create Warehouse
                </button>
            </div>
        </div>
    </div>
    <x-jet-action-message class="mr-3" on="saved">
        {{ __('Warehouse Published Successfully.') }}
    </x-jet-action-message>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        @if(count($warehouses)>0)
                            <thead class="bg-white">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Warehouse Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Location
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Items In Stock
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action
                                </th>

                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                            @foreach ($warehouses as $warehouse)
                                <tr class="hover:bg-gray-100 ">
                                    <td class="px-6 py-4 flex-wrap	">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">

                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="h-10 w-10 rounded-full border border-gray-200 p-1 text-gray-400"
                                                     fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                     stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <a href="/warehouse/{{$warehouse->id}}">
                                                    <div
                                                        class="text-md font-medium text-gray-900">{{ $warehouse->name }}</div>
                                                    <div
                                                        class="text-sm text-gray-500 truncate">{{ substr($warehouse->description ,0,50)}}</div>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 flex-wrap	">

                                        <div class="text-sm text-gray-900 font-semibold uppercase">
                                            {{ $warehouse->district->province->name }}
                                        </div>
                                        <div class="text-sm text-gray-500 capitalize">
                                            {{ $warehouse->district->name}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 flex-wrap	">
                                        <span
                                            class=" {{$warehouse->status  ? 'status-active':'status-inActive'}}
                                            px-2 inline-flex text-xs leading-5 font-semibold rounded-full "> {{$warehouse->status ?'Active':'Inactive'}} </span>
                                    </td>
                                    <td class="px-6 py-4 flex-wrap	 text-sm text-gray-500">
                                        @foreach($warehouse->product as $product)
                                            <a href="/stocks">
                                                <span
                                                    class="primary-badge"> {{$product->ingredient->name .' ( '.$product->amount}} {{$product->unit == 1 ?'Gr':'Kg'}} ) </span>
                                            </a>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 flex-wrap	 text-right text-sm font-medium">
                                        <button wire:click="edit({{ $warehouse->id }})" type="button"
                                                class="text-sky-600 hover:text-sky-900 inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>
                                        <button wire:click="deleteId({{ $warehouse->id }})"
                                                class="text-red-600 hover:text-red-500 inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            <!-- More people... -->
                            </tbody>
                        @else
                            @component('components.empty-state')
                                @slot('title')
                                    No Warehouse Found
                                @endslot

                                warehouse
                            @endcomponent
                        @endif
                    </table>

                </div>
                <div class="my-4 lg:px-4">
                    {{$warehouses->links()}}
                </div>
            </div>
        </div>
    </div>

    <!-- This example requires Tailwind CSS v2.0+ -->

    <x-jet-dialog-modal wire:model="isModalOpen">
        <x-slot name="title">
            {{ __('Add Warehouse') }}
        </x-slot>

        <x-slot name="content">
            <div class="intro-y box p-5">
                <form wire:submit.prevent="saveWarehouse" class="pb-10 ">

                    <!-- Name -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="name" value="{{ __('Name') }}"/>
                        <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name"
                                     autocomplete="name"/>
                        <x-jet-input-error for="name" class="mt-2"/>
                    </div>
                    {{--                        @livewire('show-locations')--}}
                    <div class="sm:grid grid-cols-2 gap-2">
                        <div class="mt-3">
                            <x-jet-label for="selectedProvince" value="{{ __('Select Province') }}"/>
                            <select wire:model="selectedProvince" id="province" autocomplete="selectedProvince"
                                    class="select-option"
                                    required>
                                <option value="">-- Choose Province --</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}">{{ Str::title($province->name) }}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="selectedProvince" class="mt-2"/>

                        </div>
                        <div class="mt-3">
                            <x-jet-label for="selectedDistrict" value="{{ __('Select District') }}"/>
                            <select wire:model="selectedDistrict" id="selectedDistrict"
                                    class="select-option"
                                    required>
                                @if ($districts->count() == 0)
                                    <option value="">-- Choose Province first --</option>
                                @else
                                    <option value="">-- Choose District --</option>

                                    @foreach ($districts as $district)

                                        <option value="{{ $district->id }}">{{ Str::title($district->name) }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <x-jet-input-error for="selectedDistrict" class="mt-2"/>
                        </div>
                    </div>

                    <div class="mt-3">
                        <x-jet-label for="status" value="{{ __('Status') }}"/>
                        <label for="toggle-example" class="flex items-center cursor-pointer relative mb-4">
                            <input wire:model="status" name="status" type="checkbox" id="toggle-example"
                                   class="sr-only">
                            <div class="toggle-bg bg-gray-200 border-2 border-gray-200 h-6 w-11 rounded-full"></div>
                        </label>
                    </div>

                    <div class="mt-3">
                        <x-jet-label for="description" value="{{ __('Description') }}"/>
                        <div class="mt-2">
                            <textarea wire:model="description" id="about" name="description" rows="3"
                                      class="shadow-sm focus:ring-sky-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                                      placeholder="Warehouse Description goes here..."></textarea>
                        </div>
                        <x-jet-input-error for="description" class="mt-2"/>
                    </div>

                </form>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="isModalClose" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
{{--            --}}
            <x-jet-button class="ml-3"  wire:click.prevent="saveWarehouse" >
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>


    <!-- Delete warehouse Confirmation Modal -->


    <x-jet-dialog-modal wire:model="confirmDeletion">
        <x-slot name="title">
            {{ __('Delete Warehouse') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete Warehouse? Once warehouse is deleted, all of its resources and data will be permanently deleted. ') }}

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmDeletion')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete Warehouse') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>


