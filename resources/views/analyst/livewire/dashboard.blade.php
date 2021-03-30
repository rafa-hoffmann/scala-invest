<div>

    @if($isOpen)
    <div>
        @include('analyst.livewire.create')
    </div>
    @endif
    @if (session()->has('message'))
    <div id="alert" class="text-white p-2 mb-4 border-0 rounded-full bg-green-500 flex flex-row">
        <span class="flex-1 nline-block align-middle mr-8">
            {{ session('message') }}
        </span>
        <button class="justify-end" onclick="document.getElementById('alert').remove();">
            <span>×</span>
        </button>
    </div>
    @endif
    <div class="p-2 text-right">
        <button
            class='focus:outline-none text-white text-sm py-2.5 px-5 rounded-full bg-green-500 hover:bg-green-600 hover:shadow-lg'
            wire:click="create">Novo Cliente</button>
    </div>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
        <div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Id
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nome
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Editar
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($clients as $client)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{$client->id}}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{$client->name}}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{$client->email}}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ucfirst(strtolower($client->status))}}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a wire:click="edit({{ $client->id }})"
                                                class="text-indigo-600 hover:text-indigo-900" href="#">Editar</a> /
                                            @if($client->status == 'INATIVO')
                                            <a href="#" wire:click.prevent="delete({{$client->id}})"
                                                class="text-indigo-600 hover:text-indigo-900">Restaurar</a>
                                            @else
                                            <a href="#" wire:click.prevent="delete({{$client->id}})"
                                                class="text-indigo-600 hover:text-indigo-900">Excluir</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
