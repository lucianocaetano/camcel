<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EnterpriseDocumentStoreRequest;
use App\Http\Requests\EnterpriseDocumentUpdateRequest;
use App\Http\Resources\EnterpriseDocumentResource;
use App\Models\Document;
use App\Models\Enterprise;

class EnterpriseDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Enterprise $enterprise)
    {
        $documents = $enterprise->documents()->orderBy("created_at", "desc")->get();

        return response()->json(["documents" => EnterpriseDocumentResource::collection($documents)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Enterprise $enterprise, EnterpriseDocumentStoreRequest $request)
    {
        $request->validated();

        $path = $request->file('document')->store('documents', 'public');

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
        $enterprise->documents()->findOrFail($document->id);

        return response()->json(["document" => EnterpriseDocumentResource::make($document)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Enterprise $enterprise, EnterpriseDocumentStoreRequest $request, Document $document)
    {
        $data=$request->validated();

        $enterprise->documents()->findOrFail($document->id);

        $path=null;

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
        $enterprise->documents()->findOrFail($document->id);

        $document->delete();

        return response()->json();
    }
}
