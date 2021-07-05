<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify</title>
</head>
<body>
    <p>Dear {{$user->name}},</p>
    <p>Your account has been created, please click the following link to activate your account</p>
    <a href="{{route('verify',$user->email_verification_token)}}">{{route('verify',$user->email_verification_token)}}</a>
    
    <p>Thanks!</p>
</body>
</html>