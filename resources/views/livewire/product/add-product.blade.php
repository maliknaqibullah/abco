<div>
@push('pagetitle', 'Stock')
    <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6 mb-5">
        @if(count($warehouses) <= 0 || count($ingredients)<= 0 || count($suppliers)<=0)
            @component('components.notification')
                @slot('product')
                    product
                @endslot
                @slot('parent')
                    @if(count($warehouses)<=0 )
                        warehouse
                    @elseif(count($ingredients)<=0 )
                        ingredient
                    @else
                        supplier
                    @endif
                @endslot
                @slot('url')
                    @if(count($warehouses)<=0 )
                        warehouse
                    @elseif(count($ingredients)<=0 )
                        ingredient
                    @else
                        supplier
                    @endif
                @endslot
            @endcomponent

        @else
            <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-nowrap">
                <div class="ml-4 mt-2">
                    <h3 class="text-lg leading-6 font-medium text-gray-900"> Add To Stock</h3>
                </div>
                <div class="ml-4 mt-2 flex-shrink-0">
                    <button wire:click="create()" wire:loading.attr="disabled" type="button"
                            class="relative inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Add To Stock
                    </button>
                </div>
            </div>
        @endif

    </div>
    <x-jet-action-message class="mr-3" on="saved">
        {{ __('Product Published Successfully.') }}
    </x-jet-action-message>

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        @if(count($products)>0)
                            <thead class="bg-white">
                            <tr>
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
                                    Supplier
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Amount
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Unit
                                </th>
{{--                                <th scope="col"--}}
{{--                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">--}}
{{--                                    Is Supplied--}}
{{--                                </th>--}}
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

                            @foreach ($products as $product)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div
                                                    class="text-sm font-medium text-gray-900 font-semibold">{{ $product->ingredient->name }}
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
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div
                                            class="text-sm text-gray-900 font-semibold uppercase">
                                            {{$product->supplier->name}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $product->amount }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="  px-2 inline-flex text-xs leading-5 font-semibold rounded-full ">
                                            {{$product->unit == 1?'Gram':'Kilogram'}}
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
                                        <button wire:click="edit({{ $product->id }})" type="button"
                                                class="text-indigo-600 hover:text-indigo-900 inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>
                                        <button wire:click="deleteId({{ $product->id }})"
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
                                    No Product Found
                                @endslot

                                Product
                            @endcomponent
                        @endif
                    </table>


                </div>
                <div class="my-4 lg:px-4">
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </div>

    <x-jet-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            {{ __('Add Product') }}
        </x-slot>
        <x-slot name="content">
            <div class="intro-y box p-5">
                <form wire:submit.prevent="saveProduct" class="pb-10 ">
                    <div class="sm:grid grid-cols-1 gap-2">
                        <div class="mt-3">
                            <x-jet-label for="supplierId" value="{{ __('Who is supplying?') }}"/>
                            <select wire:model="supplierId" id="supplierId" autocomplete="supplierId"
                                    class="select-option"
                                    required>
                                <option value="">-- Choose Supplier --</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name}}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="supplierId" class="mt-2"/>
                        </div>
                        <div class="mt-3">
                            <x-jet-label for="warehouseId" value="{{ __('Select Warehouse') }}"/>
                            <select  wire:model="warehouseId" id="warehouseId"
                                    autocomplete="warehouseId"
                                    class="select-option"
                                     {{$productId != '' ? 'disabled' : ''}}
                                    required>
                                <option value="">-- Choose Warehouse --</option>
                                @foreach ($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name
                                .' ( '.$warehouse->district->province->name .' - '. ($warehouse->district->name).' )'
                                }}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="warehouseId" class="mt-2"/>
                        </div>
                    </div>

                    <!-- Name -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="name" value="{{ __('Name') }}"/>
                        <select wire:model="name" id="name" autocomplete="name"
                                class="select-option"
                                {{$productId != '' ? 'disabled' : ''}}
                                required>
                            <option value="">-- Choose Ingredient --</option>
                            @foreach ($ingredients as $ingredient)
                                <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="name" class="mt-2"/>
                    </div>

                    <div class="sm:grid grid-cols-1 gap-2">
                        <div class="mt-3">
                            <x-jet-label for="unit" value="{{ __('Select Unit') }}"/>
                            <select wire:model="unit" id="unit" autocomplete="unit"
                                    class="select-option"
                                    {{$productId != '' ? 'disabled' : ''}}
                                    required>
                                <option value="">-- Choose Unit --</option>
                                <option value="1">Gram</option>
                                <option value="2">Kilogram</option>
                                <option value="3">Tonne</option>

                            </select>
                            <x-jet-input-error for="unit" class="mt-2"/>
                        </div>
                        <div class="mt-3">
                            <x-jet-label for="amount" value="{{ __('Weight') }}"/>
                            <x-jet-input id="amount" type="number" class="mt-1 block w-full" wire:model.defer="amount"
                                         autocomplete="amount"/>
                            <x-jet-input-error for="amount" class="mt-2"/>
                        </div>

                    </div>
                </form>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="isModalClose" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-3" wire:click.prevent="saveProduct" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>


    <!-- Delete supplier Confirmation Modal -->


    <x-jet-dialog-modal wire:model="confirmDeletion">
        <x-slot name="title">
            {{ __('Delete Product') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete product? Once product is deleted, all of its resources and data will be permanently deleted. ') }}

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmDeletion')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete Product') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
