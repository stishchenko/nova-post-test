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

    <style>
        .form-select:focus, .form-control:focus {
            box-shadow: none;
        }
    </style>
</head>

<body>
<div class="container">

    <div class="row">
        <div class="col-1">
            <select id="locale-select" class="form-select">
                <option value="ua" {{$locale === 'ua' ? 'selected' : ''}}>UA</option>
                <option value="ru" {{$locale === 'ru' ? 'selected' : ''}}>RU</option>
            </select>
        </div>
    </div>

    <script>
        document.getElementById('locale-select').addEventListener('change', function () {
            window.location.href = '/novapost/' + this.value;
        });
    </script>

    <h4 class="pt-3">{{ __('count_cost_header') }}</h4>

    <div class="row mt-3">
        <div class="col-4">
            <form id="city-form" method="GET" action="{{ route('novapost.index', ['locale'=>app()->getLocale()]) }}">
                <select id="city" name="city" onchange="this.form.submit()" class="form-select">
                    <option value="">{{ __('select_city') }}</option>
                    @foreach($cities as $city)
                        <option
                            value="{{ $city->ref }}" {{ request('city') == $city->ref || (isset($selected_city) && $selected_city->ref == $city->ref) ? 'selected' : '' }}>
                            {{ $city->getDescriptionByLocale($locale) }}
                            @if(!preg_match('/[\(\)]/', $city->description))
                                ({{ $city->getAreaByLocale($locale) }} обл.)
                            @endif
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-4">
            <form id="warehouse-form" method="POST"
                  action="{{ route('novapost.calculate', ['locale'=>app()->getLocale()]) }}"
                  novalidate>
                @csrf
                <div>
                    <select id="warehouse" name="warehouse"
                            {{ request('city') || isset($selected_city) ? '' : 'disabled' }} class="form-select">
                        <option
                            value="">{{ count($warehouses) === 0 ? __('no_warehouses') : __('select_warehouse') }}</option>
                        @foreach($warehouses as $warehouse)
                            <option
                                value="{{ $warehouse->ref }}" {{ old('warehouse') == $warehouse->ref || (isset($selected_warehouse) && $selected_warehouse->ref == $warehouse->ref) ? 'selected' : '' }}
                            >{{ $warehouse->getDescriptionByLocale($locale) }}</option>
                        @endforeach
                    </select>
                    @error('warehouse')
                    <span class="text-danger">{{ __($message) }}</span>
                    @enderror
                </div>
                <div>
                    <input type="number" name="price" class="mt-3 form-control" placeholder="1000"
                           value="{{ old('price') }}" {{ request('city') || isset($selected_city) ? '' : 'disabled' }}>
                    @error('price')
                    @foreach($errors->get('price') as $message)
                        <span class="text-danger">{{ __($message) }}</span>
                        <br>
                    @endforeach
                    @enderror
                </div>
                <div>
                    <input type="submit" class="mt-3 btn btn-outline-dark"
                           value="{{ __('Calculate') }}" {{ request('city') || isset($selected_city) ? '' : 'disabled' }}>
                </div>
            </form>
        </div>
    </div>

    @if(isset($total_cost))
        <div class="row mt-4">
            <p class="col-auto">
                {{ __('your_choice') }} {{ __('settlement', ['settlement' => $selected_city->getSettlementTypeByLocale($locale)]) }}
                @if(!preg_match('/[\(\)]/', $selected_city->description))
                    {{ __('city_with_area',
                        ['city' => $selected_city->getDescriptionByLocale($locale),
                         'area' => $selected_city->getAreaByLocale($locale)]) }},
                @else
                    {{ $selected_city->getDescriptionByLocale($locale) }},
                @endif {{ __('warehouse', ['warehouse' => $selected_warehouse->getDescriptionByLocale($locale)]) }}.
                {{ __('total_cost', ['total_cost' => $total_cost]) }}
            </p>
        </div>
    @endif
</div>

</body>
