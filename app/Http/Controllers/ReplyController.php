<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
	function __construct()
	{
		$this->middleware('auth');
	}
	
    public function store(Request $request, Thread $thread)
    {
        $request->validate([
            'body' => 'required'
        ]);

    	$thread->addReply([
    		'body' => request('body'),
    		'user_id' => auth()->id()
    	]);

    	return back()
    		->with('flash', 'Your reply has been left.');
    }

    public function destroy(Reply $reply)
    {
    	$this->authorize('update', $reply);

    	$reply->delete();

    	return back();
    }
}
