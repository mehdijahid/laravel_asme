<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class GeminiController extends Controller
{
    public function index(){
        return view('gemini-analyze');
    }
    
    public function analyze(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:10240', // Max 10MB
        ]);

        // Sauvegarder l'image
        $imagePath = $request->file('image')->store('images', 'public');
        $imageName = $request->file('image')->getClientOriginalName();
        
        // Préparer pour Gemini
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
                                    ['text' => 'Tell me about this image in 3 or four lines en francais'],
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
            $description = $result['candidates'][0]['content']['parts'][0]['text'] ?? 'Aucune description disponible';
            
            // Sauvegarder dans la base de données
            Image::create([
                'url' => $imagePath,
                'name' => $imageName,
                'description' => $description,
                'utilisateur_id' => Auth::id()
            ]);
            
            return redirect()->route('user.dashboard')
                ->with('result', $result)
                ->with('success', 'Analyse effectuée avec succès et image sauvegardée !');

        } catch (\Exception $e) {
            // Supprimer l'image si l'analyse échoue
            Storage::disk('public')->delete($imagePath);
            
            return redirect()->route('user.dashboard')
                ->with('error', 'Erreur: ' . $e->getMessage());
        }
    }
}