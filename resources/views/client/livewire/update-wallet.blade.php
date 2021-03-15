<div>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="flex flex-wrap -mx-1 overflow-hidden">
            <div class="my-1 px-1 w-full overflow-hidden md:w-1/2 xl:w-1/3">
                <x-label for="email" :value="__('Nome')" />
                <x-input id="email" class="w-full mt-1" type="email" name="email" :value="old('email')" required
                    autofocus />
            </div>
            <div class="my-1 px-1 w-full overflow-hidden md:w-1/2 xl:w-1/3 justify-self-end">
                <button class="py-3 mt-4 bg-green-700 hover:bg-green-900 text-white font-bold px-4 rounded-full"
                    wire:click="addStock">
                    {{ __('Adicionar Ativo') }}
                </button>
            </div>
        </div>
        @for ($i = 0; $i < $stocksCount; $i++) <div class="flex space-y-2 flex-col pb-2">
            <div class="flex flex-wrap -mx-1 overflow-hidden">

                <div class="my-1 px-1 w-full overflow-hidden md:w-1/2 xl:w-1/3">
                    <x-label for="stock{{$i}}" :value="__('Ativo')" />
                    <select id="stock{{$i}}" name="selectedStocks[]"
                        class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        @foreach ($stocks as $stock)
                        <option>{{$stock->symbol}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="my-1 px-1 w-full overflow-hidden md:w-1/2 xl:w-1/3">
                    <x-label for="objetivo{{$i}}" :value="__('Objetivo')" />
                    <x-input id="objetivo{{$i}}" class="py-2 px-3 w-full" type="number" min="1" max="100" step=".01"
                        name="objetivo{{$i}}" required />
                </div>

                <div class="my-1 px-1 w-full overflow-hidden md:w-1/2 xl:w-1/3">
                    <div class="flex justify-end">
                        <button class="py-3 mt-4 bg-red-700 hover:bg-red-900 text-white font-bold px-10 rounded-full">
                            {{ __('Remover') }}
                        </button>
                    </div>
                </div>
            </div>
            @endfor
    </form>
</div>
