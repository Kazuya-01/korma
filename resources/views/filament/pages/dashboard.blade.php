<x-filament::page>
    {{-- Widget atas --}}
    <x-filament::widgets :widgets="$this->getHeaderWidgets()" class="mb-6" />

    {{-- Widget bawah --}}
    <x-filament::widgets :widgets="$this->getFooterWidgets()" />
</x-filament::page>
