<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\RuleStoreRequest;
use App\Http\Requests\RuleUpdateRequest;
use App\Http\Requests\TestsRequest;
use App\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RuleController extends Controller
{
    public function index()
    {
        $data = Rule::all();
        return view('main.rule.index', compact('data'));
    }

    public function create()
    {
        return view('main.rule.create');
    }

    public function store(RuleStoreRequest $request)
    {
        $data = $request->validated();

        try {
            Rule::create([
                'tipe' => $data['tipe'],
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'late_after' => $data['late_after'],
            ]);

            return redirect()->back()->with('success', 'Data rule berhasil disimpan.');
        } catch (\Throwable $th) {
            report($th); // Mencatat error ke log Laravel

            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function edit($id)
    {

        $rule = Rule::find($id);

        $rule->start_time = date('H:i', strtotime($rule->start_time));
        $rule->end_time = date('H:i', strtotime($rule->end_time));
        $rule->late_after = date('H:i', strtotime($rule->late_after));

        return view('main.rule.update', compact('rule'));
    }

    public function update(RuleUpdateRequest $request, $id)
    {
        try {
            $data = $request->validated();

            $rule = Rule::findOrFail($id);

            $rule->update([
                'tipe' => $data['tipe'],
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'late_after' => $data['late_after'],
            ]);

            return redirect()->route('rule.index')->with('success', 'Data rule berhasil diperbarui.');
        } catch (\Throwable $th) {
            report($th);
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }


    public function toggleStatus($id)
    {
        DB::beginTransaction();

        try {
            $rule = Rule::findOrFail($id);

            if ($rule->is_active) {
                return response()->json([
                    'title' => 'Gagal',
                    'status' => 'error',
                    'message' => 'Tidak dapat menonaktifkan rule yang sedang aktif. Aktifkan rule lain terlebih dahulu.'
                ]);
            }

            // Nonaktifkan semua rule
            Rule::query()->update(['is_active' => false]);

            // Aktifkan rule yang dipilih
            $rule->update(['is_active' => true]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Rule berhasil diaktifkan.'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $rule = Rule::findOrFail($id);

            // Hapus data rule
            $rule->delete();

            return response()->json([
                'status' => true,
                'message' => 'Data rule berhasil dihapus'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $th->getMessage()
            ], 500);
        }
    }

    public function showRestore()
    {
        $data = Rule::onlyTrashed()->get();
        // dd($data[0]->id);
        return view('main.rule.restore', compact('data'));
    }

    public function restore($id)
    {
        try {
            $rule = Rule::onlyTrashed()->findOrFail($id);
            $rule->restore();

            return response()->json([
                'status' => true,
                'message' => 'Data rule berhasil dipulihkan.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal memulihkan data: ' . $th->getMessage()
            ], 500);
        }
    }
}
