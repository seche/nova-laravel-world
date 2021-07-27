<?php

namespace Seche\NovaLaravelWorld;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use PhpParser\Node\Scalar\String_;
use Titasgailius\SearchRelations\SearchesRelations;

class Division extends Resource
{
    use SearchesRelations;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Khsing\World\Models\Division::class;

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
            ID::make(__('ID'), 'id')->sortable(),
            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules('required', 'max:255')
                ->help(__('Division Common Name')),
            Text::make(__('Full Name'), 'full_name')
                ->sortable()
                ->nullable()
                ->hideFromIndex()
                ->rules('max:255')
                ->help(__('Division Full Name')),
            Text::make(__('Code'), 'code')
                ->sortable()
                ->nullable()
                ->rules('max:64')
                ->help(__('ISO 3166-2 Code')),
            Boolean::make(__('Has Cities'), 'has_city')
                ->hideFromIndex()
                ->trueValue('1')
                ->falseValue('0')
                ->help(__('Does this division have cities?')),
            BelongsTo::make(__('Country'), 'country', \Seche\NovaLaravelWorld\Country::class)
                ->sortable(),
            HasMany::make(__('Division Locale'), 'locales', \Seche\NovaLaravelWorld\DivisionLocale::class),
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
        if( $request->viaResource === 'countries' ){
            return $query->where('country_id', $request->viaResourceId);
        }

        return $query;
    }

    /**
     * The value that should be used to represent the resource when being displayed.
     *
     * @return string
     */
    public static function label() {
        return __('nova-laravel-world::novaLaravelWorld.division');
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
