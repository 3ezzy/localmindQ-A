<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Question::with(['user', 'tag'])
            ->withCount('answers')
            ->latest();

        if ($request->has('tag_id') && !empty($request->tag_id)) {
            $query->whereHas('tag', function ($q) use ($request) {
                $q->where('tag_id', $request->tag_id);
            });
        }

        $questions = $query->paginate(10)->appends($request->query());
        $tags = Tag::orderBy('name')->get(); 

        return view('dashboard', compact('questions', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all(); // Get all tags for the dropdown
        return view('questions.create', compact('tags'));
    }

    /**
     * Store a newly created question in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'title' => 'required|min:10|max:255',
            'body' => 'required|min:10',
            'tag_id' => 'required|exists:tags,id',
            'notify' => 'required|boolean|in:1',
        ]);

        try {
            // Create the question
            $question = Question::create([
                'title' => $validated['title'],
                'body' => $validated['body'],
                'tag_id' => $validated['tag_id'],
                'user_id' => Auth::id(),
            ]);
            // Store notification preference if needed
            if ($request->has('notify') && $request->notify) {
                // You can implement notification logic here
            }

            return redirect()
                ->route('questions.show', $question)
                ->with('success', 'Your question has been posted successfully!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'There was an error posting your question. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::with(['user', 'tag'])->findOrFail($id);
        $answers = $question->answers()->with('user')->latest()->get();

        return view('questions.show', compact('question', 'answers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::findOrFail($id); // Récupérer la question
        $tags = Tag::all(); // Récupérer toutes les catégories
        return view('questions.edit', compact('question', 'tags'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'tag_id' => 'required|exists:tags,id'
        ]);

        $question = Question::findOrFail($id);
        $question->update([
            'title' => $request->title,
            'body' => $request->body,
            'tag_id' => $request->tag_id,
        ]);

        return redirect()->route('questions.show', $question->id)
            ->with('success', 'Question updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
    
        return redirect()->route('questions.index')
                         ->with('success', 'Question deleted successfully!');
    }
    
}
