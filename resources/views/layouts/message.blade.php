@if (Session::has('message'))
    <div x-data="{ shown: false, timeout: null }"
         x-init="@this.on('() => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000);  })"
         x-show.transition.out.opacity.duration.1500ms="shown"
         x-transition:leave.opacity.duration.1500ms
         style="display: none;"
         class="rounded-md bg-green-50 p-4 fixed top-20 z-50 right-10 w-1/4">
        <div class="flex">
            <div class="flex-shrink-0">
                <!-- Heroicon name: solid/check-circle -->
                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800  {{ $attributes->merge(['class' => 'text-sm text-gray-600']) }}">

                    {{ $slot->isEmpty() ? 'Successfully Saved.' : $slot }}
                </p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button @click="shown = !shown" type="button" class="inline-flex bg-green-50 rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-50 focus:ring-green-600">
                        <span class="sr-only">Dismiss</span>
                        <!-- Heroicon name: solid/x -->
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

@endif

@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible show flex items-center mb-2" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>
        {{session('error')}}
        <button type="button" class="btn-close text-red-600	" data-tw-dismiss="alert" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
@endif
{{--<div--}}
{{--    id="success-notification-content"--}}
{{--    class="toastify-content hidden flex"--}}
{{-->--}}
{{--    <svg xmlns="http://www.w3.org/2000/svg"--}}
{{--         width="24" height="24" viewBox="0 0 24 24"--}}
{{--         fill="none" stroke="currentColor" stroke-width="2"--}}
{{--         stroke-linecap="round" stroke-linejoin="round" icon-name="check-circle" class="lucide lucide-check-circle text-success" data-lucide="check-circle">--}}
{{--        <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>--}}
{{--        <polyline points="22 4 12 14.01 9 11.01"></polyline></svg>--}}
{{--    <div class="ml-4 mr-4">--}}
{{--        <div class="font-medium">Success!</div>--}}
{{--        <div class="text-slate-500 mt-1">--}}
{{--          {{session('success')}}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div--}}
{{--    id="failed-notification-content"--}}
{{--    class="toastify-content hidden flex"--}}
{{-->--}}
{{--    <i class="text-danger" data-lucide="x-circle"></i>--}}
{{--    <div class="ml-4 mr-4">--}}
{{--        <div class="font-medium">Failed!</div>--}}
{{--        <div class="text-slate-500 mt-1">--}}
{{--             {{session('error')}}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
