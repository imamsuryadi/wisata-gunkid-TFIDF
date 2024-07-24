<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'rating' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $destinationPath = public_path('images/comments');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move($destinationPath, $fileName);
            $imagePath = 'images/comments/' . $fileName;
        }
        

        Comment::create([
            'user_id' => auth()->id(),
            'wisata_id' => $request->wisata_id,
            'content' => $request->content,
            'rating' => $request->rating,
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan');
    }

}

