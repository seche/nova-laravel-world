[![MIT License](https://img.shields.io/apm/l/atomic-design-ui.svg?)](https://github.com/seche/nova-laravel-world/LICENSE)
[![GitHub Release](https://img.shields.io/github/release/tterb/PlayMusic.svg?style=flat)](https://github.com/seche/nova-laravel-world/)  
[![Github All Releases](https://img.shields.io/github/downloads/atom/atom/total.svg?style=flat)](https://github.com/seche/nova-laravel-world/)
[![PR's Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg?style=flat)](https://github.com/seche/nova-laravel-world/compare)

# **Nova-Laravel-World**
Nova Tool for the [khsing/laravel-world](https://github.com/khsing/laravel-world) package. This allows you to manage the models that come with laravel-world by displaying them in Nova Resources. 

## Prerequisites 

This package requires the following packages to be installed:
- [khsing/laravel-world](https://github.com/khsing/laravel-world)
- [titasgailius/search-relations](https://github.com/TitasGailius/nova-search-relations)
- [laravel/nova](https://nova.laravel.com/)

## Installation

1. The package can be installed through Composer.
   
   ```composer require seche/nova-laravel-world```
   

2. Register the tool in `app/Providers/NovaServiceProvider` in the `tools()` method.
   ```
   public function tools()
   {
      return [
         new \Seche\NovaLaravelWorld\NovaLaravelWorld(),
      ];
   }
   ```
## Usage

If installed correctly, you will have a grouping of resources under **World**.

## Bugs/Issues

Have a bug or an issue with this package? Open a [new issue here](https://github.com/seche/nova-laravel-world/issues/new/choose) on GitHub.

## License
The MIT License (MIT). Please see [License File](LICENSE) for more information.
