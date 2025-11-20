<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;
use App\Repositories\BranchRepository;

class BranchController extends Controller
{
    public function __construct(
        private BranchRepository $branchRepository,
    )
    {
        $this->authorizeResource(User::class, 'user');
    }
    
    public function index()
    {
        $branch = Branch::orderBy('is_active', 'DESC')->get();

        $branch_condition_count = $this->branchRepository->countBranchAll()->map(function ($branch) {
            return collect([
                'is_active' => $branch->getBranchCondition(),
                'keterangan' => $branch->getBranchCondition(),
                'count' => $branch->count,
            ]);
        });
        
        $branch_counts = [
            'branch_in_total' => $branch_condition_count->sum('count') ?? 0,
            'branch_in_active' => $branch_condition_count->firstWhere('is_active', 'Open')['count'] ?? 0,
            'branch_in_close' => $branch_condition_count->firstWhere('is_active', 'Close')['count'] ?? 0,
            'branch_in_multibrand' => $branch_condition_count->firstWhere('is_active', 'Multibrand')['count'] ?? 0,
        ];

        return view(
            'branchs.index', 
            compact(
                'branch',
                'branch_counts'
            )
        );
    }
}
