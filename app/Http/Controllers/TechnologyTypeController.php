<?php

namespace App\Http\Controllers;

use App\Http\Requests\TechnologyTypeRequest;
use App\Http\Resources\TechnologyTypeResource;
use App\Models\TechnologyType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TechnologyTypeController extends Controller
{
    public function index(Request $request)
    {
        $technologyTypes = TechnologyType::query();

        return Inertia::render('TechnologyTypes/Index', [
            'technology_types' => TechnologyTypeResource::collection($technologyTypes->orderBy('id', 'desc')->paginate(25)),
        ]);
    }

    public function store(TechnologyTypeRequest $request)
    {
        TechnologyType::create($request->validated());

        $this->updateTechnologyTypes();

        // return to_route('technology_type.index');
        //https://www.youtube.com/watch?v=ShGElGusepA
        //https://icon-sets.iconify.design/


    }

    public function update(TechnologyTypeRequest $request, TechnologyType $technology_type)
    {
        $technology_type->update($request->validated());

        $this->updateTechnologyTypes();
    }

    public function destroy(TechnologyType $technology_type)
    {
        $technology_type->delete();

        $this->updateTechnologyTypes();
    }

    public function updateTechnologyTypes()
    {
        $technologyTypes = TechnologyType::query();

        return Inertia::render('TechnologyTypes/Index', [
            'technology_types' => TechnologyTypeResource::collection($technologyTypes->orderBy('id', 'desc')->paginate(25)),
        ]);
    }


}
