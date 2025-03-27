@extends('cms.layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Tambah Dana Desa</h1>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form method="POST" action="{{ route('dana.store') }}" class="space-y-6" enctype="multipart/form-data" autocomplete="off">
            @csrf
            
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-6"> <!-- Left Column -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Anggaran</label>
                        <input type="number" name="tahun_anggaran" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500" required autocomplete="off">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sumber Anggaran</label>
                        <select name="sumber_anggaran" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500" required autocomplete="off">
                            <option value="">Pilih Sumber Anggaran</option>
                            <option value="DANA DESA (DD)">DANA DESA (DD)</option>
                            <option value="ALOKASI DANA DESA (ADD)">ALOKASI DANA DESA (ADD)</option>
                            <option value="Pendapatan Asli Daerah (PAD)">Pendapatan Asli Daerah (PAD)</option>
                            <option value="BK PROVINSI">BK PROVINSI</option>
                            <option value="BK KABUPATEN/KOTA">BK KABUPATEN/KOTA</option>
                            <option value="Pendapatan Asli Desa (PADes)">Pendapatan Asli Desa (PADes)</option>
                            <option value="HIBAH">HIBAH</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nominal</label>
                        <input type="text" id="nominal_display" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500" required autocomplete="off">
                        <input type="hidden" name="nominal" id="nominal_actual" autocomplete="off">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pencairan</label>
                        <input type="date" name="tgl_pencairan" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500" required autocomplete="off">
                    </div>
                </div>

                <div class="space-y-6"> <!-- Right Column -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Pencairan (%)</label>
                        <input type="number" name="status_pencairan" min="0" max="100" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500" required readonly autocomplete="off">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Dana Masuk</label>
                        <input type="text" id="dana_masuk_display" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500" required autocomplete="off">
                        <input type="hidden" name="dana_masuk" id="dana_masuk_actual" autocomplete="off">
                    </div>

                    <div class="hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Dana Terpakai</label>
                        <input type="text" id="dana_terpakai_display" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500" value="Rp 0" readonly autocomplete="off">
                        <input type="hidden" name="dana_terpakai" id="dana_terpakai_actual" value="0" autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Dokumentasi</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="photos" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                <span>Upload foto</span>
                                <input id="photos" name="photos[]" type="file" class="sr-only" accept="image/*" multiple>
                            </label>
                            <p class="pl-1">atau drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, JPEG hingga 4 foto</p>
                    </div>
                </div>
                <div id="image-preview" class="grid grid-cols-2 gap-4 mt-4"></div>
            </div>

            <div class="flex justify-end space-x-3 mt-6">
                <a href="{{ route('dana.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(angka);
    }

    function parseRupiah(rupiahString) {
        return parseInt(rupiahString.replace(/[^0-9]/g, ''));
    }

    function setupMoneyInput(displayId, actualId) {
        const displayInput = document.getElementById(displayId);
        const actualInput = document.getElementById(actualId);

        displayInput.addEventListener('input', function(e) {
            let value = parseRupiah(this.value);
            if (!isNaN(value)) {
                this.value = formatRupiah(value);
                actualInput.value = value;
                
                // Calculate status_pencairan when nominal or dana_masuk changes
                if (displayId === 'nominal_display' || displayId === 'dana_masuk_display') {
                    calculateStatusPencairan();
                }
            }
        });
    }

    function calculateStatusPencairan() {
        const nominal = parseFloat(document.getElementById('nominal_actual').value) || 0;
        const danaMasuk = parseFloat(document.getElementById('dana_masuk_actual').value) || 0;
        
        if (nominal > 0) {
            const percentage = (danaMasuk / nominal) * 100;
            document.querySelector('input[name="status_pencairan"]').value = percentage.toFixed(2);
        }
    }

    // Initialize all money inputs
    document.addEventListener('DOMContentLoaded', function() {
        setupMoneyInput('nominal_display', 'nominal_actual');
        setupMoneyInput('dana_masuk_display', 'dana_masuk_actual');
        setupMoneyInput('dana_terpakai_display', 'dana_terpakai_actual');
        
        // Make status_pencairan input readonly since it's calculated automatically
        document.querySelector('input[name="status_pencairan"]').readOnly = true;
    });

    document.getElementById('photos').addEventListener('change', function(e) {
        const preview = document.getElementById('image-preview');
        preview.innerHTML = ''; // Clear existing previews
        
        // Limit to 4 files
        const files = Array.from(e.target.files).slice(0, 4);
        
        files.forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative aspect-square';
                div.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-full rounded object-contain bg-gray-100">
                    <div class="absolute top-0 right-0 m-1">
                        <button type="button" class="remove-image bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                `;
                preview.appendChild(div);
            }
            reader.readAsDataURL(file);
        });
    });

    // Remove image when clicking the remove button
    document.getElementById('image-preview').addEventListener('click', function(e) {
        if (e.target.closest('.remove-image')) {
            e.target.closest('.relative').remove();
        }
    });
</script>
@endpush
@endsection
