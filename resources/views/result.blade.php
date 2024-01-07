<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Nova Post</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
          crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
</head>

<body>
<div class="container">

    <h4>Розрахунок вартості доставки з Одеси Новою Поштою</h4>

    <div>
        <p>
            Ви обрали: населений пункт - {{ $city->settlement_type_description }}
            @if(!preg_match('/[\(\)]/', $city->description))
                {{ $city->description }} ({{ $city->area_description }} обл.),
            @else
                {{ $city->description }},
            @endif відділення - {{ $warehouse->description }}.
            Вартість доставки: {{ $total_cost }} грн.
        </p>
    </div>

    <div>
        <a href="{{ route('novapost.index') }}">Повернутися до вибору міста та відділення</a>
    </div>
</div>

</body>
