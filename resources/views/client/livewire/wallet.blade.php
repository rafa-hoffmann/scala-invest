<div>
    <div class="flex flex-wrap w-full justify-end mt-5">
        <div class="px-2 w-2/12 overflow-hidden">
            <div class="flex flex-col space-y-2">
                <a class="bg-green-700 hover:bg-green-900 text-white font-bold py-2 px-10 rounded-full"
                    href="{{route('wallet.update')}}">
                    Nova Carteira
                </a>
            </div>
        </div>
    </div>
    @foreach($wallets as $wallet)
    <div class="flex flex-wrap overflow-hidden items-center shadow-md">
        <div class="my-2 w-10/12 overflow-hidden">
            <div class="text-center lg:text-left">
                <h1 class="text-3xl font-bold pt-8 lg:pt-0 ml-2">{{empty($wallet->name) ? 'Carteira' : $wallet->name}}</h1>
                <div class="pt-3 border-b-2 border-green-500 opacity-50"></div>
                <div class="flex flex-col">
                    <div class="py-2 align-middle inline-block min-w-full">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Ativo
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Setor
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Quantidade
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Cotação Atual
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Patrimônio Atualizado
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Participação Atual
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Objetivo
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Distância do Objetivo
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($wallet->stocks as $stock)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{$stock->symbol}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{$stock->sector}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{$stock->pivot->comprado}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        R$
                                        {{$stock->last_quote ? number_format($stock->last_quote->price, 2, ',', '.') : "--"}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        R$ {{number_format($stock->patrimonio_att, 2, ',', '.')}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{($wallet->soma_patrimonio == 0)?0.00:number_format($stock->patrimonio_att / $wallet->soma_patrimonio * 100 , 2, ',', '.')}}
                                        %
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{number_format($stock->pivot->goal, 2, ',', '.')}}%
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{number_format($stock->pivot->goal_distance,2,',','.')}} %
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-2 px-2 w-2/12 overflow-hidden">
            <div class="flex flex-col space-y-2 pt-8 pb-8">
                <a class="bg-green-700 hover:bg-green-900 text-white font-bold py-2 px-4 rounded-full text-center"
                    href="{{route('wallet.update', ['id' => $wallet->id])}}">
                    Atualizar
                </a>
                <a class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded-full text-center"
                    href="{{route('wallet.buysell', ['id' => $wallet->id])}}">
                    Compra / Venda
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
