<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\OperatorDocumentResource;
use App\Models\Document;
use App\Models\Enterprise;
use App\Models\Operator;
use App\Http\Requests\DocumentStoreRequest;
use App\Http\Requests\DocumentUpdateRequest;
use Illuminate\Support\Facades\Gate;

class OperatorDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Enterprise $enterprise, Operator $operator)
    {
        Gate::authorize("view", $enterprise);
        Gate::authorize("view", $operator);

        $documents = $operator->documents()->orderBy("created_at", "desc")->get();

        return response()->json(["documents" => OperatorDocumentResource::collection($documents)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Enterprise $enterprise, Operator $operator, DocumentStoreRequest $request)
    {
        Gate::authorize("view", $enterprise);
        Gate::authorize("view", $operator);

        $request->validated();

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
        Gate::authorize("view", $enterprise);
        Gate::authorize("view", $operator);
        Gate::authorize("view", $document);

        return response()->json(["document" => OperatorDocumentResource::make($document)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Enterprise $enterprise, Operator $operator, DocumentUpdateRequest $request, Document $document)
    {
        Gate::authorize("view", $enterprise);
        Gate::authorize("view", $operator);
        Gate::authorize("update", $document);

        $data = $request->validated();

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
        Gate::authorize("view", $enterprise);
        Gate::authorize("view", $operator);
        Gate::authorize("delete", $document);

        $enterprise->documents()->findOrFail($document->id);

        $document->delete();

        return response()->json();
    }
}
