<div>
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="">
                @if ($status!='ATIVO')
                    <p class="block text-gray-700 text-sm font-bold mb-2 text-right">{{ __('Confirmar dados do Perfil') }}</P> 
                @endif
                <div class="mb-4">
                    <label for="exampleFormControlInput1"
                        class="block text-gray-700 text-sm font-bold mb-2">Nome:</label>
                    <input type="text"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="exampleFormControlInput1" placeholder="Nome" wire:model="name">
                    @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="exampleFormControlInput2"
                        class="block text-gray-700 text-sm font-bold mb-2">Sobrenome:</label>
                    <input type='text'
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="exampleFormControlInput2" wire:model="last_name" placeholder="Sobrenome">
                    @error('last_name') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="exampleFormControlInput3"
                        class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <input type='email'
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="exampleFormControlInput3" wire:model="email" placeholder="Email">
                    @error('email') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="exampleFormControlInput4"
                        class="block text-gray-700 text-sm font-bold mb-2">RG:</label>
                    <input type='text'
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="exampleFormControlInput4" wire:model="rg" placeholder="RG">
                    @error('rg') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="exampleFormControlInput5"
                        class="block text-gray-700 text-sm font-bold mb-2">CPF:</label>
                    <input type='text'
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="exampleFormControlInput5" wire:model="cpf" placeholder="CPF">
                    @error('cpf') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="exampleFormControlInput6"
                        class="block text-gray-700 text-sm font-bold mb-2">Telefone:</label>
                    <input type='text'
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="exampleFormControlInput6" wire:model="phone" placeholder="Telefone">
                    @error('phone') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="exampleFormControlInput7"
                        class="block text-gray-700 text-sm font-bold mb-2">Rua:</label>
                    <input type='text'
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="exampleFormControlInput7" wire:model="street" placeholder="Rua">
                    @error('street') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="exampleFormControlInput8"
                        class="block text-gray-700 text-sm font-bold mb-2">Número:</label>
                    <input type='text'
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="exampleFormControlInput8" wire:model="number" placeholder="Número">
                    @error('number') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="exampleFormControlInput9"
                        class="block text-gray-700 text-sm font-bold mb-2">Complemento:</label>
                    <input type='text'
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="exampleFormControlInput9" wire:model="complement" placeholder="Complemento">
                    @error('complement') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="exampleFormControlInput10"
                        class="block text-gray-700 text-sm font-bold mb-2">Bairro:</label>
                    <input type='text'
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="exampleFormControlInput10" wire:model="neighborhood" placeholder="Bairro">
                    @error('neighborhood') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="exampleFormControlInput11"
                        class="block text-gray-700 text-sm font-bold mb-2">Cidade:</label>
                    <input type='text'
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="exampleFormControlInput11" wire:model="city" placeholder="Cidade">
                    @error('city') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="exampleFormControlInput12"
                        class="block text-gray-700 text-sm font-bold mb-2">Estado:</label>
                    <input type='text'
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="exampleFormControlInput12" wire:model="state" placeholder="Estado">
                    @error('state') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="exampleFormControlInput12"
                        class="block text-gray-700 text-sm font-bold mb-2">CEP:</label>
                    <input type='text'
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="exampleFormControlInput12" wire:model="zip_code" placeholder="CEP">
                    @error('zip_code') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="mb-4">
                    <label for="exampleFormControlInput13"
                        class="block text-gray-700 text-sm font-bold mb-2">Nova senha: (deixe vazio para manter a atual)</label>
                    <input type='password'
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="exampleFormControlInput13" wire:model="newPassword" placeholder="Nova senha">
                    @error('newPassword') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>
        <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                <button wire:click="save"
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                    @if ($status!='ATIVO')
                        Confirmar  
                    @else
                        Salvar
                    @endif
                </button>
            </span>
        </div>
</div>
