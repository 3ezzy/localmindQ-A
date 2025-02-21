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
    public function index()
    {
        $questions = Question::with(['user', 'tag'])
            ->withCount('answers')
            ->latest()
            ->paginate(10);

        return view('dashboard', compact('questions'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
