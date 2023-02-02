<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function update_content_comment(Request $request, $id) {
        $request->validate(
            [
                "content_comment" => ["required", "unique:comments"]
            ],
            [
                "required" => ":attribute không được bỏ trống",
                'unique' => ':attribute của bạn đã hết. Xin cảm ơn',
            ],
            [
                "content_comment" => "Nội dung bình luận"
            ]
        );
        $comment = Comment::where("product_id", $id);
        $comment->create(
            [
                "product_id" => $id,
                "rating" => $request->session()->get("rating"),
                "fullname" => Auth::user()->name,
                "content_comment" => $request->input('content_comment'),
            ]
        );
        return redirect("/");
    }

    public function stored(Request $request) {
        $rating = $request->index;
            session([
                "rating" => $rating,
            ]);
        echo "done";
    }
}
