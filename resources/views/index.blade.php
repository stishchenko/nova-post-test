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

    <form id="city-form" method="GET" action="{{ route('novapost.index') }}">
        <select id="city" name="city" onchange="this.form.submit()">
            <option value="">Select city</option>
            @foreach($cities as $city)
                <option
                    value="{{ $city->ref }}" {{ request('city') == $city->ref ? 'selected' : '' }}>{{ $city->description }}</option>
            @endforeach
        </select>
    </form>

    @if(request('city'))
        <form id="warehouse-form" method="POST" action="{{ route('novapost.calculate') }}">
            @csrf
            <select id="warehouse" name="warehouse">
                <option value="">Select warehouse</option>
                @foreach($warehouses as $warehouse)
                    <option
                        value="{{ $warehouse->ref }}" {{ request('warehouse') == $warehouse->ref ? 'selected' : '' }}>{{ $warehouse->description }}</option>
                @endforeach
            </select>
            <div>
                <input type="number" name="price" value="{{ request('price') }}">
            </div>
            <div>
                <input type="submit" value="Calculate">
            </div>
        </form>
    @endif

    @if(request('total_cost'))
        <p>Обрано {{ $city->description }}, {{ $warehouse->description }}. Обраховане значення
            - {{ $total_cost }}.</p>
    @endif

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
