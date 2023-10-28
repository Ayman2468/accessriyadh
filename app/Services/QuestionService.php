<?php

namespace App\Services;

use App\Models\Captain;
use App\Models\CarType;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;

class QuestionService
{
    protected $model;

    public function __construct()
    {
        $this->model = new Question();
    }

    public function createItem(array $data)
    {
        return $this->model::create($data);
    }

    public function updateItem($item, array $data)
    {
        $item->update($data);
        return $item;
    }

    public function deleteItem($item)
    {
        return $item->delete();
    }

    public function getAllPaginated($with = [], $isExport = false)
    {
        $paginatedItems = $this->model::query();
        if (!empty($with)) {
            $paginatedItems = $paginatedItems->with($with);
        }
        if (request()->filled('q')) {
            $paginatedItems->where(function ($where) {
                $where->where('question_name_ar', 'like', '%' . request()->q . '%');
                $where->orwhere('question_name_en', 'like', '%' . request()->q . '%');
                $where->orwhere('web_id', 'like', '%' . request()->q . '%');
            });
        }

        if (request()->filled('phase_id') && !request()->filled('building_type_id')) {
            $paginatedItems->where('phase_id', request()->phase_id);
        }
        if (request()->filled('building_type_id')) {
            $paginatedItems->whereHas('BuildingTypeQuestion', function ($q) {
                $q->where('building_type_id', request()->building_type_id);
                if (request()->filled('phase_id')) {
                    $q->where('phase_id', request()->phase_id);
                }
            });
        }

        if ($isExport) return $paginatedItems->orderByDesc('id');

        return $paginatedItems->orderBy('phase_id')->orderBy('order')->paginate(300);
    }

    public function findById($id, $with = [])
    {
        $item = $this->model::query();
        if (!empty($with)) {
            $item = $item->with($with);
        }
        return $item->find($id);
    }

    public function getAllCount()
    {
        return $this->model::count();
    }

    public function findItemsAsList()
    {
        $items = $this->model::query();
        if (request()->filled('q')) {
            $query = request()->q ?? "";
            $items = $items
                ->where(function ($where) use ($query) {
                    $where->where('name', 'like', '%' . $query . '%');
                });
        }
        return $items->get();
    }
}
