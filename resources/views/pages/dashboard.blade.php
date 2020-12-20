<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap" rel="stylesheet">
    <link href={{url("css/app.css")}} rel="stylesheet">
</head>
<body>


</body>
</html>


@extends("layouts.app")

@section("content")
    <div class="section">
        <div id="card-game" class="row columns is-multiline">
        </div>
    </div>
@endsection

@section("footer")
    <footer class="footer">
        <div class="container">
            <div class="content has-text-centered">
                <div class="soc">
                    <a href="#"><i class="fa fa-github-alt fa-lg" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-youtube fa-lg" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-facebook fa-lg" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-twitter fa-lg" aria-hidden="true"></i></a>
                </div>
                <p>
                    <strong>Bulma</strong> by <a href="http://jgthms.com">Jeremy Thomas</a>.
                    The source code is licensed <a href="http://opensource.org/licenses/mit-license.php">MIT</a>. <br>
                </p>
            </div>
        </div>
    </footer>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src={{asset('js/dashboard.js')}} defer></script>
@endsection

