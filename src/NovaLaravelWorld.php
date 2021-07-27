<?php

namespace Seche\NovaLaravelWorld;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class NovaLaravelWorld extends Tool
{
    public string $cityResource = City::class;
    public string $cityLocaleResource = CityLocale::class;

    public string $continentResource = Continent::class;
    public string $continentLocaleResource = ContinentLocale::class;

    public string $countryResource = Country::class;
    public string $countryLocaleResource = CountryLocale::class;

    public string $divisionResource = Division::class;
    public string $divisionLocaleResource = DivisionLocale::class;

    public string $languageResource = Language::class;

    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::resources([
            $this->cityResource,
            $this->cityLocaleResource,
            $this->divisionResource,
            $this->divisionLocaleResource,
            $this->countryResource,
            $this->countryLocaleResource,
            $this->continentResource,
            $this->continentLocaleResource,
            $this->languageResource,
        ]);
    }

}
