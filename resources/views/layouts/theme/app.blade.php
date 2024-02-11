<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        @yield('title')
    </title>
    @include('layouts.theme.partials.styles')
</head>

<body class="">
    @include('layouts.theme.partials.sidebar')
    <div class="main-content">
        
        <!-- Navbar -->
        @include('layouts.theme.partials.navbar')
        <!-- End Navbar -->
        <!-- Header -->
        {{-- @include('layouts.theme.partials.header') --}}
        <div class="container-fluid mt--7">

            
            @yield('content')
            <!-- Footer -->
            @include('layouts.theme.partials.footer')
        </div>
    </div>

    @include('layouts.theme.partials.scripts')
</body>

</html>
