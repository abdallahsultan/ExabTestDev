<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RepositoriesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $repositories;

    public function __construct($repositories)
    {
        $this->repositories = $repositories;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return collect($this->repositories);
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Repository Name',
            'Description',
            'Stars',
            'Language',
            'GitHub URL',
        ];
    }

    /**
     * @param mixed $repository
     * @return array
     */
    public function map($repository): array
    {
        return [
            $repository['name'],
            $repository['description'],
            $repository['stargazers_count'],
            $repository['language'],
            $repository['html_url']
        ];
    }
}
