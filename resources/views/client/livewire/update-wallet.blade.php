<div>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="flex flex-wrap -mx-1 overflow-hidden">
            <div class="my-1 px-1 w-full overflow-hidden md:w-1/2">
                <x-label for="email" :value="__('Nome')" />
                <x-input id="email" class="w-full xl:w-9/12 mt-1" type="email" name="email" :value="old('email')"
                    required autofocus />
            </div>
        </div>
        @if (session()->has('error'))
        <div id="alert" class="text-white p-2 my-2 border-0 rounded bg-red-500 flex flex-row">
            <span class="flex-1 nline-block align-middle mr-8">
                {{ session('error') }}
            </span>
        </div>
        @endif
        <div class="flex flex-col">
            <div class="py-2 align-middle inline-block min-w-full">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="pr-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ativo
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Objetivo
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <a wire:click="addStock()" href="#"
                                        class="text-indigo-600 hover:text-indigo-900">Adicionar</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($this->wallet->stocks as $stock)
                            <tr>
                                <td class="pr-6 py-4 whitespace-nowrap">
                                    <select id="stock{{$stock->pivot->id}}"
                                        wire:model="selectedStock.{{$stock->pivot->id}}"
                                        class="block w-full border border-gray-300 bg-white rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        @foreach ($dbStocks as $dbStock)
                                        @if($stock->symbol == $dbStock->symbol)
                                        <option selected>{{$dbStock->symbol}}</option>
                                        @else
                                        <option>{{$dbStock->symbol}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <x-input id="objetivo{{$stock->pivot->id}}" class="w-full rounded-r-none"
                                            type="number" min="0" max="100" step=".01"
                                            value="{{$stock->pivot->goal}}"
                                            wire:model="selectedGoals.{{$stock->pivot->id}}"
                                            required />
                                        <span
                                            class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
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
    </form>
</div>
