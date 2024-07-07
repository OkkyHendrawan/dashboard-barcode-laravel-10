<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorPNG;
use App\Models\OkkyHendrawan1462200279Tiket;
use App\Models\OkkyHendrawan1462200279Transaksi;

class OkkyHendrawan1462200279TransaksiController extends Controller
{

        public function index()
        {
            $transaksi = OkkyHendrawan1462200279Transaksi::getTransaksi();
            return view('page.transaksi.list', compact('transaksi'));
        }

        public function form_create()
        {
            $tiket = OkkyHendrawan1462200279Tiket::where('is_delete', 0)->get();
            $generator = new BarcodeGeneratorPNG();
            $barcode = null;

            return view('page.transaksi.add', compact('tiket', 'barcode'));
        }

        public function proses_create(Request $request)
        {
            $request->validate([
                'wisata_id' => 'required|exists:okky_hendrawan1462200279_tikets,id',
                'harga_tiket' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/'
            ]);

            $transaksi = new OkkyHendrawan1462200279Transaksi();
            $transaksi->wisata_id = $request->wisata_id;
            $transaksi->harga_tiket = $request->harga_tiket;
            $transaksi->is_delete = 0;

            $currentDateTime = now('Asia/Jakarta');
            $transaksi->created_at = $currentDateTime;
            $transaksi->updated_at = $currentDateTime;

            $transaksi->save();

            return redirect()->route('page.transaksi.list')->with('success', 'Transaksi berhasil ditambahkan.');
        }

        public function edit($id)
        {
            $transaksi = OkkyHendrawan1462200279Transaksi::findOrFail($id);
            $data['daftarTransaksi'] = OkkyHendrawan1462200279Tiket::daftarTransaksi();

            $generator = new BarcodeGeneratorPNG();
            $barcode = base64_encode($generator->getBarcode($transaksi->wisata_id, $generator::TYPE_CODE_39));

            return view('page.transaksi.edit', compact('transaksi', 'barcode'), $data);
        }

        public function update(Request $request, $id)
        {
            $request->validate([
                'wisata_id' => 'required',
                'harga_tiket' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/'
            ]);

            $transaksi = OkkyHendrawan1462200279Transaksi::findOrFail($id);
            $transaksi->update($request->all());

            $currentDateTime = now('Asia/Jakarta');
            $transaksi->updated_at = $currentDateTime;
            $transaksi->save();

            return redirect()->route('page.transaksi.list')->with('success', 'Transaksi berhasil diperbarui.');
        }

        public function softDeleteTransaksi($id)
            {
                $transaksi = OkkyHendrawan1462200279Transaksi::softDeleteTransaksi($id);

                if ($transaksi) {
                    return redirect()->back()->with('success', 'Transaksi berhasil di hapus .');
                } else {
                    return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
                }
            }

    }
