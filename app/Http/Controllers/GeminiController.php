<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class GeminiController extends Controller
{
    public function index()
    {
        return view('gemini-analyze');
    }

    public function analyze(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        $imageBase64 = base64_encode(
            file_get_contents($request->file('image')->getRealPath())
        );

        $mimeType = $request->file('image')->getMimeType();

        $client = new Client();

        try {
            $response = $client->post(
                'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent',
                [
                    'query' => [
                        'key' => env('GEMINI_API_KEY'),
                    ],
                    'json' => [
                        'contents' => [
                            [
                                'role' => 'user',
                                'parts' => [
                                    ['text' => 'Tell me about this image'],
                                    [
                                        'inlineData' => [
                                            'mimeType' => $mimeType,
                                            'data' => $imageBase64,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ]
            );

            $result = json_decode($response->getBody(), true);
            
             return view('gemini-analyze', ['result' => $result]);

        } catch (\Exception $e) {
            return back()->with('error', 'Erreur: ' . $e->getMessage());
        }
    }
}