<div>
    <div class="flex flex-wrap -mx-1 overflow-hidden">
        <div class="my-1 py-4 px-8 w-full overflow-hidden md:w-1/2">
            <h1 class="text-3xl font-bold pt-8 lg:pt-0 ml-2">{{$name}}</h1>
        </div>
        <div class="my-1 right-0 w-full overflow-hidden md:w-1/2">
            <x-label for="valor" :value="__('Valor')" />
            <x-input class='right-0' id="valor" class="w-full xl:w-9/12 mt-1" type="number" name="valor"
                :value="old('valor')" wire:model="valor" />
            @error('valor')
            <div class="text-white p-2 my-2 border-0 rounded-full bg-red-500 flex flex-row">
                <span class="flex-1 inline-block align-middle mr-8">
                    {{ $message }}
                </span>
            </div>
            @enderror
        </div>
    </div>
    @if (session()->has('error'))
    <div id="alert" class="text-white p-2 m-2 border-0 rounded-full bg-red-500 flex flex-row">
        <span class="flex-1 inline-block align-middle mr-8">
            {{ session('error') }}
        </span>
    </div>
    @endif
    @if (session()->has('success'))
    <div id="alert" class="text-white p-2 m-2 border-0 rounded-full bg-green-500 flex flex-row">
        <span class="flex-1 inline-block align-middle mr-8">
            {{ session('success') }}
        </span>
    </div>
    @endif
    <div class="flex flex-col">
        <div class="py-4 px-8 align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ativo
                            </th>
                            <th scope="col"
                                class="pr-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Cotação
                            </th>
                            <th scope="col"
                                class="pr-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Patrimônio
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Part
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Objetivo
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Distancia
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Quantidade
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Indicação
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ações
                            </th>

                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($this->wallet->stocks as $stock)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{$stock->symbol}}
                            </td>
                            <td class="pr-6 py-4 whitespace-nowrap">
                                R$ {{$stock->last_quote->price}}
                            </td>
                            <td class="pr-6 py-4 whitespace-nowrap">
                                R$ {{number_format($stock->patrimonio_att, 2, ',', '.')}}
                            </td>
                            <td class="pr-6 py-4 whitespace-nowrap">
                                {{($wallet->soma_patrimonio == 0)?0.00:number_format($stock->patrimonio_att / $wallet->soma_patrimonio * 100 , 2, ',', '.')}}%
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{$stock->pivot->goal}}%
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{number_format($stock->pivot->goal_distance,2,',','.')}}%
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{$stock->pivot->comprado}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <x-input id="quantidade{{$stock->pivot->id}}" class="w-full" type="number" min="0"
                                        step="1" value="0" wire:model="selectedQnt.{{$stock->pivot->id}}" required />
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{$sugestions[$stock->pivot->id]??0}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a wire:click="comprarStock({{$stock->pivot->id}})"
                                    class="text-indigo-600 hover:text-indigo-900 uppercase text-xs font-medium tracking-wider"
                                    href="#">Comprar</a>
                                /
                                <a wire:click="venderStock({{$stock->pivot->id}})"
                                    class="text-indigo-600 hover:text-indigo-900 uppercase text-xs font-medium tracking-wider"
                                    href="#">Vender</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="flex w-full justify-center my-10 space-x-5">
        <a class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded-full w-2/12 text-center"
            href="{{route('dashboard')}}">
            Voltar
        </a>
    </div>
</div>
