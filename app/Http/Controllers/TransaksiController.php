<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use App\Http\Requests\StoretransaksiRequest;
use App\Http\Requests\UpdatetransaksiRequest;
use App\Http\Requests\getTotalTransaksiRequest;
use App\Repositories\TransaksiRepositoryInterface;

class TransaksiController extends Controller
{
    protected $TransaksiRepository;

    public function __construct(TransaksiRepositoryInterface $TransaksiRepository)
    {
        $this->TransaksiRepository = $TransaksiRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('transaksi.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoretransaksiRequest $request)
    {
        //
    }

    /**
     * Get Total Data.
     */
    public function getTotal(getTotalTransaksiRequest $request)
    {
        $total = $this->TransaksiRepository->getTotal($request->data);
        return $total;
    }

    /**
     * Display the specified resource.
     */
    public function show(transaksi $transaksi)
    {
        return view('transaksi.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(transaksi $transaksi,$id)
    {
        $transaksi = $this->TransaksiRepository->findById($id);

        $data = [
            'transaksi' => $transaksi,
            'idTransaksi' => $id
        ];
        return view('transaksi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetransaksiRequest $request, transaksi $transaksi)
    {
        if (request()->ajax()) {
            $transaksi = $this->TransaksiRepository->update($request->data);
            return response()->json(['message' => 'Record updated successfully']);
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(transaksi $transaksi,$id)
    {
        if (request()->ajax()) {
            $this->TransaksiRepository->delete($id);
            return response()->json(['message' => 'Record deleted successfully']);
        }
        
    }
}
