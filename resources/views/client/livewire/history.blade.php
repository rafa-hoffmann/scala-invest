<div>
    <div class="flex flex-wrap -mx-1 overflow-hidden">
        <div class="my-1 py-4 px-8 w-full overflow-hidden md:w-1/2">
            <h1 class="text-3xl font-bold pt-8 lg:pt-0 ml-2">{{$wallet->name}}</h1>
        </div>
    </div>
    <div class="flex flex-col">
        <div class="py-4 px-8 align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ativo
                            </th>
                            <th scope="col"
                                class="pr-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                Ação
                            </th>
                            <th scope="col"
                                class="pr-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Quantidade
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Data
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($this->wallet->histories as $history)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                {{$history->stock->symbol}}
                            </td>
                            <td class="pr-6 py-4 whitespace-nowrap">
                                @if($history->acao == "COMPRADO")
                                <div class="p-2 rounded-full bg-green-500 text-white font-bold text-center">{{$history->acao}}</div>
                                @else
                                <div class="p-2 rounded-full bg-red-500 text-white font-bold text-center">{{$history->acao}}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                {{$history->quantidade}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                {{$history->created_at->format('d/m/Y h:i')}}
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
