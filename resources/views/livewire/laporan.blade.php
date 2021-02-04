<div class="card card-body">
    <div class="mb-2 -mx-3 md:flex">
        <div class="px-3 mb-6 md:w-1/2 md:mb-0">
            <label class="block mb-2 text-xs font-bold tracking-wide uppercase text-grey-darker" for="grid-state">
                dari tanggal
                </label>
                <input type="date" wire:model.defer="tanggal1">
        </div>
        <div class="px-3 mb-6 md:w-1/2 md:mb-0">
            <label class="block mb-2 text-xs font-bold tracking-wide uppercase text-grey-darker" for="grid-state">
                sampai dengan
                </label>
                <input type="date" wire:model.defer="tanggal2">
        </div>
        <div class="px-3 md:w-1/2">
            <label class="block mb-2 text-xs font-bold tracking-wide uppercase text-grey-darker" for="grid-state">
                Pilih Laporan
                </label>
                <select wire:model="pilih" class="w-full px-2 py-2 border rounded shadow appearance-non">
                    <option value="">Pilih Laporan</option>
                    <option value="Pembelian">Pembelian</option>
                    <option value="Penjualan">Penjualan</option>
                </select>
        </div>
    </div>
    <!-- component -->
    <div class="flex items-center">
        <div class="w-full py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col w-full mb-2 space-y-2 lg:flex-row lg:space-x-2 lg:space-y-0 lg:mb-4">
                <div class="w-full lg:w-1/4">
                    <div class="w-full p-4 bg-white border border-gray-100 rounded-lg shadow-warning widget dark:bg-gray-900 dark:border-gray-800">
                        <div class="flex flex-row items-center justify-between">
                            <div class="flex flex-col">
                                <div class="text-xs font-light text-gray-500 uppercase">
                                    Jumlah {{ $this->pilih }}
                                </div>
                                <div class="text-xl font-bold">
                                    {{ $jumlah }}
                                </div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="text-gray-500 stroke-current" viewBox="0 0 16 16">
                                <path d="M11.354 6.354a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                                <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-1/4">
                    <div class="w-full p-4 bg-white border border-gray-100 rounded-lg shadow-warning widget dark:bg-gray-900 dark:border-gray-800">
                        <div class="flex flex-row items-center justify-between">
                            <div class="flex flex-col">
                                <div class="text-xs font-light text-gray-500 uppercase">
                                    Total {{ $this->pilih }}
                                </div>
                                <div class="text-xl font-bold">
                                    Rp. {{ number_format($total, 0, ".", ".") . ",-" }}
                                </div>
                            </div>
                            <svg class="text-gray-500 stroke-current" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                <<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
                @if ($this->pilih == "Penjualan")
                    <div class="w-full lg:w-1/4">
                        <div class="w-full p-4 bg-white border border-gray-100 rounded-lg shadow-warning widget dark:bg-gray-900 dark:border-gray-800">
                            <div class="flex flex-row items-center justify-between">
                                <div class="flex flex-col">
                                    <div class="text-xs font-light text-gray-500 uppercase">
                                        Total Laba
                                    </div>
                                    <div class="text-xl font-bold">
                                        Rp. {{ number_format($laba, 0, ".", ".") . ",-" }}
                                    </div>
                                </div>
                                <svg class="text-gray-500 stroke-current" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                    <<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
