<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChoiceStoreRequest;
use App\Http\Requests\ChoiceUpdateRequest;
use App\Models\Choice;
use Illuminate\Http\Request;

class ChoiceApiController extends Controller
{
    /**
     * Return all choices.
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getChoices(){
        return response()->json(Choice::all());
    }

    /**
     * Return a choice by his ID.
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getChoice($id){
        return response()->json(Choice::findOrFail($id));
    }

    /**
     * Create a new choice.
     * @param \App\Http\Requests\ChoiceStoreRequest $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function createChoice(ChoiceStoreRequest $request){
        $choice = Choice::create($request->validated());
        return response()->json($choice,201);
    }

    /**
     * Update a choice by his ID.
     * @param \App\Http\Requests\ChoiceUpdateRequest $request
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function updateChoice(ChoiceUpdateRequest $request, $id){
        $choice = Choice::findOrFail($id);
        $choice->update($request->validated());
        return response()->json($choice);
    }

    /**
     * Delete a choice by his ID.
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function deleteChoice($id){
        Choice::findOrFail($id)->delete();
        return response()->json(null,204);
    }
}
