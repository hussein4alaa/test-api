<?php
namespace App\Services;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

class JSONAPIService
{
//    Get Data With Paginate
    public function getWithPaginate($modelClass, string $type)
    {
        $data = QueryBuilder::for($modelClass)
            ->allowedFields(['id', 'title'])
            ->allowedSorts(config("jsonapi.resources.{$type}.allowedSorts"))
            ->allowedFilters(config("jsonapi.resources.{$type}.allowedFilters"))
            ->allowedIncludes(config("jsonapi.resources.{$type}.allowedIncludes"))
            ->paginate(config("jsonapi.resources.{$type}.paginate"));
        return response()->json($data);
    }


//    Get Data Without Paginate
    public function index($modelClass, string $type)
    {
        $data = QueryBuilder::for($modelClass)
            ->allowedSorts(config("jsonapi.resources.{$type}.allowedSorts"))
            ->allowedFilters(config("jsonapi.resources.{$type}.allowedFilters"))
            ->allowedIncludes(config("jsonapi.resources.{$type}.allowedIncludes"))
            ->get();
        return response()->json($data);
    }

//    Show Single Data
    public function show($modelClass, $id, string $type)
    {
        $data = QueryBuilder::for($modelClass::findOrFail($id))
            ->allowedFilters(config("jsonapi.resources.{$type}.allowedFilters"))
            ->allowedIncludes(config("jsonapi.resources.{$type}.allowedIncludes"))
            ->firstOrFail();
        return response()->json($data);
    }

//  Create
    public function create($modelClass, $request)
    {
        unset($request['_type']);
        $insertGetId = $modelClass::insertGetId($request);
        $request['id'] = $insertGetId;
        return response()->json([
            'status' => Response::HTTP_CREATED,
            'data' => $request
        ], Response::HTTP_CREATED);
    }

//  Update
    public function update($modelClass, $request, $id)
    {
        unset($request['_type']);
        $query = QueryBuilder::for($modelClass::findOrFail($id))
            ->where('id', $id)
            ->update($request);
        $request['id'] = $id;
        return response()->json([
            'status' => Response::HTTP_CREATED,
            'data' => $request
        ], Response::HTTP_CREATED);
    }

//    Delete
    public function delete($modelClass, $id)
    {
        $query = QueryBuilder::for($modelClass::findOrFail($id))
                            ->where('id', $id)
                            ->delete();
        return response()->json([
            'status' => Response::HTTP_CREATED,
            'message' => 'Deleted'
        ], Response::HTTP_CREATED);
    }

//    Hash
    public function Hash($string)
    {
        return Hash::make($string);
    }

// Upload files
    public function Upload($file, $path)
    {
        $path = $file->store($path);
        return $path;
    }
}
