

    <div class="grid lg:grid-cols-6 gap-4">
    @push('pagetitle', 'Warehouse')
        <div class="lg:col-start-1 lg:col-span-5 ">

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">{{ $warehouse->name }}</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Total Item Count: {{count($warehouse->product)}}</p>
                </div>


                <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-600">Province</dt>
                            <dd class="mt-1 text-sm text-gray-900 uppercase">{{ $warehouse->district->province->name }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-600">Created Date</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $warehouse->created_at->toFormattedDateString() }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">District</dt>
                            <dd class="mt-1 text-sm text-gray-900 uppercase">

                                {{ $warehouse->district->name ?? ''}}
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-600">Total Products</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{count($warehouse->product)}}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-600 ">Description</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{$warehouse->description?$warehouse->description : 'No description available'}}
                            </dd>
                        </div>
                        <div class="sm:col-span-2">
                            <div class="sm:col-span-2">
                                        <!-- This example requires Tailwind CSS v2.0+ -->
                                <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 ">
                                    @if(count($warehouse->product)>0)
                                        @foreach($warehouse->product as $product)
                                            <li class="col-span-1 bg-white rounded-lg shadow divide-y divide-gray-200 border shadow-md">
                                                <div class="w-full flex items-center justify-between p-6 space-x-6">
                                                    <div class="flex-1 truncate">
                                                        <div class="flex items-center space-x-3">
                                                            <h3 class="text-gray-900 text-sm font-medium ">{{ $product->ingredient->name }}</h3>
                                                            <span class="flex-shrink-0 inline-block px-2 py-0.5 text-green-800 text-xs font-medium bg-green-100 rounded-full">{{$product->ingredient->name .' ( '.$product->amount}} {{$product->unit == 1 ?'Gr':'Kg'}} )</span>
                                                        </div>
                                                        <p class="mt-1 text-gray-500 text-sm truncate">{{ $product->supplier->name }}</p>
                                                    </div>
                                                </div>
                                                <div>
                                                </div>
                                            </li>

                                            <!-- More people... -->


                                @endforeach

                                @else
                                    @component('components.empty-state')
                                        @slot('title')
                                            No Warehouse Found
                                        @endslot

                                        Product
                                    @endcomponent
                                @endif
                                </ul>
                            </div>

                        </div>
                    </dl>
                </div>
            </div>

        </div>

    </div>



