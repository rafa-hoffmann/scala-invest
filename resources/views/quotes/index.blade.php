<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Quotes</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <style>
          body {
            background: #eee;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 2%;
            padding-bottom: 2%;
          }
        </style>
    </head>
    <body>
        <table class="shadow-lg bg-white">
            <thead>
                <tr>
                    <th class="bg-blue-100 border text-left px-8 py-4">Symbol</th>
                    <th class="bg-blue-100 border text-left px-8 py-4">Name</th>
                    <th class="bg-blue-100 border text-left px-8 py-4">Price</th>
                </tr>
            </thead>
            <tbody>
            @foreach($quotes as $quote)
                <tr>
                    <td class="border px-8 py-4">{{ $quote->symbol }}</td>
                    <td class="border px-8 py-4">{{ $quote->name }}</td>
                    <td class="border px-8 py-4">{{ $quote->price }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </body>
</html>
