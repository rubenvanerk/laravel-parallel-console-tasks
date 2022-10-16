<?php

namespace RubenVanErk\LaravelParallelConsoleTasks;

use Spatie\Fork\Fork;
use Symfony\Component\Console\Output\ConsoleSectionOutput;

trait RunsParallelTasks
{
    protected function tasks(array $closures): void
    {
        $closures = collect($closures);

        $section = $this->output->getOutput()->section();

        $tasks = $closures->map(function ($task, $title) {
            return [
                'title' => $title,
                'ran_successful' => null,
                'result' => null,
            ];
        })->values()->toArray();

        $closures = $closures->values()->map(function ($closure, $index) {
            return function () use ($index, $closure) {
                $result = $closure();

                return [
                    'task_id' => $index,
                    'result' => $result,
                ];
            };
        });

        $this->render($tasks, $section);

        Fork::new()
            ->after(
                parent: function ($output) use (&$tasks, $section) {
                    $tasks[$output['task_id']]['ran_successful'] = (bool) $output['result'];
                    $this->render($tasks, $section);
                }
            )
            ->run(...$closures->toArray());
    }

    protected function render(array $tasks, ConsoleSectionOutput $consoleSection): void
    {
        $consoleSection->clear();

        foreach ($tasks as $task) {
            $statusIndicator = $this->getStatusIndicator($task['ran_successful']);
            $consoleSection->writeln("{$task['title']}: $statusIndicator");
        }
    }

    public function getStatusIndicator(?bool $ranSuccessful): string
    {
        return match ($ranSuccessful) {
            true => '<fg=green>✔</>',
            false => '<fg=red>✖</>',
            default => '<fg=yellow>Running...</>'
        };
    }
}
