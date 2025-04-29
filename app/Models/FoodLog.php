<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodLog
{
    private static $foodLogs = [];
    private static $nextId = 1;

    public $id;
    public $food_name;
    public $portion;
    public $calories;
    public $protein;
    public $carbs;
    public $fat;
    public $consumed_at;

    public function __construct($food_name, $portion, $calories, $protein, $carbs, $fat, $consumed_at)
    {
        $this->id = self::$nextId++;
        $this->food_name = $food_name;
        $this->portion = $portion;
        $this->calories = $calories;
        $this->protein = $protein;
        $this->carbs = $carbs;
        $this->fat = $fat;
        $this->consumed_at = $consumed_at;
    }

    public static function all()
    {
        return collect(self::$foodLogs);
    }

    public static function find($id)
    {
        foreach (self::$foodLogs as $log) {
            if ($log->id == $id) {
                return $log;
            }
        }
        return null;
    }

    public static function create($data)
    {
        $foodLog = new self(
            $data['food_name'],
            $data['portion'],
            $data['calories'],
            $data['protein'],
            $data['carbs'],
            $data['fat'],
            $data['consumed_at']
        );
        self::$foodLogs[] = $foodLog;
        return $foodLog;
    }

    public static function delete($id)
    {
        self::$foodLogs = array_filter(self::$foodLogs, function ($log) use ($id) {
            return $log->id != $id;
        });
    }
}