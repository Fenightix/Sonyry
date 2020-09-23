<nav  style="position: absolute; top: 0; left: 0; right: 0;"  class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a  style="font-family: cursive" class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('login') }}">{{ __('Se connecter') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('register') }}">{{ __("S'enregistrer") }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
