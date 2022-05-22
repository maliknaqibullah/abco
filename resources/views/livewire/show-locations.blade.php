<div class="sm:grid grid-cols-2 gap-2">
    <div class="mt-3">
        <x-jet-label for="name" value="{{ __('Select Province') }}" />
        <select wire:model="selectedProvince"  autocomplete="province" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            <option value="">-- Choose Province --</option>
            @foreach ($provinces as $province)
                <option value="{{ $province->id }}">{{ Str::title($province->name) }}</option>
            @endforeach
        </select>
        <x-jet-input-error for="province" class="mt-2" />

    </div>
    <div class="mt-3">
        <x-jet-label for="name" value="{{ __('Select District') }}" />
        <select wire:model="selectedDistrict" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            @if ($districts->count() == 0)
                <option value="">-- Choose Province first --</option>
            @else
                <option value="">-- Choose District --</option>

                @foreach ($districts as $district)

                    <option value="{{ $district->id }}">{{ Str::title($district->name) }}</option>
                @endforeach
            @endif
        </select>
        <x-jet-input-error for="district" class="mt-2" />


    </div>

</div>

