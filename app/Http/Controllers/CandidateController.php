<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Technology;
use Illuminate\Http\Request;
use Facade\FlareClient\Http\Response;

class CandidateController extends Controller
{
    private $candidate;

    public function __construct(Candidate $candidate)
    {
        $this->candidate = $candidate;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response($this->candidate->with('technologies')->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $candidate = $this->candidate->create($request->all());

        foreach($request->technologies as $technology){
            $candidate->Technologies()->attach($technology);
        }

        return $candidate;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidate $candidate)
    {
        $id = $candidate->id;
        $candidate->update($request->all());
        return $this->candidate->find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidate $candidate)
    {
        $candidate->Technologies()->detach();
        $candidate->delete();
        return 200;
    }
}
