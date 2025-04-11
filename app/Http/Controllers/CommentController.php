<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function store_comment(Request $request)
    {
        Comment::create([
            'user_id' => $request->user_id,
            'task_id' => $request->task_id,
            'comment' => $request->comment_input
        ]);
        return redirect('/view_task');
    }
    public function show(Request $request)
    {
        $comment_id = $request->input('comment_id');
        $comment_data = Comment::where('id', $comment_id)->first()->comment;
        return response()->json(
            [
                'comment_data' => $comment_data,
                'comment_id' => $comment_id,
            ]
        );
    }
    public function update(Request $request)
    {
        $comment_id = $request->comment_id;
        $comment = Comment::find($comment_id);
        $comment->comment = $request->edit_comment;
        $comment->save();
    }

    public function storeReply(Request $request)
    {
        $request->validate([
            'comment_id' => 'required|exists:comments,id',
            'reply_comment' => 'required|string|max:1000',
            'task_id' => 'required|exists:tasks,id'
        ]);

        $reply = new Comment();
        $reply->comment = $request->reply_comment;
        $reply->user_id = Auth::user()->id;
        $reply->task_id = $request->task_id;
        $reply->parent_id = $request->comment_id;
        $reply->save();

        return response()->json([
            'success' => true,
            'message' => 'Reply added successfully!',
            'reply' => $reply
        ]);
    }

    public function viewTask()
    {
        $comments = Comment::whereNull('parent_id')
            ->with('replies.user', 'user') 
            ->get();

        return view('components.comment-thread', ['comment' => $comments]);
    }
}
