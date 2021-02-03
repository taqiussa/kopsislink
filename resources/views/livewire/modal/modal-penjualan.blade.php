<div class="fixed inset-0 z-10 overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>  
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block overflow-hidden text-left align-middle transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                <div class="text-center">
                    <h4 class="text-lg">
                        Penjualan Barang
                    </h4>
                </div>
                <div>
                    <form>
                        <div class="flex items-center mb-2 space-x-4">
                            <div class="flex flex-col">
                                <label class="leading-loose">Tanggal</label>
                                <div class="relative text-gray-400 focus-within:text-gray-600">
                                    <input wire:model.defer='tanggal' type="date" class="w-full py-2 pl-2 pr-4 text-gray-600 border border-gray-300 rounded-md focus:ring-gray-500 focus:border-gray-900 sm:text-sm focus:outline-none">
                                    @error('tanggal')
                                    <h1 class="text-red-500">{{ $message }}</h1>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mb-2 space-x-4">
                            <div class="flex flex-col">
                                <div class="relative text-gray-400 focus-within:text-gray-600">
                                    <input wire:model="idpenjualan" type="hidden" class="w-full py-2 pl-2 pr-4 text-gray-600 border border-gray-300 rounded-md focus:ring-gray-500 focus:border-gray-900 sm:text-sm focus:outline-none" id="idpembelian" >
                                    
                                    <select wire:model="barang_id" class="w-full py-2 pl-2 pr-4 text-gray-600 border border-gray-300 rounded-md focus:ring-gray-500 focus:border-gray-900 sm:text-sm focus:outline-none">
                                        <option value="">Pilih Barang</option>
                                        @foreach ($barang as $p)
                                        <option value="{{ $p->id }}">{{ $p->namabarang }}</option>
                                        @endforeach
                                    </select>
                                    @error('barang_id')
                                    <h1 class="text-red-500">{{ $message }}</h1>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <input wire:model="stok" type="text" class="w-full py-2 pl-2 pr-4 text-gray-500 bg-gray-200 border border-gray-600 rounded-md sm:text-sm focus:outline-none focus:ring-gray-500" id="stok" readonly>
                            </div>
                            <div class="flex flex-col">
                                <div class="relative text-gray-400 focus-within:text-gray-600">
                                    <input wire:model='jumlah' placeholder="Jumlah" type="text" class="w-full py-2 pl-2 pr-4 text-gray-600 border border-gray-300 rounded-md focus:ring-gray-500 focus:border-gray-900 sm:text-sm focus:outline-none">
                                    @error('jumlah')
                                    <h1 class="text-red-500">{{ $message }}</h1>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <button wire:click.prevent="add()" type="button" class="w-full py-2 pl-2 pr-4 text-white bg-green-600 border border-gray-300 rounded-md hover:bg-green-800 focus:ring-gray-500 focus:border-gray-900 sm:text-sm focus:outline-none">
                                    Add
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="text-red-700">
                        {{ $info }}
                    </div>
                </div>
                {{-- Table --}}
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Nama Barang
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Jumlah
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Harga
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Total
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($transaksi as $t)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                {{ $t->namabarang }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                {{ $t->jumlah }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                {{ 'Rp ' . number_format($t->harga, 0, '', '.') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            <div class="flex items-center">
                                                {{ 'Rp ' . number_format($t->total, 0, '', '.')}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                            <div class="flex items-center">
                                                <a role="button" wire:click.prevent="delete_t({{ $t->id }})" href="#"><i class="text-red-500 fa fa-16px fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="my-3">
                    <div class="flex items-center mb-2 space-x-4">
                        <div class="flex flex-col">
                            <div class="relative focus-within:text-gray-600">
                                <input readonly type="text" value="TOTAL" class="w-full py-2 pl-2 pr-4 font-bold text-black rounded-md focus:ring-gray-500 focus:border-gray-900 sm:text-sm focus:outline-none">
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="relative text-black focus-within:text-gray-600">
                                <input wire:model='total' placeholder="Rp. 0" type="text" class="w-full py-2 pl-2 pr-4 text-right text-black border border-gray-300 rounded-md font-weight-bold focus:ring-gray-500 focus:border-gray-900 sm:text-sm focus:outline-none" readonly>
                                    @error('total')
                                    <h1 class="text-red-500">{{ $message }}</h1>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center mb-2 space-x-4">
                        <div class="flex flex-col">
                            <div class="relative text-black focus-within:text-gray-600">
                                <input type="text" value="PEMBAYARAN" class="w-full py-2 pl-2 pr-4 font-bold text-black rounded-md focus:ring-gray-500 focus:border-gray-900 sm:text-sm focus:outline-none" readonly>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="relative text-black focus-within:text-gray-600">
                                <input wire:model='pembayaran' placeholder="Rp. 0" type="text" class="w-full py-2 pl-2 pr-4 text-right text-black border border-gray-300 rounded-md font-weight-bold focus:ring-gray-500 focus:border-gray-900 sm:text-sm focus:outline-none">
                                    @error('pembayaran')
                                    <h1 class="text-red-500">{{ $message }}</h1>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center mb-2 space-x-4">
                        <div class="flex flex-col">
                            <div class="relative text-black focus-within:text-gray-600">
                                <input type="text" value="KEMBALIAN" class="w-full py-2 pl-2 pr-4 font-bold text-black rounded-md focus:ring-gray-500 focus:border-gray-900 sm:text-sm focus:outline-none" readonly>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="relative text-black focus-within:text-gray-600">
                                <input wire:model='kembalian' placeholder="Rp. 0" type="text" class="w-full py-2 pl-2 pr-4 text-right text-black border border-gray-300 rounded-md font-weight-bold focus:ring-gray-500 focus:border-gray-900 sm:text-sm focus:outline-none" readonly>
                                    @error('kembalian')
                                    <h1 class="text-red-500">{{ $message }}</h1>
                                    @enderror
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Of Table --}}
                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-white bg-green-600 border border-gray-300 rounded-md shadow-sm hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Simpan
                    </button>
                    <button wire:click="hideModal()" type="button" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
