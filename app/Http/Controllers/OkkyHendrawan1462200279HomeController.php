<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HomeExport;
use Illuminate\Http\Request;
use App\Models\OkkyHendrawan1462200279Home;

class OkkyHendrawan1462200279HomeController extends Controller
{
    public function index()
    {
        $home = OkkyHendrawan1462200279Home::getHome();
        return view('page.home.list', compact('home'));
    }

    public function form_create()
    {
        return view('page.home.add');
    }

    public function proses_create(Request $request)
    {
        $request->validate([
            'nbi' => 'required|unique:okky_hendrawan1462200279_homes,nbi',
            'nama' => 'required|string|max:100',
        ]);

            $home = new OkkyHendrawan1462200279Home;
            $home->nbi = $request->nbi;
            $home->nama = $request->nama;
            $home->is_delete = 0;
            $currentDateTime = now('Asia/Jakarta');
            $home->created_at = $currentDateTime;

            $home->save();

            return redirect()->route('page.home.list')->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $home = OkkyHendrawan1462200279Home::findOrFail($id);
        return view('page.home.edit', compact('home'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nbi' => 'required|unique:okky_hendrawan1462200279_homes,nbi,' . $id,
            'nama' => 'required|string|max:100',
        ]);

            $home = OkkyHendrawan1462200279Home::findOrFail($id);

            $home->update($request->all());
            $currentDateTime = now('Asia/Jakarta');
            $home->updated_at = $currentDateTime;
            $home->save();

            return redirect()->route('page.home.list')->with('success', 'Mahasiswa Berhasil Diperbarui.');
    }

    public function softDeleteHome($id)
        {
            $home = OkkyHendrawan1462200279Home::softDeleteHome($id);
            if ($home) {
                return redirect()->back()->with('success', 'Mahasiswa berhasil di hapus .');
            } else {
                return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan.');
            }
        }

    public function export($type)
    {
        $home = OkkyHendrawan1462200279Home::where('is_delete', 0)->get();
        if ($type === 'pdf') {
            $pdf = PDF::loadView('export.home_pdf', compact('home'));
            return $pdf->download('Data Mahasiswa.pdf');
        }
        if ($type === 'excel') {
            return Excel::download(new HomeExport($home), 'Data Mahasiswa.xlsx');
        }
        return redirect()->back()->with('error', 'Tipe ekspor tidak valid');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $home = OkkyHendrawan1462200279Home::where('nama', 'like', '%'.$search.'%')->paginate(5);
        return view('page.home.list', compact('home'));
    }

}
