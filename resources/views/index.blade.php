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

    {{--@if($errors->any())
            <?php
            dd($errors->messages());
            ?>
    @endif--}}

    <div>
        <select id="language" name="language">
            <option value="ua" selected>UA</option>
            <option value="ru">RU</option>
        </select>
    </div>

    <h4>{{ __('count_cost_header') }}</h4>

    <form id="city-form" method="GET" action="{{ route('novapost.index') }}">
        <select id="city" name="city" onchange="this.form.submit()">
            <option value="">{{ __('select_city') }}</option>
            @foreach($cities as $city)
                <option
                    value="{{ $city->ref }}" {{ request('city') == $city->ref ? 'selected' : '' }}>
                    {{ $city->getDescriptionByLocale($locale) }}
                    @if(!preg_match('/[\(\)]/', $city->description))
                        ({{ $city->getAreaByLocale($locale) }} обл.)
                    @endif
                </option>
            @endforeach
        </select>
    </form>

    {{--@if(request('city'))--}}

    <form id="warehouse-form" method="POST" action="{{ route('novapost.calculate') }}" novalidate>
        @csrf
        <div>
            <select id="warehouse" name="warehouse" {{ request('city') ? '' : 'disabled' }}>
                <option
                    value="">{{ count($warehouses) === 0 ? __('no_warehouses') : __('select_warehouse') }}</option>
                @foreach($warehouses as $warehouse)
                    <option
                        value="{{ $warehouse->ref }}" {{ old('warehouse') == $warehouse->ref ? 'selected' : '' }}>{{ $warehouse->getDescriptionByLocale($locale) }}</option>
                @endforeach
            </select>
            @error('warehouse')
            <span class="text-danger">{{ __($message) }}</span>
            @enderror
        </div>
        <div>
            <input type="number" name="price" value="{{ old('price') }}" {{ request('city') ? '' : 'disabled' }}>
            @error('price')
            @foreach($errors->get('price') as $message)
                <span class="text-danger">{{ __($message) }}</span>
            @endforeach
            @enderror
        </div>
        <div>
            <input type="submit" value="{{ __('Calculate') }}" {{ request('city') ? '' : 'disabled' }}>
        </div>
    </form>

    {{--
        @endif
    --}}

    {{--@if(request('total_cost'))
        <p>Обрано {{ $selectedCity->description }}, {{ $selectedWarehouse->description }}. Обраховане значення
            - {{ $total_cost }}.</p>
    @endif--}}

    {{--<form method="POST" action="{{ route('novapost.calculate') }}">
        @csrf
        <div>
            <label for="city">Населений пункт:</label>
            <select id="city" name="city">
                <option value=''>Оберіть місто</option>
                @foreach($cities as $city)
                    <option value="{{ $city->ref }}"
                            @if (isset($old_city_ref) && $old_city_ref == $city->ref) selected @endif>{{ $city->description }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="warehouse">Відділення:</label>
            <select id="warehouse" name="warehouse">
                <option value=''>Оберіть відділення</option>
                @foreach($warehouses as $warehouse)
                    <option value="{{ $warehouse->ref }}"
                            @if (isset($old_wh_ref) && $old_wh_ref == $warehouse->ref) selected @endif>{{ $warehouse->description }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="price">Вартість посилки:</label>
            <input type="number" id="price" name="price" placeholder="1000"
                   <?php if (isset($old_price)): ?>
                   value="{{ $old_price }}"
                <?php endif; ?>
            >

        </div>
        <button type="submit" id="calculate">Розрахувати вартість</button>
    </form>

    @if(isset($total_cost))
        <div>
            <span>
            Ви обрали: населений пункт - {{ $my_city->description }}, відділення - {{ $my_warehouse->description }}.
            Вартість доставки: {{ $total_cost }} грн.
            </span>
        </div>
    @endif--}}
</div>

</body>
