<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav mr-auto">
            <li @if($current == "dashboard") class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="{{ route('dashboard') }}">Dashboard <span class="sr-only">(current)</span></a>
            </li>
            <li @if($current == "visitor") class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="{{ route('visitors.index') }}">Visitantes <span class="sr-only">(current)</span></a>
            </li>
            <li @if($current == "room") class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="{{ route('rooms.index') }}">Salas <span class="sr-only">(current)</span></a>
            </li>
            <li @if($current == "concierge") class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="{{ route('concierges.index') }}">Portaria <span class="sr-only">(current)</span></a>
            </li>
            <li @if($current == "register") class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="{{ route('register') }}">Usuários <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>

    </div>
</nav>