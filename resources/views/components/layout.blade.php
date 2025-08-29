<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Presto.it</title>
    
    {{-- direttiva blade @vite() per css --}}
    @vite(['resources/css/app.css'])
</head>

<body>
    {{-- Inizio Navbar --}}
    <x-navbar />
    {{-- Fine Navbar --}}
    <!-- Overlay -->
    <div id="overlay"></div>
    <div class="background-container"></div>

    <div style="height: 100px;"></div>



    {{-- Inizio contenuto $slot --}}
    <div class="min-vh-100">


        <x-helper></x-helper>
        {{ $slot }}
    </div>
    {{-- Fine contenuto $slot --}}

    <x-footer />

    {{-- direttiva blade @vite() per js --}}
    @vite(['resources/js/app.js'])


</body>

</html>


