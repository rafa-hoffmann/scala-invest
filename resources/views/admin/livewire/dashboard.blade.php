<div>
    @if ($isOpen)
    <x-modal>
        <x-slot name="content">
            <form @if($analyst_id==-1) wire:submit.prevent="store" @else wire:submit.prevent="update" @endif>
                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 mb-6">
                            <x-input type="text" class="w-full py-2 px-3" id="name" placeholder="Nome"
                                wire:model="name" />
                            @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="w-full px-3 mb-6">
                            <x-input type="email" class="w-full py-2 px-3" id="email" placeholder="Email"
                                wire:model="email" />
                            @error('email') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="w-full px-3 mb-6">
                            <x-input type="password" class="w-full py-2 px-3" id="password" placeholder="Senha"
                                wire:model="password" />
                            @error('password') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full sm:ml-3 sm:w-auto">
                        <button type="submit"
                            class="inline-flex bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Salvar</button>
                    </span>
                    <span class="mt-3 flex w-full sm:mt-0 sm:w-auto">
                        <button wire:click="closeModal()" type="button"
                            class="inline-flex bg-white hover:bg-gray-200 border border-gray-300 text-gray-500 font-bold py-2 px-4 rounded">Cancelar</button>
                    </span>
                </div>
            </form>
        </x-slot>
    </x-modal>
    @endif
    @if (session()->has('message'))
    <div id="alert" class="text-white p-2 mb-4 border-0 rounded bg-green-500 flex flex-row">
        <span class="flex-1 nline-block align-middle mr-8">
            {{ session('message') }}
        </span>
        <button class="justify-end" onclick="document.getElementById('alert').remove();">
            <span>×</span>
        </button>
    </div>
    @endif
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="flex flex-row-reverse m-3">
            <x-button wire:click="create()" type="button">Criar Analista</x-button>
        </div>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
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
                                        Editar/Excluir
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($analysts as $analyst)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{$analyst->name}}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{$analyst->email}}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($analyst->trashed())
                                        <span
                                            class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Inativo
                                        </span>
                                        @else
                                        <span
                                            class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Ativo
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="#" wire:click.prevent="edit({{$analyst->id}})"
                                            class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                        /
                                        @if($analyst->trashed())
                                        <a href="#" wire:click.prevent="delete({{$analyst->id}})"
                                            class="text-indigo-600 hover:text-indigo-900">Restaurar</a>
                                        @else
                                        <a href="#" wire:click.prevent="delete({{$analyst->id}})"
                                            class="text-indigo-600 hover:text-indigo-900">Excluir</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $analysts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
