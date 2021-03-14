@component('mail::message')
# Seu cadastro foi realizado

{{ $name }}, sua senha é {{ $password }}

@component('mail::button', ['url' => config('app.url')])
Acessar
@endcomponent

Obridado,<br>
{{ config('app.name') }}
@endcomponent
