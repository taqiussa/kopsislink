<div class="fixed inset-0 z-10 overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>  
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block overflow-hidden text-left align-middle transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                    <div class="text-center">
                        <h4>
                            Tambah
                        </h4>
                    </div>
                    <div>
                        <div class="py-2">
                            <label for="namaket">Keterangan</label>
                            <input wire:model="idketerangan" type="hidden" class="w-full px-2 py-2 border rounded shadow appearance-non" id="namaket" >
                            <input wire:model="namaket" type="text" class="w-full px-2 py-2 border rounded shadow appearance-non" id="namaket" autocomplete="off">
                            @error('namaket')
                            <h1 class="text-red-500">{{ $message }}</h1>
                            @enderror
                        </div>
                        <div class="py-2">
                            <label>Jenis</label>
                            <select wire:model="jenis" class="form-control">
                                <option value="">Pilih Jenis</option>
                                <option >Pemasukan</option>
                                <option >Pengeluaran</option>
                            </select>
                        </div>
                        <div class="py-2">
                            <label for="harga">Harga</label>
                            <input wire:model="harga" type="text" class="w-full px-2 py-2 border rounded shadow appearance-non" id="harga" autocomplete="off">
                            @error('harga')
                            <h1 class="text-red-500">{{ $message }}</h1>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-white bg-green-600 border border-gray-300 rounded-md shadow-sm hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Simpan
                    </button>
                    <button wire:click="hideModal()" type="button" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
