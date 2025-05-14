<x-filament-panels::page>
    <div x-data="{ showModal: false }">
        <x-filament-panels::form wire:submit="save">
            {{ $this->form }}
            <div class="text-sm text-gray-600 mt-4">
                <button type="button" @click="showModal = true" class="text-primary-600 underline">
                    Хувийн мэдээлэл ашиглах тухай
                </button>
            </div>

            <x-filament-panels::form.actions 
                :actions="$this->getFormActions()"
            /> 
        </x-filament-panels::form>
        <div 
            x-show="showModal" 
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            x-cloak
        >
            <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 relative">
                <h2 class="text-lg font-semibold mb-4">Хувийн мэдээлэл ашиглах</h2>
                <div class="max-h-[60vh] overflow-y-auto text-sm text-gray-700">
                    <p>
                    Хувийн мэдээлэл хамгаалах мэдэгдэл
                    Таны бөглөсөн нэр, утасны дугаар, и-мэйл хаяг зэрэг хувийн мэдээллийг бид зөвхөн таны захиалгыг баталгаажуулах,
                    хөгжүүлэлт хийх, үйлчилгээг сайжруулах зорилгоор ашиглана. Энэхүү мэдээлэл нь гуравдагч этгээдэд 
                    дамжуулагдахгүй бөгөөд мэдээллийн аюулгүй байдлыг чанд сахина.
                    </p>
                </div>

                <div class="mt-6 text-right">
                    <button @click="showModal = false" class="text-sm text-white bg-primary-600 px-4 py-2 rounded">
                        Хаах
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>
