<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use App\Models\Comment;
use App\Models\Like;
use App\Http\Requests\CommentStoreForQuestionRequest;
use App\Http\Requests\CommentStoreForAnswerRequest;
use App\Http\Requests\CommentUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CommentService;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Comment::class, 'comment');
    }

    public function addLike(Comment $comment)
    {
        $like = $comment->likes()->create([
            'user_id' => auth()->id(),
            'likeable_type' => Comment::class,
            'likeable_id' => $comment->id,
        ]);

        if ($like && $like->exists) {
            return back();
        } else {
            return back()
                ->withErrors(['msg' => 'Error']);
        }
    }

    public function removeLike(Comment $comment)
    {
        $deleted = $comment->likes
            ->where('user_id', auth()->id())
            ->first()
            ->delete();

        if ($deleted) {
            return back();
        } else {
            return back()
                ->withErrors(['msg' => 'Delete error']);
        }
    }

    /**
     * Store comment for answer
     *
     * @param $request
     * @return void
     */
    public function storeForAnswer(
        CommentStoreForAnswerRequest $request,
        CommentService $comment_service
    )
    {
        $data = $request->validated();
        $comment = $comment_service->createForAnswer($data);

        if ($comment) {
            return redirect()
                ->route('questions.show', $comment->question->id)
                ->with(['success' => 'Comment successfully created']);
        } else {
            return back()
                ->withErrors(['msg' =>
                    'Error while creating comment. Please try again'])
                ->withInput();
        }
    }

    /**
     * Store comment for question
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeForQuestion(
        CommentStoreForQuestionRequest $request,
        CommentService $comment_service
    )
    {
        $data = $request->validated();
        $comment = $comment_service->createForQuestion($data);

        if ($comment) {
            return redirect()
                ->route('questions.show', $comment->question->id)
                ->with(['success' => 'Comment successfully created']);
        } else {
            return back()
                ->withErrors(['msg' =>
                    'Error while creating comment. Please try again'])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('public.comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(CommentUpdateRequest $request, Comment $comment)
    {
        $data = $request->validated();
        $updated = $comment->update($data);

        if ($updated) {
            return redirect()
                ->route('questions.show', $comment->question->id)
                ->with(['success' => "Comment with ID '$comment->id' updated"]);
        } else {
            return back()
                ->withErrors(['msg' => 'Update error. Please try again.'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $destroyed = $comment->delete();

        if ($destroyed) {
            return redirect()
                ->route('questions.show', $comment->question->id)
                ->with(['success' => "Comment with ID '$comment->id' deleted"]);
        } else {
            return back()
                ->withErrors(['msg' => 'Delete error. Please try again.']);
        }
    }
}
