<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;
use App\Models\Comment;
use App\Services\UserApiResponse;
use Exception;

class CommentController extends Controller
{
    // Create comment
    public function commentCreate($blog_id, Request $request)
    {
        try {
            $blog = Blog::where('id', $blog_id)->first();
            if ($blog) {
                $validator = Validator::make($request->all(), [
                    'message' => 'required',
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'message' => 'Validation errors',
                        'errors' => $validator->messages()
                    ], 422);
                }

                $comment = Comment::create([
                    'message' => $request->message,
                    'blog_id' => $blog->id,
                    'user_id' => $request->user()->id
                ]);
                $comment->load('user');
                return response()->json(UserApiResponse::success($comment, 'Comment successfully created'), 200);
            } else {
                return response()->json(UserApiResponse::error('No blog found'), 400);
            }
        } catch (Exception $e) {
            return response()->json(UserApiResponse::error($e->getMessage(), 'Something went wrong'), 500);
        }
    }

    // Lists comment
    public function commentList($blog_id, Request $request)
    {
        try {
            $blog = Blog::where('id', $blog_id)->first();
            if ($blog) {
                $perPage = ($request->perPage) ? $request->perPage : 5;
                $comments = Comment::with(['user'])->where('blog_id', $blog_id)->orderBy('id', 'desc')->paginate($perPage);
                return response()->json(UserApiResponse::success($comments, 'Comment successfully fetched'), 200);
            } else {
                return response()->json(UserApiResponse::error('No blog found'), 400);
            }
        } catch (Exception $e) {
            return response()->json(UserApiResponse::error($e->getMessage(), 'Something went wrong'), 500);
        }
    }

    // Update comment
    public function commentUpdate($comment_id, Request $request)
    {
        try {
            $comment = Comment::with(['user'])->where('id', $comment_id)->first();
            if ($comment) {
                if ($comment->user_id == $request->user()->id) {
                    $validator = Validator::make($request->all(), [
                        'message' => 'required',
                    ]);
                    if ($validator->fails()) {
                        return response()->json([
                            'message' => 'Validation errors',
                            'errors' => $validator->messages()
                        ], 422);
                    }
                    $comment->update([
                        'message' => $request->message
                    ]);
                    return response()->json(UserApiResponse::success('Comment successfully updated', $comment), 200);
                } else {
                    return response()->json(UserApiResponse::error('Access denied'), 400);
                }
            } else {
                return response()->json(UserApiResponse::error('No comment found'), 400);
            }
        } catch (Exception $e) {
            return response()->json(UserApiResponse::error($e->getMessage(), 'Something went wrong'), 500);
        }
    }

    // Delete comment
    public function commentDelete($comment_id, Request $request)
    {
        try {
            $comment = Comment::where('id', $comment_id)->first();
            if ($comment) {
                if ($comment->user_id == $request->user()->id) {
                    $comment->delete();
                    return response()->json(UserApiResponse::success('Comment successfully deleted'), 200);
                } else {
                    return response()->json(UserApiResponse::error('Access denied'), 400);
                }
            } else {
                return response()->json(UserApiResponse::error('No comment found'), 400);
            }
        } catch (Exception $e) {
            return response()->json(UserApiResponse::error($e->getMessage(), 'Something went wrong'), 500);
        }
    }
}
