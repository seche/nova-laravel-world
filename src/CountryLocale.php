<?php

namespace Seche\NovaLaravelWorld;

use Illuminate\Http\Request;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use ResourceBundle;
use Titasgailius\SearchRelations\SearchesRelations;

class CountryLocale extends Resource
{
    use SearchesRelations;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Khsing\World\Models\CountryLocale::class;

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
    ];

    /**
     * The relationship columns that should be searched.
     *
     * @var array
     */
    public static $searchRelations = [
        'country' => ['name'],
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
            ID::make(__('ID'), 'id')
                ->sortable(),
            BelongsTo::make(__('Country'), 'Country', \Seche\NovaLaravelWorld\Country::class)
                ->rules('required')
                ->searchable()
                ->readonly(function ($request) {
                    return $request->isUpdateOrUpdateAttachedRequest();
                })
                ->sortable(),
            Select::make(__('Locale'), 'locale')
                ->searchable()
                ->sortable()
                ->rules('required')
                ->options(function () {
                    return array_combine(ResourceBundle::getLocales(''), ResourceBundle::getLocales(''));
                }),
            Text::make(__('Localized Name'), 'name')
                ->sortable()
                ->rules('required', 'max:255'),
            Text::make(__('Localized Alias'), 'alias')
                ->hideFromIndex()
                ->nullable()
                ->rules( 'max:255'),
            Text::make(__('Localized Abbreviation Name'), 'abbr')
                ->sortable()
                ->nullable()
                ->rules( 'max:16'),
            Text::make(__('Localized Full Name'), 'full_name')
                ->hideFromIndex()
                ->nullable()
                ->rules('max:255'),
            Text::make(__('Localized Country Currency Name'), 'currency_name')
                ->hideFromIndex()
                ->nullable()
                ->rules('max:255'),
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
     * The value that should be used to represent the resource when being displayed.
     *
     * @return string
     */
    public static function label() {
        return __('nova-laravel-world::novaLaravelWorld.countryLocale');
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
