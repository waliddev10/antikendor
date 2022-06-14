<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\DataPkbPerusahaanImport;
use App\Models\DataPkbPerusahaan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class DataPkbPerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return DataTables::of(DataPkbPerusahaan::all())
                ->addColumn('action', function ($item) {
                    return '<div class="btn-group">
                <button class="btn btn-xs btn-info" title="Ubah" data-toggle="modal" data-target="#modalContainer" data-title="Ubah" href="' . route('data_pkb_perusahaan.edit', $item->id) . '"><i class="fas fa-edit fa-fw"></i></button>
                <button href="' . route('data_pkb_perusahaan.destroy', $item->id) . '" class="btn btn-xs btn-danger delete" data-target-table="tableDokumen"><i class="fa fa-trash"></i></button>
                </div>';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.data_pkb_perusahaan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.data_pkb_perusahaan.create');
    }
    public function upload()
    {
        return view('pages.data_pkb_perusahaan.upload');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'no_pol' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kendaraan' => 'required',
            'merk_kendaraan' => 'required',
            'mesin_kendaraan' => 'required',
            'status_kendaraan' => 'required',
            'no_hp' => 'nullable',
            'nilai_pokok_pkb' => 'numeric|nullable',
            'nilai_denda_pkb' => 'numeric|nullable',
            'tgl_akhir_pkb' => 'required',
            'tgl_akhir_stnk' => 'required',
        ]);

        DataPkbPerusahaan::create([
            'no_pol' => $request->no_pol,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'merk_kendaraan' => $request->merk_kendaraan,
            'mesin_kendaraan' => $request->mesin_kendaraan,
            'status_kendaraan' => $request->status_kendaraan,
            'no_hp' => $request->no_hp,
            'nilai_pokok_pkb' => $request->nilai_pokok_pkb,
            'nilai_denda_pkb' => $request->nilai_denda_pkb,
            'tgl_akhir_pkb' => $request->tgl_akhir_pkb,
            'tgl_akhir_stnk' => $request->tgl_akhir_stnk,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil ditambah.',
        ], Response::HTTP_CREATED);
    }
    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:xls,xlsx',
        ]);

        Excel::import(new DataPkbPerusahaanImport, $request->file('file')->store('temp'));

        return response()->json([
            'status' => 'success',
            'message' => 'File excel berhasil diimport.',
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show(DataPkbPerusahaan $data_pkb_perusahaan)
    // {
    //     return view('pages.data_pkb_perusahaan.edit', ['item' => $data_pkb_perusahaan]);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DataPkbPerusahaan $data_pkb_perusahaan)
    {
        return view('pages.data_pkb_perusahaan.edit', ['item' => $data_pkb_perusahaan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'no_pol' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kendaraan' => 'required',
            'merk_kendaraan' => 'required',
            'mesin_kendaraan' => 'required',
            'status_kendaraan' => 'required',
            'no_hp' => 'nullable',
            'nilai_pokok_pkb' => 'numeric|nullable',
            'nilai_denda_pkb' => 'numeric|nullable',
            'tgl_akhir_pkb' => 'required',
            'tgl_akhir_stnk' => 'required',
        ]);

        $data = DataPkbPerusahaan::findOrFail($id);
        $data->no_pol = $request->no_pol;
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->jenis_kendaraan = $request->jenis_kendaraan;
        $data->merk_kendaraan = $request->merk_kendaraan;
        $data->mesin_kendaraan = $request->mesin_kendaraan;
        $data->status_kendaraan = $request->status_kendaraan;
        $data->no_hp = $request->no_hp;
        $data->nilai_pokok_pkb = $request->nilai_pokok_pkb;
        $data->nilai_denda_pkb = $request->nilai_denda_pkb;
        $data->tgl_akhir_pkb = $request->tgl_akhir_pkb;
        $data->tgl_akhir_stnk = $request->tgl_akhir_stnk;
        $data->update();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diubah.',
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DataPkbPerusahaan::findOrFail($id);
        $data->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus.'
        ], Response::HTTP_ACCEPTED);
    }
}
