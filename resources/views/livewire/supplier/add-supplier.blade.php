<div>
@push('pagetitle', 'Supplier')
    <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6 mb-5">


        <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-nowrap">
            <div class="ml-4 mt-2">
                <h3 class="text-lg leading-6 font-medium text-gray-900"> List of Total Suppliers</h3>
            </div>
            <div class="ml-4 mt-2 flex-shrink-0">
                <button wire:click="create()" wire:loading.attr="disabled" type="button"
                        class="relative inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-sky-600 hover:bg-sky-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Add Supplier
                </button>
            </div>
        </div>
    </div>
    <!-- This example requires Tailwind CSS v2.0+ -->


    @if(count($suppliers)>0)
        <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach($suppliers as $supplier)
                <li class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200">
                    <div class="flex-1 flex flex-col p-8 relative">
                        <div x-data="{dropDown : false}" class="absolute inline-block text-left top-2 right-2">
                            <div>
                                <button @click="dropDown = !dropDown" type="button"
                                        class=" flex items-center text-gray-400 hover:text-gray-600 focus:outline-none "
                                        id="menu-button" aria-expanded="true" aria-haspopup="true">
                                    <span class="sr-only">Open options</span>
                                    <!-- Heroicon name: solid/dots-vertical -->
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                         fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                    </svg>
                                </button>
                            </div>

                            <div x-show="dropDown"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 x-cloak @click.outside="dropDown = false"
                                 class="transition ease-out duration-100 origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                 role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                <div class="py-1" role="none">
                                    <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                    <button wire:click="edit({{ $supplier->id }})" type="button"
                                            class="text-gray-700 block w-full text-left px-4 py-2 text-sm hover:bg-gray-100"
                                            role="menuitem" tabindex="-1" id="menu-item-3">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="h-5 w-5 text-gray-400 mr-1 inline-block" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </button>

                                    <button wire:click="deleteId({{ $supplier->id }})" type="button"
                                            class="text-gray-700 block w-full text-left px-4 py-2 text-sm hover:bg-gray-100"
                                            role="menuitem" tabindex="-1" id="menu-item-3">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="h-5 w-5 text-gray-400 mr-1 inline-block" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                        @if($supplier->imgUrl != null)
                            <img class="w-24 h-24 flex-shrink-0 mx-auto rounded-full" src="{{ $supplier->imgUrl }}"
                                 alt="">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24 flex-shrink-0 mx-auto rounded-full"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        @endif
                        <h3 class="mt-6 text-gray-900 text-sm font-medium">{{ $supplier->name }}</h3>
                        <dl class="mt-1 flex-grow flex flex-col justify-between">
                            <dt class="sr-only">name</dt>
                            <dd class="text-gray-500 text-sm">{{ $supplier->description }} </dd>
                            <dt class="sr-only">status</dt>
                            <dd class="mt-3">
                        <span class="{{ $supplier->status ?'status-active ' :'status-inActive ' }} px-2 py-1 text-xs font-medium  rounded-full">
                            {{ $supplier->status?'Active' : 'Inactive' }}
                        </span>
                            </dd>
                        </dl>
                    </div>

                    <div>
                        <div class="-mt-px flex divide-x divide-gray-200">
                            <div class="w-0 flex-1 flex">
                                <a href="{{ $supplier->email != null ? 'mailto:'.$supplier->email: 'javascript:void(0)' }}"
                                   class="{{ $supplier->email? '':'cursor-not-allowed' }} relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500">
                                    <!-- Heroicon name: solid/mail -->
                                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                    </svg>
                                    <span class="ml-3">Email</span>
                                </a>
                            </div>
                            <div class="-ml-px w-0 flex-1 flex">
                                <a href="{{ $supplier->phone != null ? 'tel:'.$supplier->phone:'javascript:void(0)'}} "
                                   class="{{ $supplier->phone? '':'cursor-not-allowed' }} relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-gray-500">
                                    <!-- Heroicon name: solid/phone -->
                                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                    </svg>
                                    <span class="ml-3">Call</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
        @endforeach
        <!-- More people... -->
        </ul>
        <div class="my-4 lg:px-4">
            {{$suppliers->links()}}
        </div>
    @else
        @component('components.empty-state')
            @slot('title')
                No Supplier Found
            @endslot
            Supplier
        @endcomponent
    @endif


    <x-jet-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            {{ __('Add Supplier') }}
        </x-slot>

        <x-slot name="content">
            <div class="intro-y box p-5">
                <form class="pb-10 ">
                    <div class="sm:grid grid-cols-1 gap-2">
                        <div class="mt-3">
                            <x-jet-label for="name" value="{{ __('Name') }}"/>
                            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name"/>
                            <x-jet-input-error for="name" class="mt-2"/>
                        </div>
                        <div class="mt-3">
                            <x-jet-label for="email" value="{{ __('Email') }}"/>
                            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="email"/>
                            <x-jet-input-error for="email" class="mt-2"/>
                        </div>
                    </div>
                    <div class="mt-3">
                        <x-jet-label for="phone" value="{{ __('Phone') }}"/>
                        <x-jet-input id="phone" type="text" class="mt-1 block w-full" wire:model.defer="phone"
                                     autocomplete="phone"/>
                        <x-jet-input-error for="phone" class="mt-2"/>
                    </div>
                    <div class="mt-3">
                        <x-jet-label for="imgUrl" value="{{ __('imgUrl') }}"/>
                        <x-jet-input id="imgUrl" type="url" class="mt-1 block w-full" wire:model.defer="imgUrl"
                                     autocomplete="imgUrl"/>
                        <x-jet-input-error for="imgUrl" class="mt-2"/>
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
                                      placeholder="Supplier information goes here..."></textarea>
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

            <x-jet-button class="ml-3" wire:click.prevent="saveSupplier" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>


    <!-- Delete supplier Confirmation Modal -->

    <x-jet-dialog-modal wire:model="confirmDeletion">
        <x-slot name="title">
            {{ __('Delete Supplier') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete supplier? Once supplier is deleted, all of its resources and data will be permanently deleted. ') }}

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmDeletion')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete Supplier') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
