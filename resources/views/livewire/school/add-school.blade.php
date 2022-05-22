<div>
@push('pagetitle', 'School')
    <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6 mb-5">
        <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-nowrap">
            <div class="ml-4 mt-2">
                <h3 class="text-lg leading-6 font-medium text-gray-900"> Add School</h3>
            </div>
            <div class="ml-4 mt-2 flex-shrink-0">
                <button wire:click="create()" wire:loading.attr="disabled" type="button"
                        class="relative inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Create School
                </button>
            </div>
        </div>


    </div>
    <x-jet-action-message class="mr-3" on="saved">
        {{ __('School Published Successfully.') }}
    </x-jet-action-message>

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="py-3 w-1/4">
                    <x-jet-input  type="text" class="mt-1 block w-full" wire:model="search"
                                 placeholder="search schools..."/>
                </div>
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        @if(count($schools)>0)
                            <thead class="bg-white">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                   #ID
                                </th>
                                <th sortable scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    School Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Male
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Female
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Location
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Distance
                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action
                                </th>

                            </tr>
                            </thead>
                            <tbody wire:loading.class.delay="opacity-50" class="bg-white divide-y divide-gray-200">

                            @foreach ($schools as $school)

                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $school->school_id    }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div class="text-sm text-gray-900 font-semibold uppercase">
                                            {{$school->name}}
                                        </div>
                                        <div class="text-sm text-gray-500 capitalize">
                                            {{$school->type? $school->type .' School':''}}
                                        </div>


                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $school->male ?$school->male :'No Male Students'    }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $school->female ?$school->female :'No Female Students'}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div
                                            class="text-sm text-gray-900 font-semibold uppercase">{{
                                            $school->district->province->name }}</div>
                                        <div class="text-sm text-gray-500 capitalize">
                                            {{$school->district->name}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $school->distance > 0 ? $school->distance.' KM' :''}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button wire:click="edit({{ $school->id }})" type="button"
                                                class="text-indigo-600 hover:text-indigo-900 inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>
                                        <button wire:click="deleteId({{ $school->id }})"
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
                                    No School Found
                                @endslot

                                School
                            @endcomponent
                        @endif
                    </table>
{{--                    <livewire:tables.school-table/>--}}


                </div>
                <div class="my-4 lg:px-4">
                    {{$schools->links()}}
                </div>
            </div>
        </div>
    </div>

    <x-jet-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            {{ __('Add School') }}
        </x-slot>

        <x-slot name="content">
            <div class="intro-y box p-5">
                <form wire:submit.prevent="saveSchool" class="pb-10 ">
                    <!-- Name -->
                    <div class="mt-3">
                        <x-jet-label for="schoolID" value="{{ __('School ID') }}"/>
                        <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="schoolID"
                                     autocomplete="schoolID"/>
                        <x-jet-input-error for="schoolID" class="mt-2"/>
                    </div>
                    <div class="mt-3">
                        <fieldset class="mt-4">
                            <legend class="sr-only">School Type</legend>
                            <div class="space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-10">
                                <div class="flex items-center">
                                    <input wire:model="type" id="primary" name="schoolType"
                                           type="radio"
                                           value="primary"
                                            class="cursor-pointer focus:ring-indigo-500 h-4 w-4 text-indigo-600
                                            border-gray-300">
                                    <label for="email" class="ml-3 block text-sm font-medium text-gray-700">
                                        Primary School
                                    </label>
                                </div>

                                <div class="flex items-center">
                                    <input wire:model="type" id="secondary" name="schoolType"
                                           type="radio"
                                           value="secondary"
                                           class="cursor-pointer focus:ring-indigo-500 h-4 w-4 text-indigo-600
                                           border-gray-300">
                                    <label for="sms" class="ml-3 block text-sm font-medium text-gray-700">
                                        Secondary School
                                    </label>
                                </div>

                                <div class="flex items-center">
                                    <input wire:model="type"  id="high" name="schoolType"
                                           type="radio"
                                           value="high"
                                           class="cursor-pointer focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                    <label for="push" class="ml-3 block text-sm font-medium text-gray-700">
                                        High School
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="mt-3">
                        <x-jet-label for="name" value="{{ __('Name') }}"/>
                        <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name"
                                     autocomplete="name"/>
                        <x-jet-input-error for="name" class="mt-2"/>
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
                    <div class="sm:grid gFrid-cols-2 gap-2">

                        <div class="mt-3">
                            <x-jet-label for="male" value="{{ __('male') }}"/>
                            <x-jet-input id="male" type="number" class="mt-1 block w-full" wire:model.defer="male"
                                         autocomplete="male"/>
                            <x-jet-input-error for="male" class="mt-2"/>
                        </div>
                        <div class="mt-3">
                            <x-jet-label for="female" value="{{ __('Female') }}"/>
                            <x-jet-input id="female" type="number" class="mt-1 block w-full" wire:model.defer="female"
                                         autocomplete="female"/>
                            <x-jet-input-error for="female" class="mt-2"/>
                        </div>
                    </div>

                    <div class="mt-3">
                        <x-jet-label for="distance" value="{{ __('Distance') }}"/>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input wire:model.defer="distance" type="text" name="price" id="price"
                                   class="focus:ring-indigo-200 focus:ring-opacity-50 focus:border-indigo-300 block
                                   w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md"
                                   placeholder="0.00" aria-describedby="price-currency">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm" id="price-currency"> KM </span>
                            </div>
                        </div>
                        <x-jet-input-error for="distance" class="mt-2"/>
                    </div>
                </form>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="isModalClose" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-3" wire:click.prevent="saveSchool" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>


    <!-- Delete school Confirmation Modal -->


    <x-jet-dialog-modal wire:model="confirmDeletion">
        <x-slot name="title">
            {{ __('Delete School') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete school? Once school is deleted, all of its resources and data will be permanently deleted. ') }}

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmDeletion')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete School') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
