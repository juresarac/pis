<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Question;
use Auth;

class QuizController extends Controller
{
    public function index ()
    {
        return view('teacher.quiz.index')->with('quizzes', Quiz::all());
    }

    public function addName ()
    {
        return view('teacher.quiz.add')->with('languages', Language::all());
    }


    public function create ()
    {
        return view('teacher.quiz.create')->with('languages', Language::all());
    }

    public function store (Request $request)
    {
        $this->validate($request, [
            'quiz' => 'required',
            'language_id' => 'required',
        ]);   
        $quiz = Quiz::create([
            'name' => $request->quiz,
            'user_id' => Auth::user()->id,
            'language_id' => $request->language_id
        ]);
        return redirect()->route('teacher.quiz.index')->with('success', 'You have successfully added new Quiz');
    }

    public function createQuestionAndAnswers ()
    {
        return view('teacher.quiz.questions_answers.create')->with('quizzes', Quiz::all());

    }

    public function storeQuestionAndAnswers (Request $request)
    {
        $data = $request->validate([
            'quiz' => 'required',
            'question.question' => 'required',
            'answers.*.answer' => 'required'
        ]);
        
        $quiz = Quiz::find($request->quiz);
        
        $correct = array($request->correct1, $request->correct2, $request->correct3, $request->correct4);


        $question = $quiz->questions()->create($data['question']);

        foreach ($data['answers'] as $key => $answer) {

            $answer['correct'] = $correct[$key];

            $allAnswer = array($answer);
           
            $question->answers()->createMany($allAnswer);
        }
        return redirect()->route('teacher.quiz.index');
    }

    public function show ($id)
    {
        return view('teacher.quiz.show')->with('quiz', Quiz::find($id));
    }

    public function destroyQuestion ($id)
    {
        $question = Question::find($id);
        $quiz = Quiz::find($question->quiz_id);
        if ($quiz->user_id === Auth::user()->id){
            if ($question->delete()) {
             return redirect()->route('teacher.quiz.index')->with('success', 'You have successfully deleted the question');
         }
        }
        return redirect()->route('teacher.quiz.index')->with('error', 'You not deleted a question');
    }

    public function edit ($id)
    {
        return view('teacher.quiz.edit')->with('quiz', Quiz::find($id));
    }

    public function update (Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $quiz = Quiz::find($id);
        if ($quiz->user_id === Auth::user()->id) {
            $quiz->name = $request->input('name');
            $quiz->save();
            return redirect()->route('teacher.quiz.index')->with('success', 'You have successfully updated the quiz');
        }
        return redirect()->route('teacher.quiz.index')->with('error', 'You do not have updated the quiz');
    }

    public function destory ($id)
    {
        $quiz = Quiz::find($id);
        if ($quiz->user_id === Auth::user()->id) {
            if ($quiz->delete()) {
                return redirect()->route('teacher.quiz.index')->with('success', 'You have successfully deleted the quiz');
            }
        } 
        
        return redirect()->route('teacher.quiz.index')->with('error', 'You not deleted a quiz');
    }
    
}
