<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;

class ChatbotController extends Controller
{

    public function chat(Request $request)
    {
        $question = $request->message;

        $prompt = "
You are AutoOne AI Assistant.

Only answer questions about:
- Car Rental
- Car Finance
- Car Import
- Car Wash
- Workshop
- FAQ

User Question:
$question
";

        $response = Http::withToken(env('GROQ_API_KEY'))
            ->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama-3.3-70b-versatile',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are AutoOne AI Assistant.'
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt
                    ]
                ]
            ]);

        if (!$response->successful()) {
            return response()->json([
                'error' => $response->body()
            ], 500);
        }

        return response()->json([
            'reply' => $response['choices'][0]['message']['content']
        ]);
    }
}
