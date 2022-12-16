<?php

namespace App\Services;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Database\Eloquent\Collection;

class TaskService {

    public static function getByCreated() : Collection {
        return TaskRepository::getByCreated();
    }

    public static function create(string $title, ?string $description, bool $complete = false) : Task {
        $task = TaskRepository::create($title, $description, $complete);
        return $task;
    }

    public static function getById(int $id) : Task {
        $task = TaskRepository::getById($id);
        return $task;
    }

    public static function update(int $id, string $title, ?string $description, bool $complete = false) : Task {
        TaskService::completeAllAfterThird();
        $task = TaskRepository::update($id, $title, $description, $complete);
        return $task;
    }

    public static function delete(int $id) {
        return TaskRepository::delete($id);
    }

    public static function completeAllAfterThird(): void {
        $tasks = TaskRepository::getUncompleteByCreated()->toArray();

        $ids = [];
        foreach ($tasks as $key => $task) {
            if ($key == 0 || $key == 1) {
                continue;
            }
            $ids[] = $task['id'];
        }
        TaskRepository::setComplete($ids);
    }

    public static function completeTasksOlderFiveMinutes(): void {
        $tasks = TaskRepository::getUncompleteFiveMinutes();
        $ids = [];
        foreach ($tasks as $task) {
            $ids[] = $task->id;
        }
        TaskRepository::setComplete($ids);
    }
}
