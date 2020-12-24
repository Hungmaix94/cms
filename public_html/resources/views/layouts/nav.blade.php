<nav class="navbar navbar-header-dark navbar-header-template" role="navigation" aria-label="main navigation">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="https://bulma.io">
                <img class="logo-image" src={{asset("images/logo.svg")}} height="28">
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item">
                    Games
                </a>

                <a class="navbar-item">
                    Reviews
                </a>

                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        Coming Soon
                    </a>

                    <div class="navbar-dropdown">
                        <a class="navbar-item">
                            About
                        </a>
                        <a class="navbar-item">
                            Jobs
                        </a>
                        <a class="navbar-item">
                            Contact
                        </a>
                        <hr class="navbar-divider">
                        <a class="navbar-item">
                            Report an issue
                        </a>
                    </div>
                </div>
            </div>

            <div class="navbar-end">
                <div class="navbar-item">

                    <div class="flex items-center">
                        <div class="field input-search">
                            <div class="control is-loading">
                                <input class="input" type="text" placeholder="Normal loading input">
                                <span class="icon is-small is-right">
                                    <svg class="fill-current text-gray-400 w-4" viewBox="0 0 24 24"><path
                                                class="heroicon-ui"
                                                d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"/></svg>
                             </span>
                            </div>
                        </div>

                        <div class="input-search-dropdown z-50 bg-gray-800 text-xs rounded w-64 mt-2">

                            {{--@if (strlen($search) >= 2)--}}
                            {{--<div class="input-search-dropdown z-50 bg-gray-800 text-xs rounded w-64 mt-2">--}}
                            {{--@if (count($searchResults) > 0)--}}
                            {{--<ul>--}}
                            {{--@foreach ($searchResults as $game)--}}
                            {{--<li class="dropdown border-b border-gray-700">--}}
                            {{--<a--}}
                            {{--href="{{ route('games.show', $game['slug']) }}"--}}
                            {{--class="block hover:bg-gray-700 flex items-center transition ease-in-out duration-150 px-3 py-3"--}}
                            {{-->--}}
                            {{--@if (isset($game['cover']))--}}
                            {{--<img src="#" alt="cover" class="w-10">--}}
                            {{--@else--}}
                            {{--<img src="https://via.placeholder.com/264x352" alt="game cover"--}}
                            {{--class="w-10">--}}
                            {{--@endif--}}
                            {{--<span class="ml-4">{{ $game['name'] }}</span>--}}
                            {{--</a>--}}
                            {{--</li>--}}
                            {{--@endforeach--}}
                            {{--</ul>--}}
                            {{--@else--}}
                            {{--<div class="px-3 py-3">No results for "{{ $search }}"</div>--}}
                            {{--@endif--}}
                            {{--</div>--}}
                            {{--@endif--}}
                        </div>


                        {{--<div class="ml-6">--}}
                        {{--<a href="#"><img src="/avatar.jpg" alt="avatar" class="rounded-full w-8"></a>--}}
                        {{--</div>--}}
                    </div>


                    {{--<div class="buttons">--}}
                    {{--<a class="button is-primary">--}}
                    {{--<strong>Sign up</strong>--}}
                    {{--</a>--}}
                    {{--<a class="button is-light">--}}
                    {{--Log in--}}
                    {{--</a>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>
</nav>

<nav class="navbar navbar-header-dark" role="navigation" aria-label="main navigation">
    <div class="container">
        <div id="navbarBasicExample" class="navbar-menu mx-3">
            <div class="navbar-start">
                <a class="navbar-item">
                    Ios
                </a>

                <a class="navbar-item">
                    Android
                </a>

                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        PC
                    </a>

                    <div class="navbar-dropdown">
                        <a class="navbar-item">
                            About
                        </a>
                        <a class="navbar-item">
                            Jobs
                        </a>
                        <a class="navbar-item">
                            Contact
                        </a>
                        <hr class="navbar-divider">
                        <a class="navbar-item">
                            Report an issue
                        </a>
                    </div>
                </div>
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        Tablet
                    </a>

                    <div class="navbar-dropdown">
                        <a class="navbar-item">
                            About
                        </a>
                        <a class="navbar-item">
                            Jobs
                        </a>
                        <a class="navbar-item">
                            Contact
                        </a>
                        <hr class="navbar-divider">
                        <a class="navbar-item">
                            Report an issue
                        </a>
                    </div>
                </div>
                <a class="navbar-item">
                    Best game
                </a>
            </div>

            {{--<div class="navbar-end">--}}
            {{--<div class="navbar-item">--}}
            {{--<div class="buttons">--}}
            {{--<a class="button is-primary">--}}
            {{--<strong>Sign up</strong>--}}
            {{--</a>--}}
            {{--<a class="button is-light">--}}
            {{--Log in--}}
            {{--</a>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
</nav>