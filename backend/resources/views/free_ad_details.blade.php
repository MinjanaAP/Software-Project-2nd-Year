<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Free Ad</title>
</head>
<body>
    <h1>{{ $free_ad->title }}</h1>
    <p>Price: LKR : {{ $free_ad->price }}</p>
    <p>Category: {{ $free_ad->category }}</p>
    <p>Description: {{ $free_ad->description }}</p>
    <p>Sub Category : {{$free_ad->sub_category}}</p>
    <p>Category : {{$free_ad->category}} </p>

    
    @foreach (range(1, 5) as $i)
        @if (!empty($free_ad['image_' . $i]))
            <img src="data:image/jpeg;base64,{{ base64_encode($free_ad['image_' . $i]) }}" alt="Image {{ $i }}">
        @endif
    @endforeach
</body>
</html>