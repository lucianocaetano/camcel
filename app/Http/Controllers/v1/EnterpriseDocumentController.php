<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentStoreRequest;
use App\Http\Requests\DocumentUpdateRequest;
use App\Http\Resources\EnterpriseDocumentResource;
use App\Http\Resources\Pagination\EnterpriseDocumentsPaginatedCollection;
use App\Models\Document;
use App\Models\Enterprise;
use Illuminate\Support\Facades\Gate;

class EnterpriseDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Enterprise $enterprise)
    {
        Gate::authorize("view", $enterprise);

        $documents = $enterprise->documents()->orderBy("created_at", "desc")->paginate(5);

        return response()->json(new EnterpriseDocumentsPaginatedCollection($documents));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Enterprise $enterprise, DocumentStoreRequest $request)
    {
        Gate::authorize("view", $enterprise);

        $request->validated();

        $path = $request->file('document')->store('documents', 'public');

        if ($request->hasFile('document')) {
            $data['document'] = "storage/" . $request->file('document')->store('documents', 'public');
        }

        $document = $enterprise->documents()->create([
            'url_document' => $path,
            'title' => $request->input('title'),
            'expire' => $request->input('expire'),
            'is_valid' => $request->input('is_valid', false),
        ]);

        return response()->json(["document" => EnterpriseDocumentResource::make($document)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Enterprise $enterprise, Document $document)
    {
        Gate::authorize("view", $enterprise);
        Gate::authorize("view", $document);

        return response()->json(["document" => EnterpriseDocumentResource::make($document)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Enterprise $enterprise, DocumentUpdateRequest $request, Document $document)
    {
        Gate::authorize("view", $enterprise);
        Gate::authorize("update", $document);

        $data = $request->validated();

        $path = null;

        if ($request->file("document")) {
            $path = $request->file('document')->store('documents', 'public');
            $data["document_url"] = $path;
        }

        $document->update($data);

        return response()->json(["document" => EnterpriseDocumentResource::make($document)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enterprise $enterprise, Document $document)
    {
        Gate::authorize("view", $enterprise);
        Gate::authorize("delete", $document);

        $document->delete();

        return response()->json();
    }
}
