<div>
@push('pagetitle', 'Supply Products')
    <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6 mb-5">
        <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-nowrap">
            <div class="ml-4 mt-2">
                <h3 class="text-lg leading-6 font-medium text-gray-900"> Create Report</h3>
            </div>
            <div class="ml-4 mt-2 flex-shrink-0">
                <button wire:click="create()" wire:loading.attr="disabled" type="button"
                        class="relative inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-sky-600 hover:bg-sky-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Add Distribution
                </button>
            </div>
        </div>
    </div>
    <x-jet-action-message class="mr-3" on="saved">
        {{--        {{ __('Product Published Successfully.') }}--}}
    </x-jet-action-message>

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        @if(count($BakeryOrder)>0)
                            <thead class="bg$-white">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Warehouse
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Bakery
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    School

                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Students
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Baked Loaves
                                </th>
                                {{--                                <th scope="col"--}}
                                {{--                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">--}}
                                {{--                                    Is Supplied--}}
                                {{--                                </th>--}}
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Is Supplied
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action
                                </th>

                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                            @foreach ($BakeryOrder as $order)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 font-semibold uppercase">
                                            {{ $order->order_date ? $order->order_date->toFormattedDateString()  :'_' }}

                                        </div>
                                        <!--div class="text-sm text-gray-500 capitalize">
                                            {{ $order->created_at->toFormattedDateString() }}
                                        </div-->
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">

                                            <div class="text-sm font-medium text-gray-900 font-semibold">
                                                <div class="text-sm text-gray-900 font-semibold uppercase">
                                                    {{$order->warehouse->name}}
                                                </div>
                                                <div class="text-sm text-gray-500 capitalize">
                                                    {{$order->warehouse->district->province->name}} (
                                                    {{$order->warehouse->district->name}})
                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900 font-semibold">
                                                <div class="text-sm text-gray-900 font-semibold uppercase">
                                                    {{$order->bakery->name}}
                                                </div>
                                                <div class="text-sm text-gray-500 capitalize">
                                                    {{$order->bakery->district->province->name}} (
                                                    {{$order->bakery->district->name}} )
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div
                                            class="text-sm text-gray-900 font-semibold uppercase">

                                            <div class="text-sm text-gray-900 font-semibold uppercase">
                                                {{ $order->school->name }}
                                            </div>
                                            <div class="text-sm text-gray-500 capitalize">
                                                {{$order->school->district->province->name}}
                                                (
                                                {{ $order->school->district->name }} )
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="text-sm font-medium text-gray-900 font-semibold">
                                            <div class="text-sm text-gray-900 font-semibold uppercase">
                                                M  {{ $order->male  }} : F  {{ $order->female  }}
                                            </div>
                                            <div class="text-sm text-gray-500 capitalize">
                                                Total:  {{ $order->female + $order->male }}

                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 font-semibold">
                                            <div class="text-sm text-gray-900 font-semibold uppercase">
                                              {{ $order->distributed_loaves }}
                                            </div>
                                            <div class="text-sm text-gray-500 capitalize">
                                               {{ $order->loaves_qty }}

                                            </div>
                                        </div>

                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class=" {{$order->is_supplied  ? 'status-active':'status-inActive'}} px-2 inline-flex text-xs leading-5 font-semibold rounded-full ">
                                            {{$order->is_supplied ?'Yes':'NO'}}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        {{--                                        <button wire:click="edit({{ $order->id }})" type="button"--}}
                                        {{--                                                class="text-sky-600 hover:text-sky-900 inline-block">--}}
                                        {{--                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"--}}
                                        {{--                                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">--}}
                                        {{--                                                <path stroke-linecap="round" stroke-linejoin="round"--}}
                                        {{--                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>--}}
                                        {{--                                            </svg>--}}
                                        {{--                                        </button>--}}
                                        <button wire:click="deleteId({{ $order->id }})"
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
                                    No Loaves Found
                                @endslot

                                Product
                            @endcomponent
                        @endif
                    </table>


                </div>
                <div class="my-4 lg:px-4">
                                        {{$BakeryOrder->links()}}
                </div>
            </div>
        </div>
    </div>    <!-- This example requires Tailwind CSS v2.0+ -->
    <x-jet-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            {{ __('Work Order to bakery for baking bread daily ') }}
        </x-slot>

        <x-slot name="content">
            <div x-data="calc()" class="intro-y box p-5">
                <form wire:submit.prevent="supplyProducts" >
                   <div class="mt-3">
                        <x-jet-label for="distributionDate" value="{{ __('Select Distribution Date') }}"/>
                        <x-jet-input id="distributionDate" type="date" class="mt-1 block w-full" wire:model="distributionDate"
                                     autocomplete="distributionDate"/>
                        <x-jet-input-error for="distributionDate" class="mt-2"/>
                    </div>
                    <div class="mt-3">
                        <x-jet-label for="warehouseId" value="{{ __('Select Warehouse') }}"/>
                        <select wire:model="warehouseId" id="warehouseId" autocomplete="warehouseId"
                                class="select-option"
                                required>
                            <option value="">-- Choose Warehouse --</option>
                            @foreach ($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}">{{ Str::title
                                        ($warehouse->name) }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="warehouseId" class="mt-2"/>
                    </div>

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
                        <x-jet-label for="bakeryId" value="{{ __('Select Bakery') }}"/>
                        <select wire:model="bakeryId" id="bakeryId" autocomplete="bakeryId"
                                class="select-option"
                                required>
                            @if (count($bakeries) == 0)
                                <option value="">-- Choose Province first --</option>
                            @else
                                <option value="">-- Choose Bakery --</option>
                                @foreach ($bakeries as $bakery)

                                    <option value="{{$bakery->id}}">
                                        {{ Str::title($bakery->name)
                                    }}</option>
                                @endforeach
                            @endif
                        </select>
                        <x-jet-input-error for="bakeryId" class="mt-2"/>
                    </div>
                    <div class="mt-3">
                        <x-jet-label for="schoolId" value="{{ __('Select School') }}"/>

                        <select wire:model="schoolId" id="schoolId" autocomplete="schoolId"
                                class="select-option"
                                required>
                            @if ($schools->count() == 0)
                                <option value="">-- Choose District first --</option>
                            @else
                                <option value="">-- Choose School --</option>
                                @foreach ($schools as $school)

                                    <option value="{{$school->id}}">
                                        {{ Str::title($school->name)
                                    }}</option>
                                @endforeach
                            @endif
                        </select>
                        <x-jet-input-error for="schoolId" class="mt-2"/>
                    </div>

                    <div class="sm:grid grid-cols-2 gap-2">

                        <div class="mt-3">
                            <x-jet-label for="male" value="{{ __('Male Students') }}"/>
                            <x-jet-input wire:model.defer="male"
                                         @input="update_total"
                                         x-model="male"
                                         id="male" type="number"
                                         class="mt-1 block w-full"
                                         autocomplete="male"/>
                            <x-jet-input-error for="male" class="mt-2"/>
                        </div>
                        <div class="mt-3">
                            {{--                            x-model="@entangle('female')" @input="update_total"--}}
                            <x-jet-label for="female" value="{{ __('Female Students') }}"/>
                            <x-jet-input wire:model.defer="female"
                                         @input="update_total"
                                         x-model="female"
                                         id="female" type="number"
                                         class="mt-1 block w-full"
                                         autocomplete="female"/>
                            <x-jet-input-error for="female" class="mt-2"/>
                        </div>

                    </div>
                    <div class="mt-3">

                        <x-jet-label for="loaves" value="{{ __('Number of loaves to be baked') }}"/>
                            <span x-text="total"></span>
                        <x-jet-input id="loaves" type="number" class="mt-1 block w-full" wire:model="loaves"
                                     autocomplete="loaves"/>
                        <x-jet-input-error for="loaves" class="mt-2"/>
                    </div>
                    <div class="mt-3">
                        <x-jet-label for="distributedLoaves" value="{{ __('Number of Distributed loaves ') }}"/>
                        <x-jet-input id="loaves" type="number" class="mt-1 block w-full" wire:model="distributedLoaves"
                                     autocomplete="distributedLoaves"/>
                        <x-jet-input-error for="distributedLoaves" class="mt-2"/>
                    </div>

                    <div class="mt-3">
                        <x-jet-label for="isSupplied" value="{{ __('Is Supplied?') }}"/>
                        <label for="toggle-example" class="flex items-center cursor-pointer relative mb-4">
                            <input wire:model="isSupplied" name="isSupplied" type="checkbox" id="toggle-example"
                                   class="sr-only">
                            <div class="toggle-bg bg-gray-200 border-2 border-gray-200 h-6 w-11 rounded-full"></div>
                        </label>
                    </div>
                    <div class="mt-3">
                        @if($lowStock)
                            <div  class="bg-red-50 border-l-4 border-red-400 p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <!-- Heroicon name: solid/exclamation -->
                                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0
                                         0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">

                                        <p class="text-sm text-red-700">
                                            Low Stock:
                                            <a href="/stocks" class="font-medium underline text-red-700
                                            hover:text-red-600"> {{$lowStockMessage}}</a>
                                        </p>

                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </form>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="isModalClose" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <button type="submit" {{$lowStock?'disabled':''}}
            wire:click.prevent="supplyProducts"
                    class="btn ml-3">
                save
            </button>
        </x-slot>
    </x-jet-dialog-modal>


    <!-- Delete Bakery Confirmation Modal -->


    <x-jet-dialog-modal wire:model="confirmDeletion">
        <x-slot name="title">
            {{ __('Delete Distributed Item') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete ? Once Distributed item is deleted, all of its resources and
            data
            will be permanently deleted. ') }}

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmDeletion')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete Item') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
    <script>
        function calc() {
            return {
                total: 0,
                male: '',
                female: '',

                getMale() {
                    return (this.male === "") ? 0 : parseInt(this.male);
                },

                getFemale() {
                    return (this.female === "") ? 0 : parseInt(this.female);
                },

                update_total() {
                    this.total = this.getMale() + this.getFemale();
                }
            }
        }
    </script>
</div>



