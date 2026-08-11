<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class InstagramService
{
    /**
     * Get the Instagram feed.
     * Tries to fetch from cache first, then API, falls back to static images on failure.
     */
    public function getFeed($limit = 6)
    {
        return Cache::remember('instagram_feed', now()->addHours(24), function () use ($limit) {
            $apiKey = config('services.instagram_scraper.key');
            $username = config('services.instagram_scraper.username', 'highcontrastdc');

            if ($apiKey) {
                try {
                    // Using "Instagram Scraper Stable API" from RapidAPI requires POST request
                    $response = Http::asForm()->withHeaders([
                        'x-rapidapi-host' => 'instagram-scraper-stable-api.p.rapidapi.com',
                        'x-rapidapi-key' => $apiKey,
                    ])->post('https://instagram-scraper-stable-api.p.rapidapi.com/get_ig_user_posts.php', [
                        'username_or_url' => $username,
                    ]);

                    if ($response->successful()) {
                        $data = $response->json();
                        
                        // Parse the response structure specific to this API
                        if (isset($data['posts']) && is_array($data['posts'])) {
                            return collect($data['posts'])->map(function ($post) {
                                $item = $post['node'] ?? $post;
                                
                                // Best quality thumbnail or display URL
                                $imageUrl = $item['image_versions2']['candidates'][0]['url'] ?? $item['display_url'] ?? $item['thumbnail_src'] ?? $item['thumbnail_url'] ?? null;
                                
                                // Extract caption
                                $caption = $item['caption']['text'] ?? $item['edge_media_to_caption']['edges'][0]['node']['text'] ?? '';
                                $title = strlen($caption) > 40 ? substr($caption, 0, 40) . '...' : $caption;

                                $isVideo = (isset($item['is_video']) && $item['is_video']) || !empty($item['video_versions']);
                                $videoUrl = $item['video_versions'][0]['url'] ?? null;

                                return [
                                    'src' => $imageUrl,
                                    'link' => 'https://instagram.com/p/' . ($item['code'] ?? $item['shortcode'] ?? ''),
                                    'title' => $title ?: 'Instagram Post',
                                    'label' => 'Instagram',
                                    'is_video' => $isVideo,
                                    'video_url' => $videoUrl,
                                ];
                            })->filter(function($item) {
                                return !empty($item['src']);
                            })->take($limit)->values()->toArray();
                        }
                    } else {
                        Log::warning('Instagram Scraper API failed: ' . $response->body());
                    }
                } catch (\Exception $e) {
                    Log::error('Instagram Scraper Exception: ' . $e->getMessage());
                }
            }

            // Fallback: Return static images if API fails or key is missing
            return $this->getFallbackFeed();
        });
    }

    private function getFallbackFeed()
    {
        return [
            [
                'src' => '/assets/images/galeria/Blue 992-18.jpg',
                'title' => 'Porsche 911 (992)',
                'label' => 'Ceramic Coating',
                'link' => 'https://instagram.com/highcontrastdc',
                'is_video' => false,
                'video_url' => null
            ],
            [
                'src' => '/assets/images/galeria/SMBM3.jpg',
                'title' => 'BMW M3 (SMB)',
                'label' => 'Paint Correction',
                'link' => 'https://instagram.com/highcontrastdc',
                'is_video' => true,
                'video_url' => '/assets/videos/pulido-correccion-2.mp4'
            ],
            [
                'src' => '/assets/images/galeria/Polishing.jpg',
                'title' => 'Proceso de Pulido',
                'label' => 'Detallado',
                'link' => 'https://instagram.com/highcontrastdc',
                'is_video' => true,
                'video_url' => '/assets/videos/pulido-correccion.mp4'
            ],
            [
                'src' => '/assets/images/galeria/HCM4-22.jpg',
                'title' => 'BMW M4 Competition',
                'label' => 'Full Detail',
                'link' => 'https://instagram.com/highcontrastdc',
                'is_video' => false,
                'video_url' => null
            ],
            [
                'src' => '/assets/images/galeria/Red ZO6-20.jpg',
                'title' => 'Corvette Z06',
                'label' => 'Protección Gtechniq',
                'link' => 'https://instagram.com/highcontrastdc',
                'is_video' => false,
                'video_url' => null
            ],
            [
                'src' => '/assets/images/galeria/Wash.jpg',
                'title' => 'Lavado Detallado',
                'label' => 'Mantenimiento',
                'link' => 'https://instagram.com/highcontrastdc',
                'is_video' => true,
                'video_url' => '/assets/videos/hero-banner.mp4'
            ]
        ];
    }
}
