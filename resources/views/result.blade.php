@extends('app')

@section('content')
    <h4>{{ __('count_cost_header') }}</h4>

    <div class="row mt-3">
        <p class="col-auto">
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

    <div class="mt-3">
        <a href="{{ route('novapost.index', ['locale'=>app()->getLocale()]) }}"
           class="btn btn-outline-dark"><i class="bi bi-arrow-left"></i>
            {{ __('back_to_index') }}</a>
    </div>
@endsection
