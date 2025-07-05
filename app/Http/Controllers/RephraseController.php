<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;

class RephraseController extends Controller
{
    public function suggest(Request $request)
    {
        $description = $request->input('description');
        $apiKey = config('services.openai.api_key');


        $client = new Client();

        Log::info('API Request:', ['url' => 'https://api-inference.huggingface.co/models/gpt2', 'body' => json_encode([
            'inputs' => $description,
            'max_length' => 50,
        ])]);

        try {
            $response = $client->post('https://api-inference.huggingface.co/models/gpt2', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'inputs' => $description,
                    'max_length' => 50,
                ],
            ]);

            $body = json_decode($response->getBody(), true);
            Log::info('Hugging Face Response:', ['body' => $body]);

            // Check if the response contains the generated text
            $suggestion = isset($body[0]['generated_text']) ? $body[0]['generated_text'] : 'Could not generate a suggestion.';

            // Limit the suggestion to 20 words for a more concise response
            $words = explode(' ', $suggestion);
            $limitedSuggestion = implode(' ', array_slice($words, 0, 20));

            return response()->json(['suggestion' => trim($limitedSuggestion)]);

        } catch (ClientException $e) {
            $responseBody = $e->getResponse()->getBody()->getContents();
            $statusCode = $e->getResponse()->getStatusCode();
            Log::error('Request error:', [
                'status' => $statusCode,
                'error' => $e->getMessage(),
                'response' => $responseBody
            ]);
            return response()->json(['suggestion' => "Request error ($statusCode): $responseBody"], 500);
        } catch (\Exception $e) {
            Log::error('General error:', ['error' => $e->getMessage(), 'stack' => $e->getTraceAsString()]);
            return response()->json(['suggestion' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }
}
