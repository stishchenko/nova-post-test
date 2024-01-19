<!DOCTYPE html>
<html>
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

    <h4>{{ __('count_cost_header') }}</h4>

    <div>
        <p>
            {{ __('your_choice') }} {{ __('settlement', ['settlement' => $city->getSettlementTypeByLocale($locale)]) }}
            @if(!preg_match('/[\(\)]/', $city->description))
                {{ __('city_with_area',
                    ['city' => $city->getDescriptionByLocale($locale),
                     'area' => $city->getAreaByLocale($locale)]) }},
            @else
                {{ $city->getDescriptionByLocale($locale) }},
            @endif {{ __('warehouse', ['warehouse' => $warehouse->getDescriptionByLocale($locale)]) }}.
            {{ __('total_cost', ['total_cost' => $total_cost]) }}
        </p>
    </div>

    <div>
        <a href="{{ route('novapost.index', ['locale'=>app()->getLocale()]) }}">{{ __('back_to_index') }}</a>
    </div>
</div>

</body>
