<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class AnimeApiService
{
    private $baseUrl = 'https://graphql.anilist.co';

    /**
     * Fetch Trending Anime for Home Page
     */
    public function topAnime()
    {
        return Cache::remember('anilist_trending', now()->addMinutes(30), function () {
            $query = '
            query ($page: Int, $perPage: Int) {
                Page (page: $page, perPage: $perPage) {
                    media (type: ANIME, sort: TRENDING_DESC) {
                        id
                        idMal
                        title {
                            romaji
                            english
                            native
                        }
                        coverImage {
                            large
                            extraLarge
                        }
                        averageScore
                        popularity
                        rank: popularity
                        genres
                        episodes
                        status
                        type
                        seasonYear
                        startDate {
                            year
                            month
                            day
                        }
                        endDate {
                            year
                            month
                            day
                        }
                    }
                }
            }';

            $variables = [
                'page' => 1,
                'perPage' => 20
            ];

            $data = $this->postGraphQL($query, $variables);

            if (empty($data) || empty($data['data']['Page']['media'])) {
                return ['data' => []]; // Return empty compatible structure
            }

            return ['data' => $this->mapMediaList($data['data']['Page']['media'])];
        });
    }

    /**
     * Fetch Full Anime Details
     */
    public function getFullAnime($id)
    {
        return Cache::remember("anilist_media_{$id}", now()->addHours(1), function () use ($id) {
            $query = '
            query ($id: Int) {
                Media (id: $id, type: ANIME) {
                    id
                    idMal
                    title {
                        romaji
                        english
                        native
                    }
                    coverImage {
                        large
                        extraLarge
                    }
                    bannerImage
                    description
                    averageScore
                    popularity
                    favourites
                    genres
                    episodes
                    nextAiringEpisode {
                        episode
                    }
                    status
                    type
                    seasonYear
                    format
                    source
                    duration
                    studios {
                        nodes {
                            name
                        }
                    }
                    startDate {
                        year
                        month
                        day
                    }
                    endDate {
                        year
                        month
                        day
                    }
                    streamingEpisodes {
                        title
                        thumbnail
                        url
                        site
                    }
                }
            }';

            $variables = ['id' => $id];
            $data = $this->postGraphQL($query, $variables);

            if (empty($data) || empty($data['data']['Media'])) {
                return [];
            }

            return $this->mapMediaItem($data['data']['Media']);
        });
    }

    /**
     * Fetch Episodes (Extracted from Media query mostly, but kept for compatibility)
     */
    public function getAnimeEpisodes($id)
    {
        // Reuse cached FULL object
        $anime = $this->getFullAnime($id);

        if (empty($anime)) {
            return [];
        }

        return $anime['streaming_episodes'] ?? [];
    }

    /**
     * Fetch All Genres
     */
    public function getGenres()
    {
        return Cache::remember('anilist_genres', now()->addDays(7), function () {
            $query = '
            query {
                GenreCollection
            }';

            $data = $this->postGraphQL($query);

            if (empty($data) || empty($data['data']['GenreCollection'])) {
                return [];
            }

            // Exclude Hentai or others if needed
            return array_filter($data['data']['GenreCollection'], function ($g) {
                return $g !== 'Hentai';
            });
        });
    }

    /**
     * Fetch Anime List (Paginated)
     */
    public function getAnimeList($page = 1, $perPage = 20)
    {
        return Cache::remember("anilist_list_page_{$page}", now()->addMinutes(30), function () use ($page, $perPage) {
            $query = '
            query ($page: Int, $perPage: Int) {
                Page (page: $page, perPage: $perPage) {
                    pageInfo {
                        total
                        perPage
                        currentPage
                        lastPage
                        hasNextPage
                    }
                    media (type: ANIME, sort: POPULARITY_DESC) {
                        id
                        idMal
                        title {
                            romaji
                            english
                            native
                        }
                        coverImage {
                            large
                            extraLarge
                        }
                        averageScore
                        popularity
                        rank: popularity
                        genres
                        episodes
                        status
                        type
                        seasonYear
                        startDate {
                            year
                            month
                            day
                        }
                    }
                }
            }';

            $variables = [
                'page' => $page,
                'perPage' => $perPage
            ];

            $data = $this->postGraphQL($query, $variables);

            if (empty($data) || empty($data['data']['Page']['media'])) {
                return ['data' => [], 'pagination' => []];
            }

            return [
                'data' => $this->mapMediaList($data['data']['Page']['media']),
                'pagination' => $data['data']['Page']['pageInfo']
            ];
        });
    }

    /**
     * Fetch Anime by Genre
     */
    public function getAnimeByGenre($genre, $page = 1)
    {
        return Cache::remember("anilist_genre_{$genre}_page_{$page}", now()->addMinutes(60), function () use ($genre, $page) {
            $query = '
            query ($page: Int, $genre: String) {
                Page (page: $page, perPage: 20) {
                     pageInfo {
                        total
                        perPage
                        currentPage
                        lastPage
                        hasNextPage
                    }
                    media (type: ANIME, genre: $genre, sort: POPULARITY_DESC) {
                        id
                        idMal
                        title {
                            romaji
                            english
                            native
                        }
                        coverImage {
                            large
                            extraLarge
                        }
                        averageScore
                        popularity
                        rank: popularity
                        genres
                        episodes
                        status
                        type
                        seasonYear
                    }
                }
            }';

            $variables = [
                'page' => $page,
                'genre' => $genre
            ];

            $data = $this->postGraphQL($query, $variables);

            if (empty($data) || empty($data['data']['Page']['media'])) {
                return ['data' => [], 'pagination' => []];
            }

            return [
                'data' => $this->mapMediaList($data['data']['Page']['media']),
                'pagination' => $data['data']['Page']['pageInfo']
            ];
        });
    }

    /**
     * Fetch Airing Schedule
     */
    public function getAiringSchedule()
    {
        // Get start and end of current week timestamps
        $start = now()->startOfWeek()->timestamp;
        $end = now()->endOfWeek()->timestamp;

        return Cache::remember('anilist_schedule_week', now()->addHours(6), function () use ($start, $end) {
            $query = '
            query ($start: Int, $end: Int) {
                Page (page: 1, perPage: 50) {
                     pageInfo {
                        hasNextPage
                    }
                    airingSchedules(airingAt_greater: $start, airingAt_lesser: $end, sort: TIME) {
                        id
                        airingAt
                        episode
                        media {
                            id
                            idMal
                            title {
                                romaji
                                english
                                native
                            }
                            coverImage {
                                large
                                extraLarge
                            }
                            averageScore
                            genres
                            type
                        }
                    }
                }
            }';

            $variables = [
                'start' => $start,
                'end' => $end
            ];

            $data = $this->postGraphQL($query, $variables);

            if (empty($data) || empty($data['data']['Page']['airingSchedules'])) {
                return [];
            }

            $schedules = $data['data']['Page']['airingSchedules'];
            $grouped = [];

            // Group by day name
            foreach ($schedules as $item) {
                // Skip if media is missing
                if (empty($item['media'])) continue;

                $date = \Carbon\Carbon::createFromTimestamp($item['airingAt']);
                $dayName = $this->translateDay($date->format('l'));

                $mappedMedia = $this->mapMediaItem($item['media']);
                // Add airing info
                $mappedMedia['airing_at'] = $item['airingAt'];
                $mappedMedia['airing_episode'] = $item['episode'];
                $mappedMedia['airing_time'] = $date->format('H:i');

                $grouped[$dayName][] = $mappedMedia;
            }

            // Sort days to ensure Monday - Sunday order
            $orderedDays = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            $sortedGrouped = [];
            foreach ($orderedDays as $day) {
                if (isset($grouped[$day])) {
                    $sortedGrouped[$day] = $grouped[$day];
                }
            }

            return $sortedGrouped;
        });
    }

    /**
     * Get Ongoing Anime (Recently Updated)
     */
    public function getOngoingAnime($perPage = 10)
    {
        return Cache::remember('anilist_ongoing_home', now()->addMinutes(30), function () use ($perPage) {
            $query = '
            query ($perPage: Int) {
                Page (page: 1, perPage: $perPage) {
                    media (type: ANIME, status: RELEASING, sort: TRENDING_DESC) {
                         id
                        idMal
                        title {
                            romaji
                            english
                            native
                        }
                        coverImage {
                            large
                            extraLarge
                        }
                        averageScore
                        popularity
                        rank: popularity
                        genres
                        episodes
                        nextAiringEpisode {
                            episode
                        }
                        status
                        type
                        seasonYear
                    }
                }
            }';

            $data = $this->postGraphQL($query, ['perPage' => $perPage]);
            return $this->mapMediaList($data['data']['Page']['media'] ?? []);
        });
    }

    /**
     * Get Popular Anime
     */
    public function getPopularAnime($perPage = 10)
    {
        return Cache::remember('anilist_popular_home', now()->addDays(1), function () use ($perPage) {
            $query = '
            query ($perPage: Int) {
                Page (page: 1, perPage: $perPage) {
                    media (type: ANIME, sort: POPULARITY_DESC) {
                         id
                        idMal
                        title {
                            romaji
                            english
                            native
                        }
                        coverImage {
                            large
                            extraLarge
                        }
                        averageScore
                        popularity
                        rank: popularity
                        genres
                        episodes
                        nextAiringEpisode {
                            episode
                        }
                        status
                        type
                        seasonYear
                    }
                }
            }';

            $data = $this->postGraphQL($query, ['perPage' => $perPage]);
            return $this->mapMediaList($data['data']['Page']['media'] ?? []);
        });
    }

    /**
     * Get Completed Anime
     */
    public function getCompletedAnime($perPage = 10)
    {
        return Cache::remember('anilist_completed_home', now()->addDays(1), function () use ($perPage) {
            $query = '
            query ($perPage: Int) {
                Page (page: 1, perPage: $perPage) {
                    media (type: ANIME, status: FINISHED, sort: POPULARITY_DESC) {
                         id
                        idMal
                        title {
                            romaji
                            english
                            native
                        }
                        coverImage {
                            large
                            extraLarge
                        }
                        averageScore
                        popularity
                        rank: popularity
                        genres
                        episodes
                        nextAiringEpisode {
                            episode
                        }
                        status
                        type
                        seasonYear
                    }
                }
            }';

            $data = $this->postGraphQL($query, ['perPage' => $perPage]);
            return $this->mapMediaList($data['data']['Page']['media'] ?? []);
        });
    }

    /**
     * Search Anime
     */
    public function searchAnime($query, $page = 1)
    {
        // Short cache for search results
        return Cache::remember("anilist_search_{$query}_page_{$page}", now()->addMinutes(10), function () use ($query, $page) {
            $queryGraph = '
            query ($page: Int, $search: String) {
                Page (page: $page, perPage: 20) {
                    pageInfo {
                        total
                        perPage
                        currentPage
                        lastPage
                        hasNextPage
                    }
                    media (type: ANIME, search: $search, sort: POPULARITY_DESC) {
                         id
                        idMal
                        title {
                            romaji
                            english
                            native
                        }
                        coverImage {
                            large
                            extraLarge
                        }
                        averageScore
                        popularity
                        rank: popularity
                        genres
                        episodes
                        nextAiringEpisode {
                            episode
                        }
                        status
                        type
                        seasonYear
                    }
                }
            }';

            $variables = [
                'page' => $page,
                'search' => $query
            ];

            $data = $this->postGraphQL($queryGraph, $variables);

            if (empty($data) || empty($data['data']['Page']['media'])) {
                return ['data' => [], 'pagination' => []];
            }

            return [
                'data' => $this->mapMediaList($data['data']['Page']['media']),
                'pagination' => $data['data']['Page']['pageInfo']
            ];
        });
    }

    private function translateDay($day)
    {
        $days = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu'
        ];
        return $days[$day] ?? $day;
    }

    /**
     * Execute GraphQL Request
     */
    private function postGraphQL($query, $variables = [])
    {
        $response = Http::post($this->baseUrl, [
            'query' => $query,
            'variables' => $variables,
        ]);

        if ($response->failed()) {
            \Log::error('AniList API Error: ' . $response->body());
            return [];
        }

        return $response->json();
    }

    /**
     * Map a list of AniList Media objects to Jikan-compatible structure
     */
    private function mapMediaList($list)
    {
        return array_map([$this, 'mapMediaItem'], $list);
    }

    /**
     * Map a single AniList Media object to Jikan-compatible structure
     */
    private function mapMediaItem($item)
    {
        // Title logic: English > Romaji > Native
        $primaryTitle = $item['title']['english'] ?? $item['title']['romaji'] ?? $item['title']['native'];

        // Map Genres (AniList gives array of strings, View expects array of ['name' => 'Genre'])
        $genres = array_map(function ($g) {
            return ['name' => $g];
        }, $item['genres'] ?? []);

        // Map Studios
        $studios = array_map(function ($s) {
            return ['name' => $s['name']];
        }, $item['studios']['nodes'] ?? []);

        // Flatten Streaming Episodes to a cleaner format
        // Assuming view expects: url, title, episode_id/number
        $episodes = [];
        $streamingEpisodes = $item['streamingEpisodes'] ?? [];

        // 1. Determine the total number of episodes to display
        $totalEpisodesToDisplay = 0;

        if (isset($item['nextAiringEpisode']['episode'])) {
            $totalEpisodesToDisplay = $item['nextAiringEpisode']['episode'] - 1;
        } elseif (isset($item['episodes']) && $item['episodes'] > 0) {
            $totalEpisodesToDisplay = $item['episodes'];
        } else {
            // Fallback: If we have absolutely no count, check the max episode in streaming URLs if available
            if (!empty($streamingEpisodes)) {
                foreach ($streamingEpisodes as $ep) {
                    if (preg_match('/Episode\s+(\d+)/i', $ep['title'], $matches)) {
                        $epNum = intval($matches[1]);
                        if ($epNum > $totalEpisodesToDisplay) $totalEpisodesToDisplay = $epNum;
                    }
                }
            }
        }

        // 2. Prepare the master list of episodes
        $episodes = [];

        // Optimize: If count is excessive (e.g. > 2000), we might need to cap it or just rely on streaming, 
        // but user specifically asked for "One Piece" (1000+) to show correctly.
        // We will generate the full list.

        // Index streaming episodes by their episode number for easy lookup
        $streamingMap = [];
        foreach ($streamingEpisodes ?? [] as $ep) {
            $epNum = 0;
            // Try extraction
            if (preg_match('/Episode\s+(\d+)/i', $ep['title'], $matches)) {
                $epNum = intval($matches[1]);
            }
            // Be careful with index fallback if regex fails? usually streamingEpisodes are ordered?
            // Let's rely on regex primarily for matching "Episode X".

            if ($epNum > 0) {
                $streamingMap[$epNum] = $ep;
            }
        }

        // 3. Build the final array
        if ($totalEpisodesToDisplay > 0) {
            for ($i = 1; $i <= $totalEpisodesToDisplay; $i++) {
                if (isset($streamingMap[$i])) {
                    // We have real data
                    $episodes[] = [
                        'url' => $streamingMap[$i]['url'],
                        'title' => $streamingMap[$i]['title'],
                        'mal_id' => $i,
                        'aired' => null
                    ];
                } else {
                    // Placeholder
                    $episodes[] = [
                        'url' => '#',
                        'title' => 'Episode ' . $i,
                        'mal_id' => $i,
                        'aired' => null
                    ];
                }
            }
        } elseif (!empty($streamingEpisodes)) {
            // Fallback if we somehow failed to get a total count but have items
            // Just use the streaming items directly
            foreach ($streamingEpisodes as $index => $ep) {
                $epNum = $index + 1;
                if (preg_match('/Episode\s+(\d+)/i', $ep['title'], $matches)) $epNum = intval($matches[1]);
                $episodes[] = [
                    'url' => $ep['url'],
                    'title' => $ep['title'],
                    'mal_id' => $epNum,
                    'aired' => null
                ];
            }
        }

        // 4. Final Sort (Default Ascending 1..N)
        usort($episodes, function ($a, $b) {
            return $a['mal_id'] <=> $b['mal_id'];
        });

        // Calculate string for display header
        $displayEpisodes = $totalEpisodesToDisplay > 0 ? "Ep $totalEpisodesToDisplay" : '?';
        if (($item['status'] ?? '') == 'FINISHED') {
            $displayEpisodes = "$totalEpisodesToDisplay Eps";
        } elseif (($item['status'] ?? '') == 'RELEASING' && !isset($item['nextAiringEpisode'])) {
            $displayEpisodes = "Ep ? / " . ($item['episodes'] ?? '?');
        }

        return [
            // IDs
            'id' => $item['id'], // AniList ID
            'mal_id' => $item['id'], // Use AniList ID for routing to be consistent

            // Titles
            'title' => $primaryTitle,
            'title_english' => $item['title']['english'] ?? null,
            'title_japanese' => $item['title']['native'] ?? null, // Added for completeness

            // Images
            'images' => [
                'jpg' => [
                    'image_url' => $item['coverImage']['large'] ?? $item['coverImage']['extraLarge'],
                    'large_image_url' => $item['coverImage']['extraLarge'] ?? $item['coverImage']['large'],
                    'small_image_url' => $item['coverImage']['large']
                ]
            ],
            'banner_image' => $item['bannerImage'] ?? null, // Extra field if view wants uses it

            // Stats
            'score' => isset($item['averageScore']) ? ($item['averageScore'] / 10) : null, // AniList is 0-100, Jikan is 0-10
            'scored_by' => null, // Not easily available in simple query without extra request
            'rank' => $item['popularity'] ?? null, // Using popularity as proxy for rank check
            'popularity' => $item['popularity'] ?? null,
            'members' => $item['favourites'] ?? null, // Favourites is close enough for "Members" visual
            'favorites' => $item['favourites'] ?? null,

            // content
            'synopsis' => $item['description'] ?? null, // Note: Contains HTML
            'type' => $item['format'] ?? $item['type'] ?? 'TV',
            'episodes' => $displayEpisodes, // UPDATED: Now shows current episode if ongoing
            'status' => $item['status'] ?? 'Unknown',
            'duration' => isset($item['duration']) ? $item['duration'] . ' min' : null,
            'rating' => null, // AniList doesn't serve rating (PG-13 etc) easily in basic Media query without authentication sometimes? checking docs... actually it's 'isAdult'. Leaving null for safety.
            'source' => $item['source'] ?? null,

            // Dates
            'aired' => [
                'string' => $this->formatDate($item['startDate'] ?? []) . ((isset($item['endDate']['year']) && $item['endDate']['year']) ? ' to ' . $this->formatDate($item['endDate']) : '')
            ],
            'year' => $item['seasonYear'] ?? ($item['startDate']['year'] ?? null),

            // Lists
            'genres' => $genres,
            'themes' => [], // AniList merges tags/themes. We can leave empty or map tags if requested.
            'studios' => $studios,

            // Custom for our view (View uses $episodes variable passed from controller)
            'streaming_episodes' => $episodes
        ];
    }

    private function formatDate($date)
    {
        if (empty($date['year'])) return '?';
        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];
        return ($months[$date['month'] ?? 0] ?? '') . ' ' . ($date['day'] ?? '') . ', ' . $date['year'];
    }
}
