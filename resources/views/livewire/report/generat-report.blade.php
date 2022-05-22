<div>
@push('pagetitle', 'Generate Report')
    <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6 mb-5">
        <div class="sm:grid grid-cols-4 gap-2">
            <div class="mt-3">
                <x-jet-label for="startDate" value="{{ __('Select Report Start Date') }}"/>
                <x-jet-input id="startDate" type="date" class="mt-1 block w-full" wire:model="startDate"
                             autocomplete="startDate"/>
                <x-jet-input-error for="startDate" class="mt-2"/>
            </div>
            <div class="mt-3">
                <x-jet-label for="endDate" value="{{ __('Select Report End Date') }}"/>
                <x-jet-input id="endDate" type="date" class="mt-1 block w-full" wire:model="endDate"
                             autocomplete="startDate"/>
                <x-jet-input-error for="endDate" class="mt-2"/>
            </div>

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
            <button type="button"
                    class="btn" wire:click="generateReport" wire:loading.attr="disabled">
                Generate Report
            </button>
      @if(count($filteredOrder)>0)
                <button type="button" wire:click="export('pdf')"
                        wire:loading.attr="disabled"
                        class="btn">
                    PDF
                </button>
                <button type="button" wire:click="export('xlsx')"
                        wire:loading.attr="disabled"
                        class="btn">Excel
                </button>
            @endif
        </div>
    </div>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                    <table class="min-w-full divide-y divide-gray-200">

                        @if(count($filteredOrder)>0)

                            <thead class="bg$-white">
                            <tr>
                                <td  class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" name="selected" wire:model="selected" value="{{$order->id}}" class="focus:ring-sky-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    </td>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date
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
                                  Present Students
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Baked Bread+
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Distributed Bread+
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ingredients (KG)
                                </th>
                            </tr>
                            </thead>
                            <div wire:loading>
                                Processing Report Please Waite...
                            </div>
                            <tbody wire:loading.class.delay="opacity-50" class="bg-white divide-y divide-gray-200">
                            @foreach ($filteredOrder as $order)

                                <tr>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" name="selected" wire:model="selected" value="{{$order->id}}" class="focus:ring-sky-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $order->order_date->toFormattedDateString() }}
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
                                                {{ $order->female + $order->male }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 font-semibold">
                                            <div class="text-sm text-gray-900 font-semibold uppercase">
                                                {{ $order->loaves_qty }}
                                            </div>
                                        </div>

                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="text-sm font-medium text-gray-900 font-semibold">
                                            <div class="text-sm text-gray-900 font-semibold uppercase">
                                                {{ $order->distributed_loaves }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="text-sm font-medium text-gray-900 font-semibold">
                                            <div class="text-xs text-gray-900 font-semibold capitalize">
                                               Flour: {{ $order->loaves_qty * 0.160  }}<br>
                                               Sugar: {{ $order->loaves_qty * 0.01 }}<br>
                                               Walnuts: {{ $order->loaves_qty * 0.007 }}<br>
                                               Raisins: {{ $order->loaves_qty * 0.008 }}
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach


                            <!-- More people... -->
                            </tbody>
                        @else
                            @component('components.empty-state')
                                @slot('title')
                                    @if($selectedDistrict)
                                        No Record Found for this Province or district
                                    @else
                                        No Record Found
                                    @endif

                                @endslot

                                Product
                            @endcomponent
                        @endif
                    </table>


                </div>
                <div class="my-4 lg:px-4">
{{--                    {{$orders->links()}}--}}
                </div>
            </div>
        </div>
    </div>    <!-- This example requires Tailwind CSS v2.0+ -->
</div>
