<div>
    <div class="flex flex-wrap w-full mt-5">
        <div class="w-full px-4 lg:w-2/12 overflow-hidden">
            <div class="flex flex-col space-y-2 px-4">
                <a class="bg-green-700 hover:bg-green-900 text-white font-bold py-2 px-4 rounded-full text-center"
                    href="{{route('wallet.update')}}">
                    Nova Carteira
                </a>
            </div>
        </div>
    </div>
    @foreach($wallets as $wallet)
    <div class="flex flex-wrap overflow-hidden items-center my-8 lg:-mx-4">
        <div class="w-full overflow-hidden lg:my-4 lg:px-4 lg:w-10/12">
            <div class="text-center lg:text-left">
                <h1 class="text-3xl font-bold pt-8 lg:pt-0 ml-2">{{empty($wallet->name) ? 'Carteira' : $wallet->name}}
                </h1>
                <div class="pt-3 border-b-2 border-green-500 opacity-50"></div>
                <div class="flex flex-col">
                    <div class="py-2 align-middle inline-block min-w-full">
                        <table class="min-w-full divide-y divide-gray-200 m-2 shadow-md rounded-md">
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
                                        Dist. Do Objetivo
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
                                        {{($wallet->soma_patrimonio == 0)?0.00:number_format($stock->patrimonio_att / $wallet->soma_patrimonio * 100 , 2, ',', '.')}}%
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{number_format($stock->pivot->goal, 2, ',', '.')}}%
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{number_format($stock->pivot->goal_distance,2,',','.')}}%
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full overflow-hidden lg:my-4 lg:px-4 lg:w-2/12">
            <div class="flex flex-col space-y-2 py-8 px-4">
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
    <div class="flex flex-wrap w-full overflow-hidden lg:-mx-2">
        <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/2">
            <div class="block h-80 pb-5">
                <h1 class="text-xl font-bold pt-8 lg:pt-0 ml-2">Atual</h1>
                <div id="currentChart{{$wallet->id}}" class="max-h-80"></div>
            </div>
        </div>
        <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-1/2">
            <div class="block h-80 pb-5">
                <h1 class="text-xl font-bold pt-8 lg:pt-0 ml-2">Recomendado</h1>
                <div id="recommendedChart{{$wallet->id}}" class="max-h-80"></div>
            </div>
        </div>

    </div>
    <div class="w-full overflow-hidden lg:my-2 lg:px-2 lg:w-full">
        <div class="block h-80 pb-5">
            <h1 class="text-xl font-bold pt-8 lg:pt-0 ml-2">Setores</h1>
            <div id="sectorChart{{$wallet->id}}" class="max-h-80"></div>
        </div>
    </div>
    <script>
        var optionsCurrentChart = {
                    series: @json($stockChart[$wallet->id]['data']),
                    chart: {
                        type: 'donut',
                        height: '100%'
                    },
                    labels: @json($stockChart[$wallet->id]['legends']),
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 500
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

            new ApexCharts(document.querySelector("#currentChart{{$wallet->id}}"), optionsCurrentChart).render();

            var optionsRecommendedChart = {
                    series: @json($recommendedChart[$wallet->id]['data']),
                    chart: {
                        type: 'donut',
                        height: '100%'
                    },
                    dataLabels: {
                        enabled: false
                    },
                    labels: @json($recommendedChart[$wallet->id]['legends']),
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 500
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

            new ApexCharts(document.querySelector("#recommendedChart{{$wallet->id}}"), optionsRecommendedChart).render();

            var optionsSectorChart = {
                    series: @json($sectorChart[$wallet->id]['data']),
                    chart: {
                        type: 'donut',
                        height: '100%'
                    },
                    labels: @json($sectorChart[$wallet->id]['legends']),
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 500
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

            new ApexCharts(document.querySelector("#sectorChart{{$wallet->id}}"), optionsSectorChart).render();
    </script>
</div>
@endforeach
</div>
