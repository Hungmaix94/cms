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
                    <form method="POST" action="{{ url('/login?abc=343434') }}">
                        {{ csrf_field() }}
                        <div class="field">
                            <label class="label" for="username">Username</label>
                            <div class="control {{ $errors->has('username') ? ' has-error' : '' }} ">
                                <input id="username" type="text" class="input " name="username" value="" required=""
                                       autocomplete="username" autofocus="">
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="password">Password</label>
                            <div class="control {{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password" class="input " name="password" required=""
                                       autocomplete="current-password" autofocus="">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="control">
                            <label tabindex="0" class="b-checkbox checkbox is-thin">
                                <input type="checkbox" value="false" name="remember" id="remember" {{ old('remember') ? 'checked' : ''}}>
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