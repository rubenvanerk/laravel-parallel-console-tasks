# Run tasks in parallel in console commands

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rubenvanerk/laravel-parallel-console-tasks.svg?style=flat-square)](https://packagist.org/packages/rubenvanerk/laravel-parallel-console-tasks)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/rubenvanerk/laravel-parallel-console-tasks/run-tests?label=tests)](https://github.com/rubenvanerk/laravel-parallel-console-tasks/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/rubenvanerk/laravel-parallel-console-tasks/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/rubenvanerk/laravel-parallel-console-tasks/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/rubenvanerk/laravel-parallel-console-tasks.svg?style=flat-square)](https://packagist.org/packages/rubenvanerk/laravel-parallel-console-tasks)

A simple trait to run Laravel Zero-like tasks in parallel.

## Installation

You can install the package via composer:

```bash
composer require rubenvanerk/laravel-parallel-console-tasks
```

## Usage

```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RubenVanErk\LaravelParallelConsoleTasks\RunsParallelTasks;

class Tasks extends Command
{
    use RunsParallelTasks;
    
    // ...
    
    public function handle() {
    
        $this->tasks([
            'Task 1' => function () {
                // Do a thing
                return true;
            },
            'Task 2' => function () {
                // Do another thing in parallel
                return true;
            },
        ]);
        
    }
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Ruben van Erk](https://github.com/rubenvanerk)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
