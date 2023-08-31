<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Events\NewNotification;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comment' => 'required|string|max:255',
        ]);

        $comment = new Comment();
        // dd(auth()->id());
        $comment->user_id = auth()->id();
        $comment->post_id = $request->post_id;
        $comment->comment = $request->comment;
        $comment->save();

        $data = [
            'user_id' => auth()->id(),
            'comment' => $request->comment,
            'post_id' => $request->post_id,
        ];
        event(new NewNotification([
            $data,
            'message' => 'You have a new comment on your post.'
        ]));
        return redirect()->back()->with('success', 'Comment added successfully.');
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        // Check if the current user is authorized to update the comment

        $comment->update([
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Comment updated successfully.');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        // Check if the current user is authorized to delete the comment

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}