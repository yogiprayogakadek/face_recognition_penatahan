<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\RuleRequest;
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
        // Kelompokkan data berdasarkan role_group_id
        $grouped = Rule::all()
            ->groupBy('role_group_id')
            ->map(function ($group) {
                // Pisahkan masuk dan pulang
                $masuk = $group->firstWhere('tipe', 'masuk');
                $pulang = $group->firstWhere('tipe', 'pulang');

                return [
                    'masuk' => $masuk,
                    'pulang' => $pulang,
                    'status' => $masuk?->is_active ?? $pulang?->is_active,
                    'group_id' => $masuk?->role_group_id ?? $pulang?->role_group_id,
                ];
            });

        return view('main.rule.index', ['data' => $grouped]);
    }


    public function create()
    {
        return view('main.rule.create');
    }

    public function store(RuleRequest $request)
    {
        $rules = $request->validated()['rules'];

        // Dapatkan role_group_id terakhir lalu tambahkan 1
        $latestGroupId = Rule::max('role_group_id') ?? 0;
        $newGroupId = $latestGroupId + 1;

        // Cek apakah sudah ada aturan aktif
        $alreadyActive = Rule::where('is_active', true)->exists();

        // Jika belum ada aturan aktif, maka aturan baru otomatis aktif
        $isActive = !$alreadyActive;

        try {
            foreach ($rules as $tipe => $data) {
                Rule::create([
                    'tipe' => $data['tipe'],
                    'start_time' => $data['start_time'],
                    'end_time' => $data['end_time'] ?? null,
                    'late_after' => $data['late_after'] ?? null,
                    'role_group_id' => $newGroupId,
                    'is_active' => $isActive,
                ]);
            }

            return redirect()->route('rule.index')->with('success', 'Aturan kehadiran berhasil disimpan.');
        } catch (\Throwable $th) {
            report($th);
            return back()->withInput()->with('error', 'Gagal menyimpan data: ' . $th->getMessage());
        }
    }




    public function edit($role_group_id)
    {
        // Ambil dua rule: masuk dan pulang berdasarkan role_group_id
        $rules = Rule::where('role_group_id', $role_group_id)->get();

        $masuk = $rules->firstWhere('tipe', 'masuk');
        $pulang = $rules->firstWhere('tipe', 'pulang');

        // Format waktu ke H:i jika datanya ada
        if ($masuk) {
            $masuk->start_time = date('H:i', strtotime($masuk->start_time));
            $masuk->end_time = $masuk->end_time ? date('H:i', strtotime($masuk->end_time)) : null;
            $masuk->late_after = $masuk->late_after ? date('H:i', strtotime($masuk->late_after)) : null;
        }

        if ($pulang) {
            $pulang->start_time = date('H:i', strtotime($pulang->start_time));
            $pulang->end_time = $pulang->end_time ? date('H:i', strtotime($pulang->end_time)) : null;
            $pulang->late_after = $pulang->late_after ? date('H:i', strtotime($pulang->late_after)) : null;
        }

        return view('main.rule.update', compact('masuk', 'pulang', 'role_group_id'));
    }


    public function update(RuleRequest $request, $role_group_id)
    {
        $rules = $request->validated()['rules'];

        try {
            foreach ($rules as $tipe => $data) {
                Rule::updateOrCreate(
                    ['role_group_id' => $role_group_id, 'tipe' => $data['tipe']],
                    [
                        'start_time' => $data['start_time'],
                        'end_time' => $data['end_time'] ?? null,
                        'late_after' => $data['late_after'] ?? null,
                    ]
                );
            }

            return redirect()->route('rule.index')->with('success', 'Aturan kehadiran berhasil diperbarui.');
        } catch (\Throwable $th) {
            report($th);
            return back()->withInput()->with('error', 'Gagal memperbarui data: ' . $th->getMessage());
        }
    }




    public function toggleStatus($role_group_id)
    {
        DB::beginTransaction();

        try {
            $rules = Rule::where('role_group_id', $role_group_id)->get();

            if ($rules->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Rule dengan role_group_id tersebut tidak ditemukan.'
                ]);
            }

            // Cek apakah hanya ada satu rule aktif di database
            $activeGroupCount = Rule::where('is_active', true)->distinct('role_group_id')->count();

            if ($activeGroupCount <= 1 && $rules->first()->is_active) {
                return response()->json([
                    'title' => 'Gagal',
                    'status' => 'error',
                    'message' => 'Tidak dapat menonaktifkan satu-satunya rule yang aktif. Harus ada minimal satu rule aktif.'
                ]);
            }

            // Nonaktifkan semua rule
            Rule::query()->update(['is_active' => false]);

            // Aktifkan semua rule dalam grup ini
            Rule::where('role_group_id', $role_group_id)->update(['is_active' => true]);

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

    public function destroy($role_group_id)
    {
        try {
            $rules = Rule::where('role_group_id', $role_group_id)->get();

            if ($rules->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'title' => 'Terjadi Kesalahan',
                    'message' => 'Rule dengan role_group_id tersebut tidak ditemukan.'
                ]);
            }

            // Cek apakah rule ini satu-satunya yang aktif
            $activeGroupCount = Rule::where('is_active', true)->distinct('role_group_id')->count();

            $isGroupActive = Rule::where('role_group_id', $role_group_id)->where('is_active', true)->exists();

            if ($activeGroupCount <= 1 && $isGroupActive) {
                return response()->json([
                    'status' => 'error',
                    'title' => 'Terjadi Kesalahan',
                    'message' => 'Tidak dapat menghapus rule yang sedang aktif dan satu-satunya. Aktifkan rule lain terlebih dahulu.'
                ]);
            }

            // Hapus semua rule dalam grup ini
            Rule::where('role_group_id', $role_group_id)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Semua rule dalam grup berhasil dihapus.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'title' => 'Terjadi Kesalahan',
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
