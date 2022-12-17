@extends('layouts.app')

@section('content')
    <form method="post" action="{{ route('login.perform') }}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <h1 class="h3 mb-3 fw-normal">Login</h1>

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="username" value="{{ old('name') }}" placeholder="Username" required="required" autofocus>
            <label for="floatingName">Email or Username</label>
            @if ($errors->has('name'))
                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
            <label for="floatingPassword">Password</label>
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
    </form>
@endsection

@section('script')
    <script>
        $(function() {
            $(document).on("submit", "form", function(e) {
                var e = this;
                $.post($(this).attr('action'), $(this).serialize(), function(data) {
                    if (data.success) {
                        console.log(data);
                        window.location = data.redirect_url + '?token=' + data.token;
                    }
                    else {
                        alert("Error occurred");
                    }
                }).fail(function(response) {
                    var erroJson = JSON.parse(response.responseText);
                    var errorString = '';
                    for (var err in erroJson) {
                        for (var errstr of erroJson[err]) {
                            errorString += errstr;
                        }
                        errorString += "\n";
                    }
                    if (errorString) {
                        alert(errorString);
                    }

                });
                return false;
            });
        });
    </script>
@endsection
