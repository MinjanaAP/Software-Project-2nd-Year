<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paid ad - Details</title>
</head>
<body>
    <h1> {{$paid_ad->title}} </h1>
    <p>description : {{$paid_ad->description}} </p>

    @if(!empty($paid_ad->image))
        <img src="data:image/jpeg;base64,{{ base64_encode($paid_ad['image']) }}" alt="paid_ad img">
    @endif

</body>
</html>