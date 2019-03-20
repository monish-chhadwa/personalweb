<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Media.net</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/stylesheets/index.css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            font-weight: 100;
            /*font-family: 'Lato';*/
        }
    </style>
</head>

<body>
    <header><a href="/"><img src="/images/logo-mediaNet.png"></a></header>
    <main>
        <div class="container">
            <div class="left">
                <header>SIGN IN</header>
                <form method="POST"
                      action="/auth/login">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" class="form-control" id="pass" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-success">
                    </div>
                </form>
                @include('errors.list')
            </div>
            <div class="right">
                <h1>Hello Customer</h1>
                <h2>Welcome to media.net</h2>
                <p>This page is confidential<br/>
                    Please login to continue</p>
            </div>
        </div>
    </main>
</body>
</html>