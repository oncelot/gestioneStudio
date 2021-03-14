<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



class wbsController extends Controller
{

    public function getidWbs(Request $r)
    {

        $dettagliWbs = DB::table('wbs')->where('id_progetto', $r["id_progetto"])->where("tipo", $r["tipo_wbs"])->select("*")->get();
        $numerorighe = $dettagliWbs->count();



        if ($numerorighe == "0") {
            $stringRitorno = ["response" => "vuoto", "message" => "vuoro"];
            return response()->json($stringRitorno);
        } else {
            $stringRitorno = ["response" => "ok", "message" => $dettagliWbs];
            return response()->json($stringRitorno);
        }
    }
    public function salvaIdWbs(Request $wbs)
    {
        $stringRitorno = "";
        if ($wbs["inizio"] == "") {
            $wbs["inizio"] = "1900-01-01";
        }
        if ($wbs["fine"] == "") {
            $wbs["fine"] = "1900-01-01";
        }
        if ($wbs["assegnato"] == "") {
            $wbs["assegnato"] = "0";
        }
        if ($wbs["priorita"] == "") {
            $wbs["priorita"] = "0";
        }
        try {
            DB::table('wbs')->updateOrInsert(
                ["id_progetto" => $wbs["id_progetto"], "tipo" => $wbs["tipowbs"]],
                ["descrizione" => $wbs["descrizione"], "persona_assegnata" => $wbs["assegnato"], "stato" => $wbs["stato"], "priorita" => $wbs["priorita"], "inizio" => $wbs["inizio"], "fine" => $wbs["fine"]]
            );

            $stringRitorno = ["response" => "ok", "message" => "Wbs Modificato"];
        } catch (\Throwable $th) {
            $stringRitorno = ["response" => "Error", "message" => $th->getMessage()];
        }
        return response()->json($stringRitorno);
    }
}
