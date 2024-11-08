<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Services\StackExchangeService;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{

    protected $stackExchangeService;

    public function __construct(StackExchangeService $stackExchangeService)
    {
        $this->stackExchangeService = $stackExchangeService;
    }

    public function index(Request $request)
    {
        $questions = collect(new Question);
        return view('questions.index',[
            'ws' => true,
            'questions' => $questions,
        ]);
    }

    public function searchedQuestions(Request $request)
    {
        $questions = Question::latest('id')->paginate(30);

        return view('questions.searched-questions',data: [
            'ws' => false,
            'questions' => $questions,
        ]);
    }

    public function fetchQuestions(Request $request)
    {

        $request->validate([
            'tagged' => 'required|string',
            'fromdate' => 'nullable|date',
            'todate' => 'nullable|date',
        ]);

        $fromDate = $request->fromdate ? strtotime($request->fromdate) : null;
        $toDate = $request->todate ? strtotime($request->todate) : null;

        $data = $this->stackExchangeService->fetchQuestions(
            $request->tagged,
            $fromDate,
            $toDate
        );
        $questions = collect(new Question);

        if ($data) {
            foreach ($data['items'] as $item) {
                $question = Question::updateOrCreate(
                    ['url' => $item['link']], // Clave única para evitar duplicados
                    [
                        'title' => $item['title'],
                        'url' => $item['link'],
                        'tags' => json_encode($item['tags']), // Convertir array de tags a JSON
                        'creation_date' => date('Y-m-d H:i:s', $item['creation_date']),
                    ]
                );
                $questions->push($question);

            }

            return view('questions.index',[
                'ws' => true,
                'questions' => $questions,
            ]);

        } else {
            return view('questions.index',[
                'error' => true,
                'ws' => true,
                'message' => "Error al conectar con stack overflow",
                'questions' => $questions,
            ]);
        }
    }
}
