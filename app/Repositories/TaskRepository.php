<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository {

    public static function getByCreated() : Collection {
        return Task::query()->orderByDesc('created_at')->get();
    }

    public static function getUncompleteByCreated(): Collection {
        return Task::query()->where('complete', '=', false)->orderByDesc('created_at')->get();
    }

    public static function create(string $title, ?string $description, bool $complete = false) : Task {
        $task = new Task();
        $task->title = $title;
        $task->description = $description;
        $task->complete = $complete;
        $task->save();
        return $task;
    }

    public static function getById(int $id) : Task {
        return Task::find($id);
    }

    public static function update(int $id, string $title, ?string $description, bool $complete = false) : Task {
        $task = Task::find($id);
        $task->title = $title;
        $task->description = $description;
        $task->complete = $complete;
        $task->save();
        return $task;
    }

    public static function delete(int $id) {
        Task::destroy($id);
        return true;
    }

    public static function setComplete(array $ids) : void {
        Task::whereIn('id', $ids)->update(['complete' => true]);
    }
}
