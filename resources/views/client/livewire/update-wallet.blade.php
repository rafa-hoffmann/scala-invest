<div class="p-2">
    <div class="flex flex-wrap overflow-hidden">
        <div class="my-1 px-1 w-full overflow-hidden md:w-1/2">
            <x-label for="name" :value="__('Nome')" />
            <x-input id="name" class="w-full xl:w-9/12 mt-1" type="text" name="name" :value="old('name')" required
                autofocus wire:model="name" />
            @error('name')
            <div class="text-white p-2 my-2 border-0 rounded-full bg-red-500 flex flex-row">
                <span class="flex-1 inline-block align-middle mr-8">
                    {{ $message }}
                </span>
            </div>
            @enderror
        </div>
    </div>
    @if (session()->has('error'))
    <div id="alert" class="text-white p-2 my-2 border-0 rounded-full bg-red-500 flex flex-row">
        <span class="flex-1 inline-block align-middle mr-8">
            {{ session('error') }}
        </span>
    </div>
    @endif
    <div class="flex flex-col">
        <div class="py-2 align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 p-4">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ativo
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Objetivo
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <a wire:click="addStock()" href="#"
                                    class="text-indigo-600 hover:text-indigo-900">Adicionar Ativo</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($this->wallet->stocks as $stock)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select id="stock{{$stock->pivot->id}}" wire:model="selectedStock.{{$stock->pivot->id}}"
                                    class="block w-full border border-gray-300 bg-white rounded-full shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach ($dbStocks as $dbStock)
                                    <option value="{{$dbStock->symbol}}">{{$dbStock->symbol}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <x-input id="objetivo{{$stock->pivot->id}}" class="w-full rounded-r-none"
                                        type="number" min="0.00" max="100.00" step=".01" wire:model="selectedGoals.{{$stock->pivot->id}}" required />
                                    <span
                                        class="inline-flex items-center px-3 rounded-r-full border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                        %
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a wire:click="removeStock({{$stock->pivot->id}})"
                                    class="text-indigo-600 hover:text-indigo-900 uppercase text-xs font-medium tracking-wider"
                                    href="#">Remover</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="flex w-full justify-center my-10 space-x-5">
        <button class="bg-red-700 hover:bg-red-900 text-white font-bold py-2 px-4 rounded-full w-2/12" wire:click="removeWallet">
            Excluir Carteira
        </button>
        <a class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded-full w-2/12 text-center" href="{{route('dashboard')}}">
            Voltar
        </a>
    </div>
    <div id="autoSave" class="text-white p-2 my-2 border border-blue-500 bg-blue-400 rounded-full flex flex-row">
        <span class="flex-1 inline-block align-middle mr-8">
            As alterações são salvas automaticamente.
        </span>
        <button class="justify-end mr-5" onclick="document.getElementById('autoSave').remove();">
            <span>×</span>
        </button>
    </div>
</div>
