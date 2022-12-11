<?php

namespace App\Http\Controllers;

use App\Models\Epresence;
use Illuminate\Http\Request;

class EpresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    public function out(Request $request)
    {
        $validateData = $request->validate([
            'type' => 'required',
            'waktu' => 'required',
        ]);

        $epresence = Epresence::create([
            'id_users' => $request->user()->id,
            'type' => $request->type,
            'is_approve' => 'FALSE',
            'waktu' => $request->waktu,
        ]);

        return response()->json([
            'type' => $request->type,
            'waktu' => $request->waktu,
        ]);

    }
    public function in(Request $request)
    {
        $validateData = $request->validate([
            'type' => 'required',
            'waktu' => 'required',
        ]);

        $epresence = Epresence::create([
            'id_users' => $request->user()->id,
            'type' => $request->type,
            'is_approve' => 'TRUE',
            'waktu' => $request->waktu,
        ]);

        return response()->json([
            'type' => $request->type,
            'waktu' => $request->waktu,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Epresence  $epresence
     * @return \Illuminate\Http\Response
     */
    public function show(Epresence $epresence)
    {
        // $data = DB::table('epresences')->join('users', 'epresences.id_users', '=', 'users.id')->select('*')->groupBy('epresences.type')->get();
        $in = $epresence->join('users', 'epresences.id_users', '=', 'users.id')->where('epresences.type', '=', 'IN')->latest('epresences.id')->first();
        $out = $epresence->join('users', 'epresences.id_users', '=', 'users.id')->where('epresences.type', '=', 'OUT')->where('epresences.is_approve', '=', 'FALSE')->latest('epresences.id')->first();
        $approve = $epresence->join('users', 'epresences.id_users', '=', 'users.id')->where('epresences.type', '=', 'OUT')->where('epresences.is_approve', '=', 'TRUE')->latest('epresences.id')->first();
        $inapprove = ($in->is_approve == 'TRUE') ? 'Approve' : 'Reject';
        $outapprove = ($out->is_approve == 'TRUE') ? 'Approve' : 'Reject';
        $outapprovetrue = ($approve->is_approve == 'TRUE') ? 'Approve' : 'Reject';
        $date = date('Y-m-d', strtotime($in->waktu));
        $timeIn = date('H:i:s', strtotime($in->waktu));
        $timeOut = date('H:i:s', strtotime($out->waktu));
        $timeOutApprove = date('H:i:s', strtotime($approve->waktu));
        // $out = Epresence::where('id_users','=',1)->where('type','=','OUT')->last();
        return response()->json([
            // 'data'=> $in
            'status_code' => 200,
            'message' => "Success get data",
            "data" => [
                [

                    "id_users" => $in->id_users,
                    "nama_user" => $in->nama,
                    "tanggal" => $date,
                    "waktu masuk" => $timeIn,
                    "waktu pulang" => $timeOut,
                    "status_masuk" => $inapprove,
                    "status_pulang" => $outapprove,
                ],
                [
                    "id_users" => $in->id_users,
                    "nama_user" => $in->nama,
                    "waktu masuk" => $timeIn,
                    "waktu pulang" => $timeOutApprove,
                    "status_masuk" => $inapprove,
                    "status_pulang" => $outapprovetrue,

                ],

            ],
        ]);
    }

    public function approve(Request $request)
    {
        $validateData = $request->validate([
            'id_users' => 'required',
            'type' => 'required',
            'waktu' => 'required',
        ]);

        $epresence = Epresence::create([
            'id_users' => $request->id_users,
            'type' => $request->type,
            'is_approve' => 'TRUE',
            'waktu' => $request->waktu,
        ]);
        return response()->json(['data' => $epresence]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Epresence  $epresence
     * @return \Illuminate\Http\Response
     */
    public function edit(Epresence $epresence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Epresence  $epresence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Epresence $epresence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Epresence  $epresence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Epresence $epresence)
    {
        //
    }
}
