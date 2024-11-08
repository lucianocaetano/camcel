<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\OperatorDocumentResource;
use App\Models\Document;
use App\Models\Enterprise;
use App\Models\Operator;
use Illuminate\Http\Request;

class OperatorDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Enterprise $enterprise, Operator $operator)
    {
        if ($operator->enterprise_id !== $enterprise->id) {
            abort(404);
        }

        $documents = $operator->documents()->orderBy("created_at", "desc")->get();

        return response()->json(["documents" => OperatorDocumentResource::collection($documents)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Enterprise $enterprise, Operator $operator, Request $request)
    {
        $request->validated();

        if ($operator->enterprise_id !== $enterprise->id) {
            abort(404);
        }

        $path = $request->file('document')->store('documents', 'public');

        $document = $operator->documents()->create([
            'url_document' => $path,
            'title' => $request->input('title'),
            'expire' => $request->input('expire'),
            'is_valid' => $request->input('is_valid', false),
        ]);

        return response()->json(["document" => OperatorDocumentResource::make($document)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Enterprise $enterprise, Operator $operator, Document $document)
    {
        if ($operator->enterprise_id !== $enterprise->id) {
            abort(404);
        }

        if ($document->operator_id !== $operator->id) {
            abort(404);
        }

        return response()->json(["document" => OperatorDocumentResource::make($document)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Enterprise $enterprise, Operator $operator, Request $request, Document $document)
    {
        $data = $request->validated();

        if ($operator->enterprise_id !== $enterprise->id) {
            abort(404);
        }

        if ($document->operator_id !== $operator->id) {
            abort(404);
        }

        $enterprise->documents()->findOrFail($document->id);

        $path = null;

        if ($request->file("document")) {
            $path = $request->file('document')->store('documents', 'public');
            $data["document_url"] = $path;
        }

        $document->update($data);

        return response()->json(["document" => OperatorDocumentResource::make($document)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enterprise $enterprise, Operator $operator, Document $document)
    {
        $enterprise->documents()->findOrFail($document->id);

        if ($operator->enterprise_id !== $enterprise->id) {
            abort(404);
        }

        if ($document->operator_id !== $operator->id) {
            abort(404);
        }

        $document->delete();

        return response()->json();
    }
}
