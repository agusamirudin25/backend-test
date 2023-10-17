<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePatchPackageRequest;
use App\Http\Requests\UpdatePutPackageRequest;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Package::query()
            ->with('connote')
            ->paginate(10);
            return response()->json([
                'status' => true,
                'message' => 'Success get packages',
                'packages' => $data
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePackageRequest $request)
    {
        try {
            $data = $request->all();
            $data['created_at'] = now();
            $data['updated_at'] = now();
            $data = Package::create($data);

            $data = Package::with('connote')->findOrFail($data->transaction_id);
            
            return response()->json([
                'status' => true,
                'message' => 'Success create package',
                'data' => $data
            ], 201);
            
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = Package::with('connote')->find($id);
            if(!$data)  {
                return response()->json([
                    'status' => false,
                    'message' => 'Package not exist.'
                ], 404);
            }
            return response()->json([
                'status' => true,
                'message' => 'Success get package',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePutPackageRequest $request, string $id)
    {
        try {
            // validate package before update
            $package = Package::find($id);
            if(!$package)  {
                return response()->json([
                    'status' => false,
                    'message' => 'Package not exist.'
                ], 404);
            }
            $data = $request->only(Package::$attribute);
    
            $requestAttr = array_keys($data);
            $unsetKey = array_values(array_diff(Package::$attribute, $requestAttr));
    
            if (count($unsetKey) > 0) {
                $package->unset($unsetKey);
            }
    
            Package::where("transaction_id", $id)->update($data);

            $data = Package::with('connote')->findOrFail($id);
            return response()->json([
                'status' => true,
                'message' => 'Success update package',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 400);
        }
    }

    public function updatePatch(UpdatePatchPackageRequest $request, string $id) 
    {
        try {
            // validate package before update
            $package = Package::find($id);
            if(!$package)  {
                return response()->json([
                    'status' => false,
                    'message' => 'Package not exist.'
                ], 404);
            }
            $data = $request->only(Package::$attribute);
            Package::where("transaction_id", $id)->update($data);

            $data = Package::with('connote')->findOrFail($id);
            return response()->json([
                'status' => true,
                'message' => 'Success update package',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // validate package before delete
            $package = Package::find($id);
            if(!$package)  {
                return response()->json([
                    'status' => false,
                    'message' => 'Package not exist.'
                ], 404);
            }

            $package->delete();
           
            return response()->json([
                'status' => true,
                'message' => 'Success delete package',
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 400);
        }
    }
}
