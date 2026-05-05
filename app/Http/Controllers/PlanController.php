<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::all();
        return response()->view('tadreeb.plan.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('tadreeb.plan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:30',
            'price' => 'required|integer|min:2',
            'max_student' => 'required|integer|min:1',
            'max_program' => 'required|integer|min:1',
            'description' => 'required|string|min:5|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([

                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        } else {
            $plans = new Plan();
            $plans->name = $request->get('name');
            $plans->price = $request->get('price');
            $plans->max_student = $request->get('max_student');
            $plans->max_program = $request->get('max_program');
            $plans->description = $request->get('description');

            $isSaved = $plans->save();

            if ($isSaved) {
                return response()->json([
                    'icon' => 'success',
                    'title' => 'Created Done',
                ], 200);
            } else {
                return response()->json([
                    'icon' => 'error',
                    'title' => 'Created Faild',
                ], 400);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $plans = Plan::findOrFail($id);
        return response()->view('tadreeb.plan.edit', compact('plans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:30',
            'price' => 'required|integer|min:2',
            'max_student' => 'required|integer|min:1',
            'max_program' => 'required|integer|min:1',
            'description' => 'required|string|min:5|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        } else {
            $plans = Plan::findOrFail($id);
            $plans->name = $request->get('name');
            $plans->price = $request->get('price');
            $plans->max_student = $request->get('max_student');
            $plans->max_program = $request->get('max_program');
            $plans->description = $request->get('description');

            $isUpdate = $plans->save();

            if ($isUpdate) {
                return response()->json([
                    'icon' => 'success',
                    'title' => 'Created Done',
                    'redirect' => route('plans.index'),
                ], 200);
            } else {
                return response()->json([
                    'icon' => 'error',
                    'title' => 'Created Faild',
                ], 400);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $plans = Plan::findOrFail($id);
        $plans::destroy($id);
    }
}
