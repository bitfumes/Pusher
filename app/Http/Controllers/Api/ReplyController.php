<?php

namespace App\Http\Controllers\Api;

use App\Events\FavoritedEvent;
use App\Notifications\NewReply;
use App\Question;
use App\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;

class ReplyController extends Controller
{
    /**
     * ReplyController constructor.
     */
    public function __construct()
    {
        $this->middleware('jwt');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        $reply = $question->replies()->create($request->all());
        $reply = $reply->load('user');
        $reply->notify();
        return response(['reply'=>$reply],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Reply $reply)
    {
        $reply->update($request->all());
        return response()->json('updated',201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        $reply->delete();
    }

    public function favoriteIt(Reply $reply)
    {
        $reply->favorite()->create(['user_id'=>auth()->user()->id]);
        broadcast(new FavoritedEvent($reply->id,1))->toOthers();
    }

    public function unFavoriteIt(Reply $reply)
    {
        $reply->favorite()->where('user_id', auth()->id())->first()->delete();
        broadcast(new FavoritedEvent($reply->id,0))->toOthers();
    }
}
