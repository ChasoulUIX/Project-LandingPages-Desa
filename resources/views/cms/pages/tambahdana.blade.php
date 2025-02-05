@extends('cms.layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Tambah Dana Desa</h1>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form method="POST" action="{{ route('dana.store') }}" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Anggaran</label>
                <input type="number" name="tahun_anggaran" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Sumber Anggaran</label>
                <input type="text" name="sumber_anggaran" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nominal</label>
                <input type="text" id="nominal_display" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500" required>
                <input type="hidden" name="nominal" id="nominal_actual">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pencairan</label>
                <input type="date" name="tgl_pencairan" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status Pencairan (%)</label>
                <input type="number" name="status_pencairan" min="0" max="100" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Dana Masuk</label>
                <input type="text" id="dana_masuk_display" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500" required>
                <input type="hidden" name="dana_masuk" id="dana_masuk_actual">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Dana Terpakai</label>
                <input type="text" id="dana_terpakai_display" class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500" required>
                <input type="hidden" name="dana_terpakai" id="dana_terpakai_actual">
            </div>

            <div class="flex justify-end space-x-3">
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
            }
        });
    }

    // Initialize all money inputs
    document.addEventListener('DOMContentLoaded', function() {
        setupMoneyInput('nominal_display', 'nominal_actual');
        setupMoneyInput('dana_masuk_display', 'dana_masuk_actual');
        setupMoneyInput('dana_terpakai_display', 'dana_terpakai_actual');
    });
</script>
@endpush
@endsection
