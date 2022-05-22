<div>
@push('pagetitle', 'Role')
    <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6 mb-5">
        <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-nowrap">
            <div class="ml-4 mt-2">
                <h3 class="text-lg leading-6 font-medium text-gray-900"> Add Role</h3>
            </div>
            <div class="ml-4 mt-2 flex-shrink-0">
                <button wire:click="create()" wire:loading.attr="disabled" type="button"
                        class="relative inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-sky-600 hover:bg-sky-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Create Role
                </button>
            </div>
        </div>
    </div>
    <x-jet-action-message class="mr-3" on="saved">
        {{ __('Role Published Successfully.') }}
    </x-jet-action-message>

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        @if(count($roles)>0)
                            <thead class="bg-white">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Assigned Permissions
                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action
                                </th>

                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                            @foreach ($roles as $role)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div
                                                    class="text-sm font-medium text-gray-900 font-semibold">{{
                                                    $role->title }}
                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @foreach($role->permissions as $permission)
                                        <span class=" status-active px-2 inline-flex text-xs leading-5 font-semibold
                                        rounded-full ">
                                            {{$permission->title}}
                                        </span>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button wire:click="edit({{ $role->id }})" type="button"
                                                class="text-sky-600 hover:text-sky-900 inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>
                                        <button wire:click="deleteId({{ $role->id }})"
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
                                    No Role Found
                                @endslot

                                Role
                            @endcomponent
                        @endif
                    </table>


                </div>
                <div class="my-4 lg:px-4">
                    {{$roles->links()}}
                </div>
            </div>
        </div>
    </div>

    <x-jet-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            {{ __('Add Role') }}
        </x-slot>
        @section('custom_css')
            <link
                href="https://raw.githubusercontent.com/sa-si-dev/virtual-select/master/dist/virtual-select.min.css"
                rel="stylesheet"
            />
        @endsection
        <x-slot name="content">
            <div class="intro-y box p-5">
                <form wire:submit.prevent="saveRole" class="pb-10 ">

                    <div class="mt-3">
                        <x-jet-label for="title" value="{{ __('Title') }}"/>
                        <x-jet-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="title"
                                     autocomplete="title"/>
                        <x-jet-input-error for="title" class="mt-2"/>
                    </div>
                    <div class="mt-3">
                        <select wire:model="selection" name="p" id="permission" class="select-option" multiple>
                            @foreach($permissions as $perm)
                                <option value={{$perm->id}}>{{ $perm->title }}</option>
                            @endforeach
                        </select>
                    </div>

                </form>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="isModalClose" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-3" wire:click.prevent="saveRole" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>


    <!-- Delete ingredient Confirmation Modal -->


    <x-jet-dialog-modal wire:model="confirmDeletion">
        <x-slot name="title">
            {{ __('Delete Role') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete Role? Once Role is deleted, all of its resources and data will be permanently deleted. ') }}

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmDeletion')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete Account') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>


</div>
