<!DOCTYPE html>
<html>

<head>
    <title>Med * A-Eye</title>
</head>

<body>

    <h1>Password Reset from {{ $appName }}</h1>
    @if(isset($body) && isset($action_link))
    <p>{!! $body !!}</p>
    <a href="{{ $action_link }}">Reset Password</a>
    @endif
</body>

</html>