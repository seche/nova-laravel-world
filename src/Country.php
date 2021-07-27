<?php

namespace Seche\NovaLaravelWorld;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Country extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Khsing\World\Models\Country::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
        'full_name',
        'capital',
        'code',
        'code_alpha3',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules('required', 'max:255')
                ->help(__('Country Common Name')),
            BelongsTo::make(__('Continent'), 'continent', \Seche\NovaLaravelWorld\Continent::class)
                ->sortable(),
            Text::make(__('Full Name'), 'full_name')
                ->sortable()
                ->nullable()
                ->hideFromIndex()
                ->rules('max:255')
                ->help(__('Country Full Name')),
            Text::make(__('Capital'), 'capital')
                ->sortable()
                ->nullable()
                ->hideFromIndex()
                ->rules('max:255')
                ->help(__('Capital Common Name')),
            Text::make(__('Alpha-2'), 'code')
                ->sortable()
                ->nullable()
                ->rules('max:4')
                ->help(__('ISO 3166-1 Alpha-2')),
            Text::make(__('Alpha-3'), 'code_alpha3')
                ->sortable()
                ->nullable()
                ->rules('max:6')
                ->help(__('ISO 3166-1 Alpha-3')),
            Number::make(__('Alpha-Numeric'), 'code_numeric')
                ->sortable()
                ->nullable()
                ->min(1)
                ->max(65535)
                ->help(__('ISO 3166-1 Alpha-Numeric')),
            Text::make(__('Emoji Flag'), 'emoji')
                ->sortable()
                ->hideFromIndex()
                ->nullable()
                ->rules('max:16')
                ->help(__('Country Emoji Flag Code')),
            Text::make(__('Currency Code'), 'currency_code')
                ->sortable()
                ->hideFromIndex()
                ->nullable()
                ->rules('max:3')
                ->help(__('ISO 4217 Code')),
            Text::make(__('Currency Name'), 'currency_name')
                ->sortable()
                ->hideFromIndex()
                ->nullable()
                ->rules('max:128')
                ->help(__('ISO 4217 Name')),
            Text::make(__('Top Level Domain'), 'tld')
                ->sortable()
                ->hideFromIndex()
                ->nullable()
                ->rules( 'max:8'),
            Text::make(__('Calling Prefix'), 'Callingcode')
                ->sortable()
                ->nullable()
                ->hideFromIndex()
                ->rules('max:8'),
            Boolean::make(__('Has Divisions'), 'has_division')
                ->hideFromIndex()
                ->trueValue('1')
                ->falseValue('0')
                ->help(__('Does this country have divisions?')),
            HasMany::make(__('Country Locales'), 'locales', \Seche\NovaLaravelWorld\CountryLocale::class),
            HasMany::make(__('Divisions'), 'divisions', \Seche\NovaLaravelWorld\Division::class),
            HasMany::make(__('Cities'), 'cities', \Seche\NovaLaravelWorld\City::class),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }

    /**
     * Get the relatableQuery and add custom filtering.
     *
     * @param  Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param string $query
     * @return array
     */
    public static function relatableQuery(NovaRequest $request, $query)
    {
        if ($request->viaResource === 'divisions') {
            $division = \Khsing\World\Models\Division::find($request->viaResourceId);
            return $query->where('id', $division->country_id);
        }

        return $query;
    }

    /**
     * The value that should be used to represent the resource when being displayed.
     *
     * @return string
     */
    public static function label() {
        return __('nova-laravel-world::novaLaravelWorld.country');
    }

    /**
     * The value that should be used to represent the group for the resource when being displayed.
     *
     * @return string
     */
    public static function group() {
        return __('nova-laravel-world::novaLaravelWorld.group');
    }
}
