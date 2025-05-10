<?php

namespace App\Http\Controllers;
use App\Http\Requests\ChapterStoreRequest;
use App\Http\Requests\ChapterUpdateRequest;
use App\Models\Chapter;
use App\Models\Choice;
use Illuminate\Http\Request;

class ChapterApiController extends Controller
{

    public function getChapters()
    {
        return response()->json(Chapter::all());
    }

    public function getChapter($id)
    {
        return response()->json(Chapter::findOrFail($id));
    }

    public function getChoicesByChapter($chapter_id)
    {
        return response()->json(Choice::where(
            "chapter_id",
            $chapter_id
        )->get());
    }

    public function createChapter(ChapterStoreRequest $request)
    {
        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/chapters', 'public');
            $data['image'] = $imagePath; // Save the file path in the database
        }

        $chapter = Chapter::create($data);
        return response()->json($chapter, 201);
    }

    public function updateChapter(ChapterUpdateRequest $request, $id)
    {
        $chapter = Chapter::findOrFail($id);
        $data = $request->validated();

        // Handle Base64 image
        if (!empty($data['image'])) {
            // Delete the old image if it exists
            if ($chapter->image && \Storage::disk('public')->exists($chapter->image)) {
                \Storage::disk('public')->delete($chapter->image);
            }

            // Decode the Base64 image
            $imageData = explode(',', $data['image']);
            $decodedImage = base64_decode(end($imageData));

            // Generate a unique filename
            $imageName = 'images/chapters/' . uniqid() . '.png';

            // Save the image to the public storage
            \Storage::disk('public')->put($imageName, $decodedImage);

            // Save the file path in the database
            $data['image'] = $imageName;
        }

        $chapter->update($data);
        return response()->json($chapter);
    }

    public function deleteChapter($id)
    {
        Chapter::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
