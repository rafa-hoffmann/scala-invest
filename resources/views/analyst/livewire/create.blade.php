<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form  wire:submit.prevent="store()">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="mb-4">
                            <label for="exampleFormControlInput1"
                                class="block text-gray-700 text-sm font-bold mb-2">Nome:</label>
                            <input type="text"
                                class="shadow appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput1" placeholder="Nome" wire:model="name">
                            @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput2"
                                class="block text-gray-700 text-sm font-bold mb-2">Sobrenome:</label>
                            <input type='text'
                                class="shadow appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput2" wire:model="last_name" placeholder="Sobrenome">
                            @error('last_name') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput2"
                                class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                            <input type='email'
                                class="shadow appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput2" wire:model="email" placeholder="Email">
                            @error('email') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput4"
                                class="block text-gray-700 text-sm font-bold mb-2">RG:</label>
                            <input type='text'
                                class="shadow appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput4" wire:model="rg" placeholder="RG">
                            @error('rg') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput5"
                                class="block text-gray-700 text-sm font-bold mb-2">CPF:</label>
                            <input type='text'
                                class="shadow appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput5" wire:model.debounce.500ms="cpf" placeholder="CPF">
                            @error('cpf') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput6"
                                class="block text-gray-700 text-sm font-bold mb-2">Telefone:</label>
                            <input type='text'
                                class="shadow appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput6" wire:model.debounce.500ms="phone" placeholder="Telefone">
                            @error('phone') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput7"
                                class="block text-gray-700 text-sm font-bold mb-2">Rua:</label>
                            <input type='text'
                                class="shadow appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput7" wire:model="street" placeholder="Rua">
                            @error('street') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput8"
                                class="block text-gray-700 text-sm font-bold mb-2">Número:</label>
                            <input type='text'
                                class="shadow appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput8" wire:model="number" placeholder="Número">
                            @error('number') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput9"
                                class="block text-gray-700 text-sm font-bold mb-2">Complemento:</label>
                            <input type='text'
                                class="shadow appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput9" wire:model="complement" placeholder="Complemento">
                            @error('complement') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput10"
                                class="block text-gray-700 text-sm font-bold mb-2">Bairro:</label>
                            <input type='text'
                                class="shadow appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput10" wire:model="neighborhood" placeholder="Bairro">
                            @error('neighborhood') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput11"
                                class="block text-gray-700 text-sm font-bold mb-2">Cidade:</label>
                            <input type='text'
                                class="shadow appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput11" wire:model="city" placeholder="Cidade">
                            @error('city') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput12"
                                class="block text-gray-700 text-sm font-bold mb-2">Estado:</label>
                            <input type='text'
                                class="shadow appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput12" wire:model="state" placeholder="Estado">
                            @error('state') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput12"
                                class="block text-gray-700 text-sm font-bold mb-2">CEP:</label>
                            <input type='text'
                                class="shadow appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput12" wire:model.debounce.500ms="zip_code" placeholder="CEP">
                            @error('zip_code') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button type="submit"
                            class="inline-flex justify-center w-full rounded-full border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Salvar
                        </button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button wire:click="closeModal()" type="button"
                            class="inline-flex justify-center w-full rounded-full border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Cancelar
                        </button>
                    </span>
            </form>
        </div>
    </div>
</div>
