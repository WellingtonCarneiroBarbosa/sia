<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ url('dash/chat/message') }}" method="POST">
        @csrf
        <input type="hidden" name="receiver_id" value="1">
        <input type="text" name="message" id="">
        <input type="submit" value="">
    </form>
</body>
</html>