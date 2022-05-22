<div>
@push('pagetitle', 'Transfer Stock')
    <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6 mb-5">
        <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-nowrap">
            <div class="ml-4 mt-2">
                <h3 class="text-lg leading-6 font-medium text-gray-900"> Transfer Stock</h3>
            </div>
            <div class="ml-4 mt-2 flex-shrink-0">
                <button wire:click="create()" wire:loading.attr="disabled" type="button"
                        class="relative inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Transfer Stock
                </button>
            </div>
        </div>


    </div>
    <x-jet-action-message class="mr-3" on="saved">
        {{ __('Transferred Stock Successfully.') }}
    </x-jet-action-message>

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="py-3 w-1/4">
                    <x-jet-input type="text" class="mt-1 block w-full" wire:model="search"
                                 placeholder="search Transferreds..."/>
                </div>
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        @if(count($stocks)>0)
                            <thead class="bg-white">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date
                                </th>
                                <th sortable scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Source Warehouse
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Destination Warehouse
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Product
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Quantity
                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Is Transferred
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action
                                </th>

                            </tr>
                            </thead>
                            <tbody wire:loading.class.delay="opacity-50" class="bg-white divide-y divide-gray-200">

                            @foreach ($stocks as $stock)

                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $stock->created_at->toFormattedDateString()    }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div class="text-sm text-gray-900 font-semibold uppercase">
                                            {{$stock->warehouse->name}}
                                        </div>
                                        <div class="text-sm text-gray-500 capitalize">
                                            {{$stock->warehouse->district->province->name}}
                                            ( {{$stock->warehouse->district->name}})
                                        </div>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($stock->destination_type === 1)
                                            <div class="text-sm text-gray-900 font-semibold uppercase">
                                                {{\App\Models\Warehouse::where('id',$stock->destination_id)->pluck
                                                ('name')->first()}}
                                            </div>
                                            <div class="text-sm text-gray-500 capitalize">
                                                {{\App\Models\Warehouse::with('district')->where('id',
                                                $stock->destination_id)->first()->district->province->name}}
                                                ( {{\App\Models\Warehouse::with('district')->where('id',
                                            $stock->destination_id)->first()->district->name}})
                                            </div>
                                        @elseif($stock->destination_type === 2)
                                            <div class="text-sm text-gray-900 font-semibold uppercase">
                                                {{\App\Models\Bakery::where('id',$stock->destination_id)->pluck
                                                ('name')->first()}}
                                            </div>
                                            <div class="text-sm text-gray-500 capitalize">
                                                {{\App\Models\Bakery::with('district')->where('id',
                                                $stock->destination_id)->first()->district->province->name}}
                                                ( {{\App\Models\Bakery::with('district')->where('id',
                                            $stock->destination_id)->first()->district->name}} )
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $stock->product->ingredient->name  }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $stock->stock_qty  }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        <span
                                            class=" {{$stock->is_transferred  ? 'status-active':'status-inActive'}} px-2 inline-flex text-xs leading-5 font-semibold rounded-full ">
                                            {{$stock->is_transferred ?'Yes':'NO'}}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
{{--                                        <button wire:click="edit({{ $stock->id }})" type="button"--}}
{{--                                                class="text-indigo-600 hover:text-indigo-900 inline-block">--}}
{{--                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"--}}
{{--                                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">--}}
{{--                                                <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>--}}
{{--                                            </svg>--}}
{{--                                        </button>--}}
                                        <button wire:click="deleteId({{ $stock->id }})"
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
                                    No Transferred Stock Found
                                @endslot

                                Transferred Stock
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

    <x-jet-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            {{ __('Transfer Stock') }}
        </x-slot>

        <x-slot name="content">
            <div class="intro-y box p-5">
                <form wire:submit.prevent="saveStock" class="pb-10 ">
                    <!-- Name -->
                    <div class="mt-3">
                        <x-jet-label for="source" value="{{ __('Select Source Warehouse') }}"/>
                        <select wire:model="source" id="source" autocomplete="source"
                                class="select-option"
                                required>
                            <option value="">-- Choose Warehouse --</option>
                            @foreach ($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}">{{ Str::title($warehouse->name) }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="source" class="mt-2"/>
                    </div>
                    <div class="mt-3">
                        <x-jet-label for="selectedProduct" value="{{ __('Select Product') }}"/>
                        <select wire:model="selectedProduct" id="selectedProduct" autocomplete="selectedProduct"
                                class="select-option"
                                required>
                            @if ($inStockProducts->count() == 0)
                                <option value="">-- Choose Warehouse first --</option>
                            @else
                                <option value="">-- Choose Product --</option>
                                @foreach ($inStockProducts as $product)
                                    <option
                                        value="{{ $product->id }}">{{ Str::title($product->ingredient->name) }}</option>
                                @endforeach
                            @endif
                        </select>
                        @if($currentStock)
                            <span class=" {{$currentStock > 0  ? 'status-active':'status-inActive'}}
                                            mt-3 px-2 inline-flex text-xs leading-5 font-semibold rounded-full ">
                                         {{$currentStock}}
                        </span>
                        @endif
                        <x-jet-input-error for="selectedProduct" class="mt-2"/>

                    </div>
                    <div class="mt-3">
                        <x-jet-label for="destinationType" value="{{ __('Select Destination Type') }}"/>
                        <select wire:model="destinationType" id="destinationType" autocomplete="destinationType"
                                class="select-option"
                                required>
                            <option value="">-- Choose Destination Type --</option>
                            <option value="1">Warehouse</option>
                            <option value="2">Bakery</option>
                        </select>
                        <x-jet-input-error for="destinationType" class="mt-2"/>
                    </div>
                    @if($destinationType === '1')
                        <div class="mt-3">
                            <x-jet-label for="destinationId" value="{{ __('Select Destination Warehouse') }}"/>
                            <select wire:model="destinationId" id="destinationId" autocomplete="destinationId"
                                    class="select-option"
                                    required>
                                <option value="">-- Choose Warehouse --</option>
                                @foreach ($destinations as $warehouse)
                                    <option value="{{ $warehouse->id }}">{{ Str::title($warehouse->name) }}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="destinationId" class="mt-2"/>
                        </div>
                    @elseif($destinationType === '2')
                        <div class="mt-3">
                            <x-jet-label for="destinationId" value="{{ __('Select Destination Bakery') }}"/>
                            <select wire:model="destinationId" id="destinationId" autocomplete="destinationId"
                                    class="select-option"
                                    required>
                                <option value="">-- Choose Bakery --</option>
                                @foreach ($destinations as $bakery)
                                    <option value="{{ $bakery->id }}">{{ Str::title($bakery->name) }}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="destinationId" class="mt-2"/>
                        </div>
                    @endif
                    <div class="mt-3">
                        <x-jet-label for="stockQty" value="{{ __('Stock Quantity To Transfer') }}"/>
                        <x-jet-input id="stockQty" type="number" class="mt-1 block w-full" wire:model.defer="stockQty"
                                     autocomplete="stockQty"/>
                        <x-jet-input-error for="stockQty" class="mt-2"/>
                    </div>
                    <div class="mt-3">
                        <x-jet-label for="isTransferred" value="{{ __('Are you sure?') }}"/>
                        <label for="toggle-example" class="flex items-center cursor-pointer relative mb-4">
                            <input wire:model="isTransferred" name="isTransferred" type="checkbox" id="toggle-example"
                                   class="sr-only">
                            <div class="toggle-bg bg-gray-200 border-2 border-gray-200 h-6 w-11 rounded-full"></div>
                        </label>
                    </div>

                </form>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="isModalClose" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-3" wire:click.prevent="saveStock" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>


    <!-- Delete stock Confirmation Modal -->


    <x-jet-dialog-modal wire:model="confirmDeletion">
        <x-slot name="title">
            {{ __('Delete stock') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete stock? Once stock is deleted, all of its resources and data will be permanently deleted. ') }}

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmDeletion')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete Stock') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
