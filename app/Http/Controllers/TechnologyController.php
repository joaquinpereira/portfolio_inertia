<?php

namespace App\Http\Controllers;

use App\Http\Resources\TechnologyTypeResource;
use App\Http\Resources\TechnologyResource;
use App\Http\Requests\TechnologyRequest;
use App\Models\TechnologyType;
use App\Models\Technology;

use Illuminate\Http\Request;
use Inertia\Inertia;

class TechnologyController extends Controller
{
    public function index(Request $request)
    {
        $technologies = Technology::query();

        return Inertia::render('Technology/Index', [
            'technologies' => TechnologyResource::collection($technologies->orderBy('id', 'desc')->paginate(25)),
            'technology_types' => TechnologyTypeResource::collection(TechnologyType::all())
        ]);
    }

    public function store(TechnologyRequest $request)
    {
        Technology::create($request->validated());

        $this->updateTechnology();
    }

    public function update(TechnologyRequest $request, Technology $technology)
    {
        $technology->update($request->validated());

        $this->updateTechnology();
    }

    public function destroy(Technology $technology)
    {
        $technology->delete();

        $this->updateTechnology();
    }

    public function updateTechnology()
    {
        $technologies = Technology::query();

        return Inertia::render('Technology/Index', [
            'technologies' => TechnologyResource::collection($technologies->orderBy('id', 'desc')->paginate(25)),
        ]);
    }
}
