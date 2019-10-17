<?php

namespace App\Http\Controllers\Admin;

use App\Models\Question;
use App\Models\Answer;
use App\Models\Comment;
use App\Http\Requests\CommentStoreForQuestionRequest;
use App\Http\Requests\CommentStoreForAnswerRequest;
use App\Http\Requests\CommentUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController as Controller;
use App\Services\CommentService;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CommentService $comment_service)
    {
        $comments = Comment::list()->paginate(20);
        $comment_service->loadQuestionTitles($comments);

        return view('admin.comments.index', compact('comments'));
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
        $comment = $comment_service->createForQuestion($data, self::MODERATOR_ID);

        if ($comment) {
            return redirect()
                ->route('admin.questions.show', $comment->question->id)
                ->with(['success' => 'Comment successfully created']);
        } else {
            return back()
                ->withErrors(['msg' =>
                    'Error while creating comment. Please try again'])
                ->withInput();
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
        $comment = $comment_service->createForAnswer($data, self::MODERATOR_ID);

        if ($comment) {
            return redirect()
                ->route('admin.questions.show', $comment->question->id)
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
        return view('admin.comments.edit', compact('comment'));
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
                ->route('admin.questions.show', $comment->question->id)
                ->with(['success' => "Comment with ID '$comment->id' updated"]);
        } else {
            return back()
                ->withErrors(['msg' => 'Update error. Please try again.'])
                ->withInput();
        }
    }

    /**
     * Restore comment
     *
     * @param int $id
     * @return void
     */
    public function restore(int $id)
    {
        $comment = Comment::withTrashed()->find($id);
        $restored = $comment->restore();

        if ($restored) {
            return redirect()
                ->route('admin.questions.show', $comment->question->id)
                ->with(['success' => "Comment with ID '$comment->id' restored!"]);
        } else {
            return back()
                ->withErrors(['msg' => 'Restore error. Please try again.']);
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
        $restore_route = route('admin.comments.restore', $comment->id);

        if ($destroyed) {
            return redirect()
                ->route('admin.questions.show', $comment->question->id)
                ->with(['success' => "Comment with ID '$comment->id' deleted",
                        'restore_route' => $restore_route]);
        } else {
            return back()
                ->withErrors(['msg' => 'Delete error. Please try again.']);
        }
    }

}
