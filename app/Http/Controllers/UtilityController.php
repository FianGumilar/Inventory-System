<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\UtilityService;
use App\Http\Requests\Utility\CreateUtilityRequest;
use App\Http\Requests\Utility\UpdateUtilityRequest;
use App\Http\Resources\Utility\UtilityListResource;
use App\Http\Resources\Utility\SubmitUtilityResource;

class UtilityController extends Controller
{
    public function __construct(UtilityService $utilityService)
    {
        $this->utilityService = $utilityService;
    }

    public function index()
    {
        return Inertia::render('admin/utility/index', [
            "title" => 'Fungsi'
        ]);
    }

    public function getData(Request $request)
    {
        try {
            $data = $this->utilityService->getData($request);

            $result = new UtilityListResource($data);
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function createData(CreateUtilityRequest $request)
    {
        try {
            $data = $this->utilityService->createData($request);

            $result = new SubmitUtilityResource($data, 'Success Create Fungsi');
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function updateData($id, UpdateUtilityRequest $request)
    {
        try {
            $data = $this->utilityService->updateData($id, $request);

            $result = new SubmitUtilityResource($data, 'Success Update Fungsi');
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function deleteData($id)
    {
        try {
            $data = $this->utilityService->deleteData($id);

            $result = new SubmitUtilityResource($data, 'Success Delete Fungsi');
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }


}