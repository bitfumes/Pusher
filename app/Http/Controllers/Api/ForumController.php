<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\QuestionCollection;
use App\Http\Resources\QuestionResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Question;

class ForumController extends Controller
{
    /**
     * ForumController constructor.
     */
    public function __construct()
    {
        $this->middleware('jwt',['except'=>['index','show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return QuestionResource::collection(Question::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = auth()->user()->questions()->create($request->all());;
        return response($question->path ,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return $question;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Question $question)
    {
        $question->update(request(['body','title']));;
        return response($question->path ,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->json('Deleted',201);
    }
}
