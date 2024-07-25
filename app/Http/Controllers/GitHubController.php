<?php

namespace App\Http\Controllers;

use App\Mail\RepositoriesExportMail;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\GitHubService;
use Illuminate\Support\Facades\Mail;

class GitHubController extends Controller
{
    protected GitHubService $githubService;

    public function __construct(GitHubService $githubService)
    {
        $this->githubService = $githubService;
    }

    public function index(): View
    {
        return view('repositories.index');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws GuzzleException
     */
    public function fetchData(Request $request): JsonResponse
    {
        $parameters = $this->getRequestParameters($request);

        $results = $this->githubService->fetchRepositories($parameters);

        $data = array_map(function ($repo) {
            return [
                'name' => $repo['name'],
                'description' => $repo['description'] ?? 'No description available',
                'stargazers_count' => $repo['stargazers_count'],
                'language' => $repo['language'] ?? 'Not specified',
                'html_url' => $repo['html_url'],
            ];
        }, $results['items']);

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $results['total_count'],
            'recordsFiltered' => $results['total_count'],
            'data' => $data,
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws GuzzleException
     */
    public function export(Request $request): JsonResponse
    {
        $parameters = $this->getRequestParameters($request);

        $results = $this->githubService->fetchRepositories($parameters)['items'];

        Mail::to('user@exab.com')->send(new RepositoriesExportMail($results));

        return response()->json(['message' => 'Export file sent to your email "user@exab.com".']);
    }

    /**
     * @param Request $request
     * @return array
     */
    private function getRequestParameters(Request $request): array
    {
        $date = $request->input('date') ?? '2023-01-01';
        $parameters = [
            'q' => 'created:>' . $date,
            'sort' => 'stars',
            'order' => 'desc'
        ];

        if ($request->has('language') && !empty($request->input('language'))) {
            $parameters['q'] .= ' language:' . $request->input('language');
        }

        $parameters['per_page'] = $request->input('length', 10);
        $parameters['page'] = $request->input('start', 0) / $parameters['per_page'] + 1;
        return $parameters;
    }
}
