<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Wisata;
use App\Models\Artikel;
use Illuminate\Http\Request;
use App\Models\SewaMotor;


class HomepageController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        $wisata = Wisata::with(['comments' => function ($query) {
            $query->selectRaw('wisata_id, AVG(rating) as average_rating')
                  ->groupBy('wisata_id');
        }])->get();
        $trendingWisata = Wisata::select('wisata.*')
            ->leftJoin('comments', 'wisata.id', '=', 'comments.wisata_id')
            ->selectRaw('AVG(comments.rating) as average_rating, COUNT(comments.id) as comment_count')
            ->groupBy('wisata.id')
            ->orderByDesc('average_rating') // Highest rating first
            ->orderByDesc('comment_count') // Then order by the most comments
            ->limit(5) // Limit to top 5, for example
            ->get();

        return view('welcome', compact('kategori', 'wisata', 'trendingWisata'));
    }

    public function detail($id)
    {
        $wisata = Wisata::findOrFail($id);
        $comments = $wisata->comments;
        $averageRating = $comments->avg('rating');
        $ratingCounts = $comments->groupBy('rating')->map->count();
        $sewaMotors = SewaMotor::where('wisata_id', $id)->get(); 

        $allWisata = Wisata::where('id', '!=', $id)->get();

        $documents = [];
        foreach ($allWisata as $otherWisata) {
            $documents[$otherWisata->id] = $otherWisata->deskripsi;
        }
        $documents[$id] = $wisata->deskripsi; 

        $tfidf = $this->calculateTfIdf($documents);
        // dd($tfidf);

        $selectedTfIdf = $tfidf[$id];
        $similarities = [];
        foreach ($tfidf as $docId => $docTfidf) {
            if ($docId != $id) {
                $similarity = $this->cosineSimilarity($selectedTfIdf, $docTfidf);
                $similarities[] = [
                    'id' => $docId,
                    'similarity' => $similarity,
                    'similarity_percentage' => $similarity * 100
                ];
            }
        }

        usort($similarities, function($a, $b) {
            return $b['similarity'] <=> $a['similarity'];
        });

        $topSimilarWisataIds = array_slice(array_column($similarities, 'id'), 0, 3);
        $rekomendasiWisata = Wisata::whereIn('id', $topSimilarWisataIds)->get();

        foreach ($rekomendasiWisata as $wisataItem) {
            foreach ($similarities as $similarity) {
                if ($similarity['id'] == $wisataItem->id) {
                    $wisataItem->similarity = $similarity['similarity'];
                    $wisataItem->similarity_percentage = $similarity['similarity_percentage'];
                    break;
                }

            }
        }

        return view('detail_wisata', compact('wisata', 'rekomendasiWisata', 'comments', 'averageRating', 'ratingCounts','sewaMotors'));
    }
    private function calculateTfIdf($documents)
    {
        $tf = [];
        $df = [];
        $idf = [];
        $tfidf = [];

        foreach ($documents as $docId => $doc) {
            $terms = explode(' ', $doc);
            $tf[$docId] = array_count_values($terms);

            foreach ($terms as $term) {
                if (!isset($df[$term])) {
                    $df[$term] = [];
                }
                $df[$term][$docId] = true;
            }
        }

        // dd($tf);
        
        

        $numDocuments = count($documents);
        foreach ($df as $term => $docIds) {
            $df[$term] = count($docIds);
            $idf[$term] = log($numDocuments / $df[$term]);
        }
        // dd($idf);
        

        foreach ($tf as $docId => $terms) {
            foreach ($terms as $term => $count) {
                $tfidf[$docId][$term] = $count * ($idf[$term] ?? 0);
            }
        }

        return $tfidf;
        
    }
    


    

    private function cosineSimilarity($vec1, $vec2)
    {
        $dotProduct = 0;
        $normVec1 = 0;
        $normVec2 = 0;

        $allTerms = array_unique(array_merge(array_keys($vec1), array_keys($vec2)));

        foreach ($allTerms as $term) {
            $tfidf1 = $vec1[$term] ?? 0;
            $tfidf2 = $vec2[$term] ?? 0;

            $dotProduct += $tfidf1 * $tfidf2;
            $normVec1 += $tfidf1 * $tfidf1;
            $normVec2 += $tfidf2 * $tfidf2;
        }

        return $normVec1 && $normVec2 ? $dotProduct / (sqrt($normVec1) * sqrt($normVec2)) : 0;
    }   

    public function allWisata()
    {
        // Get all wisata with paginated results
        $wisata = Wisata::with('comments')->paginate(12);

        // Get trending wisata based on the highest average rating and comment count
        $trendingWisata = Wisata::select('wisata.*')
            ->leftJoin('comments', 'wisata.id', '=', 'comments.wisata_id')
            ->selectRaw('AVG(comments.rating) as average_rating, COUNT(comments.id) as comment_count')
            ->groupBy('wisata.id')
            ->orderByDesc('average_rating') // Highest rating first
            ->orderByDesc('comment_count') // Then order by the most comments
            ->limit(5) // Limit to top 5, for example
            ->get();

        // For debugging purposes, you can dump the trending wisata
        

        // Get all categories
        $kategori = Kategori::all();

        // Return view with the wisata, categories, and trending wisata data
        return view('semua_wisata', compact('wisata', 'kategori', 'trendingWisata'));
    }



    public function search(Request $request)
    {
        $query = $request->input('query');

        $results = Wisata::where('nama', 'LIKE', '%' . $query . '%')->get();

        $results->transform(function ($wisata) {
            $gambarArray = json_decode($wisata->gambar, true);
            $firstImageUrl = $gambarArray[0] ?? 'default-image-url.jpg';
            return [
                'id' => $wisata->id,
                'nama' => $wisata->nama,
                'image_url' => $firstImageUrl,
                'detail_url' => route('detail', ['id' => $wisata->id])
            ];
        });

        return response()->json([
            'results' => $results,
        ]);
    }

    public function artikel()
    {
        $artikels = Artikel::latest()->get(); 
        return view('artikel', compact('artikels'));
    }
    public function show($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('detailartikel', compact('artikel'));
    }
}
