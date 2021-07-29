# Nova-Laravel-World Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html). Whereas a:
- MAJOR version when you make incompatible changes,
- MINOR version when you add functionality in a backwards compatible manner, and
- PATCH version when you make backwards compatible bug fixes.

## [Unreleased]

## [1.0.0] - 2021-07-27
### Added
- Initially created with `php artisan nova:tool` command.
- `City, CityLocale, Division, DivisionLocale,Country, CountryLocale, Continent, ContinentLocale, Language` Nova Resources.
- README.md, CHANGELOG.md
- Resources language files for English and French.

### Changed
- Nothing

### Removed
- Nothing

## [1.0.1] - 2021-07-29
### Bug Fixes
- Country: fixed typo on callingcode column name.
- CityLocale: Added check for empty Division Name in the display function as it was giving errors when it was null. 
