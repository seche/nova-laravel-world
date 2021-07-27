<?php

namespace Seche\NovaLaravelWorld;

use Illuminate\Http\Request;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Timezone;
use Laravel\Nova\Http\Requests\NovaRequest;
use Titasgailius\SearchRelations\SearchesRelations;
use Khsing\World\World;

class City extends Resource
{
    use SearchesRelations;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Khsing\World\Models\City::class;

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
        'division' => ['name'],
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     * @throws \Khsing\World\Exceptions\InvalidCodeException
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules('required', 'max:255')
                ->help(__('City Common Name')),
            Text::make(__('Full Name'), 'full_name')
                ->sortable()
                ->nullable()
                ->rules('max:255')
                ->help(__('City Full Name')),
            Text::make(__('Code'), 'code')
                ->sortable()
                ->nullable()
                ->rules('max:64')
                ->help(__('City Code')),
            BelongsTo::make(__('Division'), 'Division', \Seche\NovaLaravelWorld\Division::class)
                ->nullable()
                ->help(__('Province/State/Territory/Division')),
            BelongsTo::make( __('Country'), 'Country', \Seche\NovaLaravelWorld\Country::class),
            Timezone::make(__('Timezone'), 'iana_timezone')
                ->searchable()
                ->nullable()
                ->sortable()
                ->hideFromIndex()
                ->help(__('IANA Timezone')),
            HasMany::make(__('City Locales'), 'locales', \Seche\NovaLaravelWorld\CityLocale::class),
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
        return __('nova-laravel-world::novaLaravelWorld.city');
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
