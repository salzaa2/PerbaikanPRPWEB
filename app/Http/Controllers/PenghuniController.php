<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penghuni;

class PenghuniController extends Controller
{
    public function beranda()
    {
        $totalPenghuni = \App\Models\Penghuni::where('status', 'Aktif')->count();
        return view('beranda', compact('totalPenghuni'));
    }

    public function index(Request $request)
    {
        $search = $request->query('search');
        $penghunis = Penghuni::when($search, function ($query) use ($search) {
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('no_kamar', 'like', "%{$search}%");
        })->orderBy('id', 'desc')->paginate(5);

        if ($request->ajax()) {
            return view('partials.data', compact('penghunis'))->render();
        }

        return view('index', compact('penghunis'));
    }

    public function store(Request $request)
    {
        Penghuni::create($request->all());
        return response()->json(['message' => 'Data berhasil disimpan']);
    }

    public function edit($id)
    {
        return response()->json(Penghuni::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        Penghuni::findOrFail($id)->update($request->all());
        return response()->json(['message' => 'Data berhasil diperbarui']);
    }

    public function destroy($id)
    {
        Penghuni::destroy($id);
        return response()->json(['message' => 'Data berhasil dihapus']);
    }

    public function search(Request $request)
    {
        $query = $request->query('query');
        $penghunis = Penghuni::when($query, function ($q) use ($query) {
            return $q->where('nama', 'like', "%$query%")
                    ->orWhere('no_kamar', 'like', "%$query%");
        })->paginate(5);

        if ($request->ajax()) {
            return view('penghuni.data', compact('penghunis'))->renderSections()['content'];
        }

        return view('penghuni.data', compact('penghunis'));
    }
}
