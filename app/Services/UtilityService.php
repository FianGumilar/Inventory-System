<?php

namespace App\Services;

use App\Models\Utility;

class UtilityService
{
    public function getData($request)
    {
        $search = $request->search;

        $query = Utility::query();

        $query->when(request('search', false), function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%');
        });

        return $query->paginate(10);
    }

    public function createData($request)
    {
        $inputs = $request->only(['name', 'description']);
        $utility = Utility::create($inputs);

        return $utility;
    }

    public function deleteData($id)
    {
        $utility = Utility::findOrFail($id);
        $utility->delete();

        return $utility;
    }

    public function updateData($id, $request)
    {
        $inputs = $request->only(['name', 'description']);

        $utility = Utility::findOrFail($id);
        $utility->update($inputs);

        return $utility;
    }
}