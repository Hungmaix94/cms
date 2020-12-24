@extends("layouts.guest")
@section('content')
    <div class="columns is-centered">
        <div class="column is-two-fifths">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="mdi mdi-lock"></i></span>
                        <span>Login</span>
                    </p>
                </header>


                <div class="card-content">
                    <form method="POST" action="https://admin-one-laravel.justboil.me/login">
                        <input type="hidden" name="_token" value="OfFpjWYQH78ok5zwVlTgtH2hSRSEdPqB6SVbPjed">
                        <div class="field">
                            <label class="label" for="email">E-Mail Address</label>
                            <div class="control">
                                <input id="email" type="email" class="input " name="email" value="" required=""
                                       autocomplete="email" autofocus="">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="password">Password</label>
                            <div class="control">
                                <input id="password" type="password" class="input " name="password" required=""
                                       autocomplete="current-password" autofocus="">
                            </div>
                        </div>

                        <div class="control">
                            <label tabindex="0" class="b-checkbox checkbox is-thin">
                                <input type="checkbox" value="false" name="remember" id="remember">
                                <span class="check is-black"></span>
                                <span class="control-label">Remember Me</span>
                            </label>
                        </div>

                        <hr>

                        <div class="field is-form-action-buttons">
                            <button type="submit" class="button is-black">
                                Login
                            </button>

                            <a class="button is-black is-outlined"
                               href="https://admin-one-laravel.justboil.me/password/reset">
                                Forgot Your Password?
                            </a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection