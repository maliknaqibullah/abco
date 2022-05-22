
<div  class="mt-2">
@push('pagetitle', 'Dashboard')
    <!-- State cards -->
    <div class="grid grid-cols-1 gap-8 p-4 lg:grid-cols-2 xl:grid-cols-4">
        <!-- Value card -->
        <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
            <div>
                <h6
                    class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light"
                >
                    Total Schools
                </h6>
                <span class="text-xl font-semibold">
                     {{count($schools)}}
                </span>
                <span class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md">
                        {{ \App\Models\School::sum('male','female') }} STD
                </span>
            </div>
            <div>
                    <span>
                      <svg class="w-12 h-12 text-gray-300 dark:text-primary-dark"
                           fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                              <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                              <path
                                  d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                            </svg>
                    </span>
            </div>
        </div>

        <!-- Users card -->
        <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
            <div>
                <h6
                    class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light"
                >
                    Distributed Bread+
                </h6>
                <span class="text-xl font-semibold"> {{\App\Models\BakeryOrder::sum('distributed_loaves')}}</span>
                <span class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md">
                     {{\App\Models\BakeryOrder::sum('loaves_qty')}}
                    </span>
            </div>
            <div>
                    <span>
                      <svg
                          class="w-12 h-12 text-gray-300 dark:text-primary-dark" fill="none" viewBox="0 0 24 24"
                          stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z"/>
                    </svg>
                    </span>
            </div>
        </div>

        <!-- Orders card -->
        <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
            <div>
                <h6
                    class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light"
                >
                    Total Bakery
                </h6>
                <span class="text-xl font-semibold">{{\App\Models\Bakery::count()}}</span>
                <!--span class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md">
                      +3.1%
                    </span-->
            </div>
            <div>
                    <span>
                      <svg
                          class="w-12 h-12 text-gray-300 dark:text-primary-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
                          <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z" />
                        </svg>
                    </span>
            </div>
        </div>

        <!-- Tickets card -->
        <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
            <div>
                <h6
                    class="text-xs font-medium leading-none tracking-wider text-gray-500 uppercase dark:text-primary-light"
                >
                    Total Warehouses
                </h6>
                <span class="text-xl font-semibold">{{\App\Models\Warehouse::count()}}</span>
                <span class="inline-block px-2 py-px ml-2 text-xs text-green-500 bg-green-100 rounded-md">
                     {{\App\Models\Warehouse::where('status',1)->count()}} Active
                    </span>
            </div>
            <div>
                    <span>
                      <svg
                          class="w-12 h-12 text-gray-300 dark:text-primary-dark"  fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                            </svg>
                    </span>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3">
        <!-- Bar chart card -->
        <div class="col-span-2 bg-white rounded-md dark:bg-darker">
            <!-- Card header -->
            <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Activity Report</h4>
            </div>
            <livewire:livewire-column-chart
                key="{{ $columnChartModel->reactiveKey() }}"
                :column-chart-model="$columnChartModel"
            />

        </div>

        <!-- Doughnut chart card -->
        <div class="bg-white rounded-md dark:bg-darker p-4">
            <!-- Card header -->
            <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Total Ingredients in stock</h4>
            </div>
            <!-- Chart -->
            <livewire:livewire-pie-chart
                key="{{ $pieChartModel->reactiveKey() }}"
                :pie-chart-model="$pieChartModel"
            />
        </div>
    </div>

    <!-- Two grid columns -->
    <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3">
        <!-- Active users chart -->
        <div class="col-span-1 bg-white rounded-md dark:bg-darker">
            <!-- Card header -->
            <div class="p-4 border-b dark:border-primary">
                <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Active users right now</h4>
            </div>
            <p class="p-4">
                <span class="text-2xl font-medium text-gray-500 dark:text-light" id="usersCount">0</span>
                <span class="text-sm font-medium text-gray-500 dark:text-primary">Users</span>
            </p>
            <!-- Chart -->
            <div class="relative p-4">
                <canvas id="activeUsersChart"></canvas>
            </div>
        </div>

        <!-- Line chart card -->
        <div class="col-span-2 bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
            <!-- Card header -->
            <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Line Chart</h4>
            </div>
            <!-- Chart -->
            <livewire:livewire-line-chart
                key="{{ $lineChartModel->reactiveKey() }}"
                :line-chart-model="$lineChartModel"
            />
        </div>
    </div>


</div>
