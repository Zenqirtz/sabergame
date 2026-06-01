<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    // Controller chatbot (Ollama-only)
    // Backend hanya memakai Ollama (LLM lokal) agar tidak bergantung pada kuota provider eksternal.
    public function chat(Request $request)
    {
        // Pesan dari user
        $userMessage = $request->post('content');

        // Konfigurasi Ollama
        $ollamaModel = env('OLLAMA_MODEL', 'llama3.2:1b');
        $ollamaBase = env('OLLAMA_BASE_URL', 'http://localhost:11434');

        // System prompt dari .env atau file
        $systemPrompt = trim(env('LLM_SYSTEM_PROMPT', ''));
        $systemPromptFile = env('LLM_SYSTEM_PROMPT_FILE');
        if ($systemPromptFile) {
            $path = base_path($systemPromptFile);
            if (is_file($path) && is_readable($path)) {
                $content = file_get_contents($path);
                if (is_string($content)) {
                    $systemPrompt = trim($content);
                }
            }
        }
        $compact = filter_var(env('LLM_COMPACT', true), FILTER_VALIDATE_BOOLEAN);
        if ($compact) {
            $systemPrompt = trim($systemPrompt."\n\nJawab singkat maksimal 2 kalimat, tanpa bullet/daftar, tanpa prefiks seperti 'Cibel:', langsung ke inti.");
        }

        // Panggil Ollama
        try {
            $payload = [
                'model' => $ollamaModel,
                'prompt' => ($systemPrompt !== '' ? ($systemPrompt."\n\n") : '') . $userMessage,
                'stream' => false,
                'num_predict' => intval(env('OLLAMA_NUM_PREDICT', 64)),
                'temperature' => floatval(env('OLLAMA_TEMPERATURE', 0.2)),
            ];
            $res = Http::asJson()->post(rtrim($ollamaBase, '/').'/api/generate', $payload);
            if ($res->successful()) {
                $json = $res->json();
                $message = data_get($json, 'response');
                if (is_string($message) && $message !== '') {
                    return response()->json(['message' => $message]);
                }
                Log::error('Ollama response format unexpected', ['json' => $json]);
            } else {
                Log::error('Ollama API error', ['status' => $res->status(), 'details' => $res->json() ?? $res->body()]);
            }
        } catch (\Throwable $e) {
            Log::error('Ollama call exception', ['error' => $e->getMessage()]);
        }

        return response()->json([
            'error' => 'Terjadi kesalahan pada Ollama atau model tidak tersedia.',
        ], 500);
    }
}
