<?php

namespace App\Http\Controllers;

use App\Exports\TiketExport;
use Barryvdh\DomPDF\Facade\PDF;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\OkkyHendrawan1462200279Tiket;

class OkkyHendrawan1462200279TiketController extends Controller
{
    public function index()
    {
        $tiket = OkkyHendrawan1462200279Tiket::getTiket();
        return view('page.tiket.list', compact('tiket'));
    }

    public function form_create()
    {
        return view('page.tiket.add');
    }

    public function proses_create(Request $request)
    {
        $request->validate([
            'nama_wisata' => 'nullable|string|max:100',
            'harga_tiket' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/'
        ]);

        $tiket = new OkkyHendrawan1462200279Tiket($request->all());

        if ($request->hasFile('gambar')) {
            $photo = $request->file('gambar');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('gambar-wisata'), $photoName);
            $tiket->gambar = $photoName;
        }
            $tiket->is_delete = 0;

            $currentDateTime = now('Asia/Jakarta');
            $tiket->created_at = $currentDateTime;
            $tiket->updated_at = $currentDateTime;

            $tiket->save();

        return redirect()->route('page.tiket.list')->with('success', 'Tiket berhasil ditambahkan.');
    }

    public function edit($id)
        {
            $tiket = OkkyHendrawan1462200279Tiket::findOrFail($id);
            return view('page.tiket.edit', compact('tiket'));
        }

    public function update(Request $request, $id)
        {

        $request->validate([
            'nama_wisata' => 'nullable|string|max:100',
            'harga_tiket' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/'
        ]);

            $tiket = OkkyHendrawan1462200279Tiket::findOrFail($id);
            $tiket->fill($request->all());

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarName = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move(public_path('gambar-wisata'), $gambarName);
            $tiket->gambar = $gambarName;
        }

            $currentDateTime = now('Asia/Jakarta');
            $tiket->updated_at = $currentDateTime;

            $tiket->save();

            return redirect()->route('page.tiket.list')->with('success', 'Tiket Berhasil di Perbarui.');
    }

    public function softDeleteTiket($id)
        {
            $tiket = OkkyHendrawan1462200279Tiket::softDeleteTiket($id);

            if ($tiket) {
                return redirect()->back()->with('success', 'Tiket berhasil di hapus .');
            } else {
                return redirect()->back()->with('error', 'Tiket tidak ditemukan.');
            }
        }

    public function export($type)
        {
            $tiket = OkkyHendrawan1462200279Tiket::where('is_delete', 0)->get();

            if ($type === 'pdf') {
                $pdf = PDF::loadView('export.tiket_pdf', compact('tiket'));
                return $pdf->download('Data Tiket.pdf');
            }

            if ($type === 'excel') {
                return Excel::download(new TiketExport($tiket), 'Data Tiket.xlsx');
            }

            return redirect()->back()->with('error', 'Tipe ekspor tidak valid');
        }

    public function search(Request $request)
        {
            $query = OkkyHendrawan1462200279Tiket::query();

            // Filter berdasarkan nama wisata
            if ($request->has('search_nama_wisata')) {
                $query->where('nama_wisata', 'like', '%' . $request->input('search_nama_wisata') . '%');
            }

            // Filter berdasarkan harga tiket
            if ($request->has('search_harga_tiket')) {
                $query->where('harga_tiket', 'like', '%' . $request->input('search_harga_tiket') . '%');
            }

            $tiket = $query->paginate(5);

            return view('page.tiket.list', compact('tiket'));
        }

}
