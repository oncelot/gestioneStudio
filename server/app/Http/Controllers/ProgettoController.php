<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



class ProgettoController extends Controller
{
    //
public function listaProgetti(Request $i){
    $lista=[];
    $dettaglio=[
    "id"=>"",
    "titolo_progetto"=>"",
    "codice_commessa"=>"",
    "elencoAutorizzati"=>[],
    ];
        try {
            $request= $i->params;
           
            if (str_contains($request["role"],"admin")){
                
                $elencoprogetti=DB::table('progetti')->select('progetti.id','progetti.titolo_progetto','progetti.codice_commessa')->orderBy('progetti.id','desc')->get(); 
                foreach ($elencoprogetti as $key => $value) 
                {
                  $dettaglio["id"]=$value->id;
                  $dettaglio["titolo_progetto"]=$value->titolo_progetto;
                  $dettaglio["codice_commessa"]=$value->codice_commessa;
                  
                    $elencoAutorizzati=DB::table('user-associato-progetto')->join('users','id_user','users.id')->where("id_progetto",$value->id)->select("name")->get(); 
                    $dettaglio["elencoAutorizzati"]=$elencoAutorizzati;
    
                    array_push($lista,$dettaglio);
                }
              
                
                return  response()
                         ->json($lista);
            }else{
                $elencoprogetti=DB::table('progetti')
                ->join('user-associato-progetto','progetti.id','user-associato-progetto.id_progetto')->where('user-associato-progetto.id_user',$request->id)->select('progetti.id','progetti.titolo_progetto')
                ->orderBy('progetti.id','desc')->get();
                foreach ($elencoprogetti as $key => $value) 
                {
    
                    $dettaglio["id"]=$value->id;
                    $dettaglio["titolo_progetto"]=$value->titolo_progetto;
                    $dettaglio["codice_commessa"]=$value->codice_commessa;
                    array_push($lista,$dettaglio);
                }
    
    
                return  response()
                         ->json($lista);
            }
         
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    

}
    public function creaProgetto(Request $i){
        $path =  app()->basePath('public/');
      
          $zonaClimatica="";
          $datistrutturalichk="";
          $tipologiaParetechk="";
          $tipologia_doppia_parete="";
          $isolamentoEsistentechk="";
          $TipoInterventoProposto="";//
          $TipologiainterventoDPR3802001="";
          $quotaPreventivo=0;
          $numeroPertinnzeAccatastateCD=0;

          
          if(count ($i->zonaClimatica) > 0){
            $zonaClimatica=implode(";",$i->zonaClimatica);}
    
        if(count ($i->datistrutturalichk) > 0){
            $datistrutturalichk= implode(";",$i->datistrutturalichk);}
    
        if(count ($i->tipologiaParetechk) > 0){
            $tipologiaParetechk= implode(";",$i->tipologiaParetechk);}
    
        if(count ($i->tipologia_doppia_parete) > 0){
            $tipologia_doppia_parete= implode(";",$i->tipologia_doppia_parete);}
    
        if(count ($i->isolamentoEsistentechk) > 0){
            $isolamentoEsistentechk= implode(";",$i->isolamentoEsistentechk);}
    
        if(count ($i->TipoInterventoProposto) > 0){
            $TipoInterventoProposto= implode(";",$i->TipoInterventoProposto);}
    
        if(count ($i->TipologiainterventoDPR3802001) > 0){
            $TipologiainterventoDPR3802001= implode(";",$i->TipologiainterventoDPR3802001);}
        
        if(count ($i->numeroPertinnzeAccatastateCD) > 0){
            $numeroPertinnzeAccatastateCD= implode(";",$i->numeroPertinnzeAccatastateCD);}
        
        if($i->dateAutorizzativi == ''){
            $i->dateAutorizzativi='1900-01-01';
        }
        if($i->quotaPreventivo != ''){
            $quotaPreventivo=$i->quotaPreventivo ;
        }
        try 
        {
            $idProgetto=DB::table('progetti')->insertGetId([
                'titolo_progetto' =>$i->titoloProgetto,
                'tipologia_edificio'=>$i->tipologiaEdificio,
                'codice_commessa'=>$i->numeroCommessa,
                'tipo_commessa'=>$i->tipoCommessa,
                'zona_climatica'=> $zonaClimatica,
                'gradi_giorno'=>$i->gradigiornoText,
                'areavincolata'=>$i->areavincolata42,
                'tipo_vincolo'=>$i->tipoVincolo42,
                'zonasismisca'=>$i->zonasismisca4,
                'interventi_antisismici'=>$i->zonasismisca4Interventiantisismici,
                'interventi_sismici_altri_vincoli'=>$i->zonasismisca4InterventiantisismiciAltriVincoli,
                'TipoInterventoProposto'=>$TipoInterventoProposto,
                'TipologiainterventoDPR3802001'=>$TipologiainterventoDPR3802001,
                'tipologiaTitoloAutorizzativi'=>$i->tipologiaTitoloAutorizzativi,
                'riferimentiAutorizzativi'=>$i->riferimentiAutorizzativi,
                'dateAutorizzativi'=>$i->dateAutorizzativi,
                'AllegatoTitoloAutorizzativo'=>$i->AllegatoTitoloAutorizzativo,
        
                'abusiEdilizi'=>$i->abusiEdilizi ,
                'TipologiaAbusiEdilizi'=>$i->TipologiaAbusiEdilizi ,
                'comuneStatoDiFatto'=>$i->comuneStatoDiFatto,
                'NCEUStatoDiFatto'=>$i->NCEUStatoDiFatto ,
                'difformitaUrbanistiche'=>$i->difformitaUrbanistiche ,
               'noteDifformitaUrbanistiche'=>$i->noteDifformitaUrbanistiche ,
                'difformitaCatastali'=>$i->difformitaCatastali ,
                'noteDifformitaCatastali'=>$i->noteDifformitaCatastali ,
                'irregolaritaSanabili'=>$i->irregolaritaSanabili ,
                'noteIrregolaritaSanabili'=>$i->noteIrregolaritaSanabili ,
                
                'tipologia_struttura_edificiio'=>$datistrutturalichk,
                'altroDatiStrutturali'=>$i->altroDatiStrutturali,
                
               'tipologia_parete'=>$tipologiaParetechk,
                'altroTipologiaParetechk'=>$i->altroTipologiaParetechk,
                
              'tipologia_doppia_parete'=>$tipologia_doppia_parete,
                'spessori_muri_esternicm'=>$i->SpessoreMuriEsterni ,
                'spessori_camera_ariacm'=>$i->SpessoreCameraDaria ,
                'spessore_isolamentocm'=>$i->SpessoreIsolamento ,
               'tipo_isolamento_camera_aria'=>$i->TipologiaIsolamentoIncameraDaria ,
                
                 'cappotto'=>$isolamentoEsistentechk,
                'altroisolamentoEsistente'=>$i->altroisolamentoEsistentechk,
        
                'centraletermicaesistente_tipo_impianto'=>$i->tipologiaImpiantoEsistente ,
                'centraletermicaesistente_tecnologia_impianto'=>$i->cetraleTermicaCentralizzatoTecnologiaImpiantoEsistente ,
                'cetraleTermicaCentralizzatoTecnologiaImpiantoEsistenteAltro'=>$i->cetraleTermicaCentralizzatoTecnologiaImpiantoEsistenteAltro ,      
                
                'centraletermicaesistente_numero_unita_generazione'=>$i->cetraleTermicaCentralizzatoNumeroUnita	 ,
                'centraletermicaesistente_anno_installazione'=>$i->cetraleTermicaCentralizzatoAnnoInstallazione ,
                'centraletermicaesistente_potenza_termica'=>$i->cetraleTermicaCentralizzatoPotenzaTermicaImpiantoEsistente ,
                'centraletermicaesistente_tipologia_distribuzione'=>$i->cetraleTermicaCentralizzatoTipologiaDistribuzioneEsiste ,
                'centraletermicaesistente_tipologia_termoregolazione'=>$i->cetraleTermicaCentralizzatoTipologiaTermoregolazioneEsistente ,
                'centraletermicaesistente_libretto_impianto_aggiornato'=>$i->cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornato ,
                //cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornatoAllegato TODO tabella allegati
                'centraletermicaesistente_provefumi'=>$i->cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornate ,
                //cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornateAllegato TODO tabella allegata
                'centraletermicaesistente_cpi'=>$i->cetraleTermicaCentralizzatoCertificatoCPI ,
                //cetraleTermicaCentralizzatoCertificatoCPIAllegato TODO TABELLA ALLEGATO
                'centraletermicaprogetto_tecnologia_esistente'=>$i->cetraleTermicaCentralizzatoTecnologiaImpiantoProposto,
                'centraletermicaprogetto_tecnologia_esistente_altro'=>$i->cetraleTermicaCentralizzatoTecnologiaImpiantoPropostonteAltro,
                
                
                'centraletermicaprogetto_numero_unita'=>$i->cetraleTermicaCentralizzatoNumeroUnitaProposte ,
                'centraletermicaprogetto_potenza_termica'=>$i->cetraleTermicaCentralizzatoPotenzaTermicaImpiantoProposto ,
                'centraletermicaprogetto_vettore_energetico'=>$i->centraleTermivaCentralizzatoVettoreImpianto ,
                'quota_preventivo'=>$quotaPreventivo ,
              
                
            ]);

            if ($idProgetto > 0)
            {
                if ($i->AllegatoTitoloAutorizzativo != '')
                {
                    $nomefile = $i->AllegatoTitoloAutorizzativo;
                    $file =base64_decode($i->Base64AllegatoTitoloAutorizzativo);
                    mkdir($path."/".$idProgetto);
                    file_put_contents($path."/".$idProgetto."/".$nomefile, $file);
                }
                
                if ($i->quoteAllegatoPreventivo != '')
                {
                    $nomefile = $this->generaNomeFile($i->quoteAllegatoPreventivo);
                    DB::table('allegati_progetto')->insertGetId([
                     'id_progetto' =>$idProgetto,
                     'id_legame' =>0,
                     'nome_file' =>$nomefile,
                     'note_allegato' =>'',
                     'tipo_allegato' =>$tipoAllegati::$preventivoFirmato,
                     ]);
                     $file =base64_decode($i->base64AllegatoPreventivo);
                     if (!file_exists($path."/".$idProgetto)){
                         mkdir($path."/".$idProgetto);}
                         file_put_contents($path."/".$idProgetto."/". $nomefile, $file);
                }

                if (count($i->clienti) > 0)
                {
                    foreach ($i->clienti as $value) 
                    {
                        DB::table('clienti_progetto')->insertGetId([
                            'id_progetto' =>$idProgetto,
                            'id_cliente'=>$value['id'],
                        ]);
                    }
                }

                if (count($i->collaboratoriInterni) > 0)
                {
                    foreach ($i->collaboratoriInterni as $value) {
                        DB::table('collaboratori_interni_progetto')->insertGetId([
                            'id_progetto' =>$idProgetto,
                            'id_collaboratore_interno'=>$value['id'],
                        ]);
                    }
                }

                if (count($i->collaboratoriEsterni) > 0)
                {
                    foreach ($i->collaboratoriEsterni as $value) {
                       DB::table('collaboratori_esterni_progetto')->insertGetId([
                            'id_progetto' =>$idProgetto,
                            'id_collaboratore_esterno' =>$value['id'],
                        ]);
                    }
                }

                $tipoEdificio= new tipologiaEdificio();
            
            if ($i->tipologiaEdificio == $tipoEdificio->condominio )
            {
        
                $annoCostruzioneCD=$i->annoCostruzioneCD;
                if($i->annoCostruzioneCD == ''){
                    $annoCostruzioneCD=-1;
                }
                $pianoImmobileCD=$i->pianoImmobileCD;
                if($i->pianoImmobileCD == ''){
                    $pianoImmobileCD=-1;
                }
                $numeroUnitaAccatastateCD=$i->numeroUnitaAccatastateCD;
                if($i->numeroUnitaAccatastateCD == ''){
                    $numeroUnitaAccatastateCD=-1;
                }
                $numeroUnitaScaldateCD=$i->numeroUnitaScaldateCD;
                if($i->numeroUnitaScaldateCD == ''){
                    $numeroUnitaScaldateCD=-1;
                }
                DB::table('tipologia_edificio_progetto')->insertGetId([
                    'id_progetto'=>$idProgetto,
                    'tipo_edificio'=>$i->tipologiaEdificio,
                    'cd_unico_proprietario'=>$i->condominioUnicoProprietarioCD,
                    'cd_ires'=>$i->IRESCD,
                    'cd_condomini_altri_unita'=>$i->mutliProprietaCD,
                    'cd_a1a8a9'=>$i->condominioA1A8A9CD,
                    'cd_usufruito110'=>$i->usufruito110CD,
                    'cd_nome_condominio'=>$i->nomeCondominioCD,
                    'cd_indirizzo'=>$i->indirizzoCD,
                    'cd_citta'=>$i->cittaCD,
                    'cd_provincia'=>$i->provinciaCD,
                    'cd_annocostruzione'=>$annoCostruzioneCD,
                    'cd_piano_immobile'=>$pianoImmobileCD,
                    'cd_numero_ui_accatastate'=>$numeroUnitaAccatastateCD,
                    'cd_numero_ui_riscaldate'=>$numeroUnitaScaldateCD,
                    'cd_numero_pertinnze_accatastate'=>$numeroPertinnzeAccatastateCD,
                    'cd_condominio_costituito'=>$i->condominioFormalmenteCostituitoCD,
                    'cd_codicefiscale_condominio'=>$i->cd_codicefiscale_condominio,
                    'cd_info_condominiocostituito'=>$i->cd_info_condominiocostituito,
                    ]);


            }else{
                $annoCostruzioneEF=$i->annoCostruzioneEF;
                if($i->annoCostruzioneEF == ''){
                    $annoCostruzioneEF=-1;
                }
                $idTipoEdificioProgetto= DB::table('tipologia_edificio_progetto')->insertGetId([
                    'id_progetto'=>$idProgetto,
                    'tipo_edificio'=>$i->tipologiaEdificio,
                    'ef_tipo_edificio'=>$i->tipoEdificioEF,
                    'ef_altroTipoEdificioFamiliare'=>$i->altroTipoEdificioFamiliare,
                    'ef_indirizzo'=>$i->indirizzoEF,
                    'ef_citta'=>$i->cittaEF,
                    'ef_provincia'=>$i->provinciaEF,
                    'ef_annocostruzione'=>$annoCostruzioneEF,
                    'ef_pianoImmobili'=>$i->pianoImmobileEF,
                    'ef_indipendente'=>$i->indipendenteEF,
                    'ef_accesso_autonomo'=>$i->accessoAutonomiEF,
                    'ef_usufruito_110'=>$i->usufruito110EF,
                    'ef_riqualificazioni_balconi'=>$i->riqualificazioneBalconiEF,
                    ]);
            }

            if (count($i->propietariImmobiliEF) > 0)
            {
                foreach ($i->propietariImmobiliEF as $value) {
                   DB::table('proprietari_immobilief_progetto')->Insert([
                        'id_progetto' =>$idProgetto,
                        'id_tipoedificio'=>$idTipoEdificioProgetto,
                        'nome'=>$value['nome'],
                        'cognome'=>$value['cognome'],
                        'codicefiscale'=>$value['codiceFiscale'],
                        'telefono'=>$value['telefono'],
                    ]);
                }
            }
            if (count($i->progettisti) > 0){
                        
                foreach ($i->progettisti as $value) {
                   DB::table('progettisti_progetto')->insertGetId([
                        'id_progetto' =>$idProgetto,
                        'id_progettista' =>$value['id'],
                    ]);
                }
            }

            if (count($i->successiviInterventiStraordinaria) > 0)
            {
                foreach ($i->successiviInterventiStraordinaria as $value) 
                {
                    if ($value['new']==1 && $value['cancellare'] == '0'){

                        $auxAllegato=$value['allegato'];
                        $idIntervento=DB::table('interventi_manutenzione_straordinaria_progetto')->insertGetId([
                            'id_progetto' =>$idProgetto,
                            'anno_intervento' =>$value['anno'],
                        ]);
                        $nomefile = $this->generaNomeFile($value['allegato']);
                      
                       DB::table('allegati_progetto')->insertGetId([
                            'id_progetto' =>$idProgetto,
                            'id_legame' =>$idIntervento,
                            'tipo_allegato' =>1,
                            'nome_file'=> $nomefile,
                            'note_allegato'=>'',
                        ]);
                        if($value['allegatoBase64'] != '0'){
                        $file =base64_decode($value['allegatoBase64']);
                        if (!file_exists($path."/".$idProgetto)){
                            mkdir($path."/".$idProgetto);}
                       
                        file_put_contents($path."/".$idProgetto."/". $nomefile, $file);
                        }
                    }
                }

            }

            if (count($i->TitoliAutorizzatiInterventiSuccessivi) > 0)
            {
                foreach ($i->TitoliAutorizzatiInterventiSuccessivi as $value) 
                {
                    if($value['new'] == '1' && $value['cancellare'] == '0'){
                          
                        $idIntervento=DB::table('titoli_autorizzati_interventi_successivi')->insertGetId([
                             'id_progetto' =>$idProgetto,
                             'sub' =>$value['sub'],
                             'descrizione' =>$value['descrizione'],
                         ]);
                         $nomefile = $this->generaNomeFile($value['nomeAllegato']);
                       
                      
                        DB::table('allegati_progetto')->insertGetId([
                             'id_progetto' =>$idProgetto,
                             'id_legame' =>$idIntervento,
                             'tipo_allegato' =>2,
                             'nome_file'=>$nomefile,
                             'note_allegato'=>'',
                         ]);
                         if($value['allegatoBase64'] != '0'){
                         $file =base64_decode($value['allegatoBase64']);
                         if (!file_exists($path."/".$idProgetto)){
                             mkdir($path."/".$idProgetto);}
                         file_put_contents($path."/".$idProgetto."/".$nomefile, $file);
                         }
                     }
                }


            }
            if (count($i->datiCatastali) > 0)
            {
                foreach ($i->datiCatastali as $value) {
                  
                   $idIntervento=DB::table('dati_catastali')->insertGetId([
                        'id_progetto' =>$idProgetto,
                        'sub' =>$value['sub'],
                        'foglio' =>$value['foglio'],
                        'particella' =>$value['particella'],
                    ]);
                  
             
                }
            }
            if (count($i->elencoAcconti) > 0)
            {
                foreach ($i->elencoAcconti as $value) {
                   DB::table('quote_progetto')->insertGetId([
                        'id_progetto' =>$idProgetto,
                        'data' =>$value['dataPagamento'],
                        'importo'=>$value['importo'],
                        'modalita_pagamento'=>$value['metodoPagamento'],
                        'chi_ha_fatturata'=>$value['chiFatturato'],
                        'chi_ha_pagato'=>'',
                        'causale'=>'',
                        'tipo_quota'=>$value['tipo_quota'],
    
                    ]);
                }
            }
            if (count($i->elencoSpese) > 0)
            {
                foreach ($i->elencoSpese as $value) {
                   DB::table('quote_progetto')->insertGetId([
                        'id_progetto' =>$idProgetto,
                        'data' =>$value['dataPagamento'],
                        'importo'=>$value['importo'],
                        'modalita_pagamento'=>'',
                        'chi_ha_fatturata'=>'',
                        'causale'=>$value['causale'],
                        'chi_ha_pagato'=>$value['chiHapagato'],
                        'tipo_quota'=>$value['tipo_quota'],
    
                    ]);
                }
            }
            if (count($i->elencoFile) > 0)
            {
                 foreach ($i->elencoFile as $value) 
                 {
                    if($value['new']=='1' && $value['cancellare'] == '0')
                    {
                        $nomefile=explode(".",$value['nomeFile']);
                        $nomefile= $nomefile[0].'_'.date("YmdHis").".".$nomefile[1];
                        
                        DB::table('allegati_progetto')->insertGetId([
                        'id_progetto' =>$idProgetto,
                        'id_legame' =>0,
                        'nome_file' =>$nomefile,
                        'note_allegato' =>$value['noteFile'],
                        'tipo_allegato' =>$value['tipoAllegato'],
                    ]);
                    $file =base64_decode($value['fileBase64']);
                    if (!file_exists($path."/".$idProgetto)){
                    mkdir($path."/".$idProgetto);}
                    file_put_contents($path."/".$idProgetto."/".$nomefile, $file);
                    }
                }

            }
            if (count($i->centraleTermicaDiFAtto) > 0)
            {
                foreach ($i->centraleTermicaDiFAtto as $value) {
                      
                   $idIntervento=DB::table('centrale_termica_autonoma')->insertGetId([
                        'id_progetto' =>$idProgetto,
                        'sub' =>$value['sub'],
                        'tecnologia_impianto' =>$value['tecnologiaImpianto'],
                        'numero_unita' =>$value['numeronUnitaGenerazione'],
                        'tipo_termoregolazione' =>$value['tipologiaSistemaTermoregolazione'],
                        'potenza_kw' =>$value['potenzaTermicaUtile'],
                        'anno_installazione' =>$value['annoInstallazione'],
                        'oggetto_di_sostituzione' =>$value['GeneratoreOggettoDiSostituzione'],
                        'difatto_diprogetto' =>'difatto',
                    ]);
                  
             
                }
            }
            foreach ($i->centraleTermicaDiProgetto as $value) 
            {
                              
                $idIntervento=DB::table('centrale_termica_autonoma')->insertGetId([
                     'id_progetto' =>$idProgetto,
                     'sub' =>$value['sub'],
                     'tecnologia_impianto' =>$value['tecnologiaImpianto'],
                     'numero_unita' =>$value['numeronUnitaGenerazione'],
                     'tipo_termoregolazione' =>$value['tipologiaSistemaTermoregolazione'],
                     'potenza_kw' =>$value['potenzaTermicaUtile'],
                     'anno_installazione' =>$value['annoInstallazione'],
                     'oggetto_di_sostituzione' =>$value['GeneratoreOggettoDiSostituzione'],
                     'difatto_diprogetto' =>'diprogetto',
                 ]);
               
          
             }


            }//if idprogetto > 0


            $stringRitorno=["response"=>"ok","message"=>"Progetto Creato"];

        } 
        catch (\Throwable $th) 
        {
            $stringRitorno=["response"=>"Error","message"=>$th->getMessage()];
        }




        return response()->json($stringRitorno);
    }
    public function aggiornaProgetto(Request $i)
    {
        $path =  app()->basePath('public/');
       
          //  $path="C:\Users\Fausto\source\\repos\oncelot\gestionestudio\server\public";
         //  $out = new \Symfony\Component\Console\Output\ConsoleOutput();
         //   $out->writeln($i);
            $zonaClimatica="";
            $datistrutturalichk="";
            $tipologiaParetechk="";
            $tipologia_doppia_parete="";
            $isolamentoEsistentechk="";
            $TipoInterventoProposto="";//
            $TipologiainterventoDPR3802001="";
            $quotaPreventivo=0;
            $numeroPertinnzeAccatastateCD=0;
           
        
            if(count ($i->zonaClimatica) > 0){
                $zonaClimatica=implode(";",$i->zonaClimatica);}
        
            if(count ($i->datistrutturalichk) > 0){
                $datistrutturalichk= implode(";",$i->datistrutturalichk);}
        
            if(count ($i->tipologiaParetechk) > 0){
                $tipologiaParetechk= implode(";",$i->tipologiaParetechk);}
        
            if(count ($i->tipologia_doppia_parete) > 0){
                $tipologia_doppia_parete= implode(";",$i->tipologia_doppia_parete);}
        
            if(count ($i->isolamentoEsistentechk) > 0){
                $isolamentoEsistentechk= implode(";",$i->isolamentoEsistentechk);}
        
            if(count ($i->TipoInterventoProposto) > 0){
                $TipoInterventoProposto= implode(";",$i->TipoInterventoProposto);}
        
            if(count ($i->TipologiainterventoDPR3802001) > 0){
                $TipologiainterventoDPR3802001= implode(";",$i->TipologiainterventoDPR3802001);}
            
            if(count ($i->numeroPertinnzeAccatastateCD) > 0){
                $numeroPertinnzeAccatastateCD= implode(";",$i->numeroPertinnzeAccatastateCD);}
            
            if($i->dateAutorizzativi == ''){
                $i->dateAutorizzativi='1900-01-01';
            }
            if($i->quotaPreventivo != ''){
                $quotaPreventivo=$i->quotaPreventivo ;
            }
        
         //$form=$i->prova;
        
         $idProgetto=$i->idprogetto;
        try {
           DB::table('progetti')->where('id',$i->idprogetto)->update([
                'titolo_progetto' =>$i->titoloProgetto,
                'tipologia_edificio'=>$i->tipologiaEdificio,
               
                'zona_climatica'=> $zonaClimatica,
                'gradi_giorno'=>$i->gradigiornoText,
                'areavincolata'=>$i->areavincolata42,
                'tipo_vincolo'=>$i->tipoVincolo42,
                'zonasismisca'=>$i->zonasismisca4,
              'interventi_antisismici'=>$i->zonasismisca4Interventiantisismici,
                  'interventi_sismici_altri_vincoli'=>$i->zonasismisca4InterventiantisismiciAltriVincoli,
                'TipoInterventoProposto'=>$TipoInterventoProposto,
                'TipologiainterventoDPR3802001'=>$TipologiainterventoDPR3802001,
                'tipologiaTitoloAutorizzativi'=>$i->tipologiaTitoloAutorizzativi,
                'riferimentiAutorizzativi'=>$i->riferimentiAutorizzativi,
                'dateAutorizzativi'=>$i->dateAutorizzativi,
                'AllegatoTitoloAutorizzativo'=>$i->AllegatoTitoloAutorizzativo,
        
                'abusiEdilizi'=>$i->abusiEdilizi ,
                'TipologiaAbusiEdilizi'=>$i->TipologiaAbusiEdilizi ,
                'comuneStatoDiFatto'=>$i->comuneStatoDiFatto,
                'NCEUStatoDiFatto'=>$i->NCEUStatoDiFatto ,
                'difformitaUrbanistiche'=>$i->difformitaUrbanistiche ,
               'noteDifformitaUrbanistiche'=>$i->noteDifformitaUrbanistiche ,
                'difformitaCatastali'=>$i->difformitaCatastali ,
                'noteDifformitaCatastali'=>$i->noteDifformitaCatastali ,
                'irregolaritaSanabili'=>$i->irregolaritaSanabili ,
                'noteIrregolaritaSanabili'=>$i->noteIrregolaritaSanabili ,
                
                'tipologia_struttura_edificiio'=>$datistrutturalichk,
                'altroDatiStrutturali'=>$i->altroDatiStrutturali,
                
               'tipologia_parete'=>$tipologiaParetechk,
                'altroTipologiaParetechk'=>$i->altroTipologiaParetechk,
                
              'tipologia_doppia_parete'=>$tipologia_doppia_parete,
                'spessori_muri_esternicm'=>$i->SpessoreMuriEsterni ,
                'spessori_camera_ariacm'=>$i->SpessoreCameraDaria ,
                'spessore_isolamentocm'=>$i->SpessoreIsolamento ,
               'tipo_isolamento_camera_aria'=>$i->TipologiaIsolamentoIncameraDaria ,
                
                 'cappotto'=>$isolamentoEsistentechk,
                'altroisolamentoEsistente'=>$i->altroisolamentoEsistentechk,
        
                'centraletermicaesistente_tipo_impianto'=>$i->tipologiaImpiantoEsistente ,
                'centraletermicaesistente_tecnologia_impianto'=>$i->cetraleTermicaCentralizzatoTecnologiaImpiantoEsistente ,
                'cetraleTermicaCentralizzatoTecnologiaImpiantoEsistenteAltro'=>$i->cetraleTermicaCentralizzatoTecnologiaImpiantoEsistenteAltro ,      
                
                'centraletermicaesistente_numero_unita_generazione'=>$i->cetraleTermicaCentralizzatoNumeroUnita	 ,
                'centraletermicaesistente_anno_installazione'=>$i->cetraleTermicaCentralizzatoAnnoInstallazione ,
                'centraletermicaesistente_potenza_termica'=>$i->cetraleTermicaCentralizzatoPotenzaTermicaImpiantoEsistente ,
                'centraletermicaesistente_tipologia_distribuzione'=>$i->cetraleTermicaCentralizzatoTipologiaDistribuzioneEsiste ,
                'centraletermicaesistente_tipologia_termoregolazione'=>$i->cetraleTermicaCentralizzatoTipologiaTermoregolazioneEsistente ,
                'centraletermicaesistente_libretto_impianto_aggiornato'=>$i->cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornato ,
                //cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornatoAllegato TODO tabella allegati
                'centraletermicaesistente_provefumi'=>$i->cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornate ,
                //cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornateAllegato TODO tabella allegata
                'centraletermicaesistente_cpi'=>$i->cetraleTermicaCentralizzatoCertificatoCPI ,
                //cetraleTermicaCentralizzatoCertificatoCPIAllegato TODO TABELLA ALLEGATO
                'centraletermicaprogetto_tecnologia_esistente'=>$i->cetraleTermicaCentralizzatoTecnologiaImpiantoProposto,
                'centraletermicaprogetto_tecnologia_esistente_altro'=>$i->cetraleTermicaCentralizzatoTecnologiaImpiantoPropostonteAltro,
                
                
                'centraletermicaprogetto_numero_unita'=>$i->cetraleTermicaCentralizzatoNumeroUnitaProposte ,
                'centraletermicaprogetto_potenza_termica'=>$i->cetraleTermicaCentralizzatoPotenzaTermicaImpiantoProposto ,
                'centraletermicaprogetto_vettore_energetico'=>$i->centraleTermivaCentralizzatoVettoreImpianto ,
                'quota_preventivo'=>$quotaPreventivo ,
                
        
                //quoteAllegatoPreventivo TOFO tabella allegato
               
                
            ]);
            if ($i->AllegatoTitoloAutorizzativo != ''){
                //$nomefile = $this->generaNomeFile($i->AllegatoTitoloAutorizzativo);
                $nomefile =$i->AllegatoTitoloAutorizzativo;
              
                $file =base64_decode($i->Base64AllegatoTitoloAutorizzativo);
                mkdir($path."/".$idProgetto);
                file_put_contents($path."/".$idProgetto."/".$nomefile, $file);
            }
            if ($i->quoteAllegatoPreventivo != ''){
                $nomefile = $this->generaNomeFile($i->quoteAllegatoPreventivo);
                
                DB::table('allegati_progetto')->insertGetId([
                     'id_progetto' =>$idProgetto,
                     'id_legame' =>0,
                     'nome_file' =>$nomefile,
                     'note_allegato' =>'',
                     'tipo_allegato' =>$tipoAllegati::$preventivoFirmato,
                 ]);
                $file =base64_decode($i->base64AllegatoPreventivo);
                if (!file_exists($path."/".$idProgetto)){
                    mkdir($path."/".$idProgetto);}
                
                file_put_contents($path."/".$idProgetto."/". $nomefile, $file);
            }
            if ($idProgetto > 0){
                $this->cancellaElementiDaAggiornare("clienti_progetto",$idProgetto);
                if (count($i->clienti) > 0){
                    
                    foreach ($i->clienti as $value) {
                       DB::table('clienti_progetto')->insertGetId([
                            'id_progetto' =>$idProgetto,
                            'id_cliente'=>$value['id'],
                        ]);
                    }
                }
                $this->cancellaElementiDaAggiornare("collaboratori_interni_progetto",$idProgetto);
                if (count($i->collaboratoriInterni) > 0){
                    foreach ($i->collaboratoriInterni as $value) {
                        DB::table('collaboratori_interni_progetto')->insertGetId([
                            'id_progetto' =>$idProgetto,
                            'id_collaboratore_interno'=>$value['id'],
                        ]);
                    }
                }
                $this->cancellaElementiDaAggiornare("collaboratori_esterni_progetto",$idProgetto);
                if (count($i->collaboratoriEsterni) > 0){
                    foreach ($i->collaboratoriEsterni as $value) {
                       DB::table('collaboratori_esterni_progetto')->insertGetId([
                            'id_progetto' =>$idProgetto,
                            'id_collaboratore_esterno' =>$value['id'],
                        ]);
                    }
                }
            }
            
            $tipoEdificio= new tipologiaEdificio();
            
            if ($i->tipologiaEdificio == $tipoEdificio->condominio )
            {
        
                $annoCostruzioneCD=$i->annoCostruzioneCD;
                if($i->annoCostruzioneCD == ''){
                    $annoCostruzioneCD=-1;
                }
                $pianoImmobileCD=$i->pianoImmobileCD;
                if($i->pianoImmobileCD == ''){
                    $pianoImmobileCD=-1;
                }
                $numeroUnitaAccatastateCD=$i->numeroUnitaAccatastateCD;
                if($i->numeroUnitaAccatastateCD == ''){
                    $numeroUnitaAccatastateCD=-1;
                }
                $numeroUnitaScaldateCD=$i->numeroUnitaScaldateCD;
                if($i->numeroUnitaScaldateCD == ''){
                    $numeroUnitaScaldateCD=-1;
                }
        
                DB::table('tipologia_edificio_progetto')->where('id_progetto',$idProgetto)->update([
                    'id_progetto'=>$idProgetto,
                    'tipo_edificio'=>$i->tipologiaEdificio,
                    'cd_unico_proprietario'=>$i->condominioUnicoProprietarioCD,
                    'cd_ires'=>$i->IRESCD,
                    'cd_condomini_altri_unita'=>$i->mutliProprietaCD,
                    'cd_a1a8a9'=>$i->condominioA1A8A9CD,
                    'cd_usufruito110'=>$i->usufruito110CD,
                    'cd_nome_condominio'=>$i->nomeCondominioCD,
                    'cd_indirizzo'=>$i->indirizzoCD,
                    'cd_citta'=>$i->cittaCD,
                    'cd_provincia'=>$i->provinciaCD,
                    'cd_annocostruzione'=>$annoCostruzioneCD,
                    'cd_piano_immobile'=>$pianoImmobileCD,
                    'cd_numero_ui_accatastate'=>$numeroUnitaAccatastateCD,
                    'cd_numero_ui_riscaldate'=>$numeroUnitaScaldateCD,
                    'cd_numero_pertinnze_accatastate'=>$numeroPertinnzeAccatastateCD,
                    'cd_condominio_costituito'=>$i->condominioFormalmenteCostituitoCD,
                    'cd_codicefiscale_condominio'=>$i->cd_codicefiscale_condominio,
                    'cd_info_condominiocostituito'=>$i->cd_info_condominiocostituito,
                   
        
                ]);
            }else{
                $annoCostruzioneEF=$i->annoCostruzioneEF;
                if($i->annoCostruzioneEF == ''){
                    $annoCostruzioneEF=-1;
                }
        
               $idTipoEdificioProgetto= DB::table('tipologia_edificio_progetto')->where('id_progetto',$idProgetto)->update([
                    'id_progetto'=>$idProgetto,
                    'tipo_edificio'=>$i->tipologiaEdificio,
                    'ef_altroTipoEdificioFamiliare'=>$i->altroTipoEdificioFamiliare,
                    'ef_tipo_edificio'=>$i->tipoEdificioEF,
                    'ef_indirizzo'=>$i->indirizzoEF,
                    'ef_citta'=>$i->cittaEF,
                    'ef_provincia'=>$i->provinciaEF,
                    'ef_annocostruzione'=>$annoCostruzioneEF,
                    'ef_pianoImmobili'=>$i->pianoImmobileEF,
                    'ef_indipendente'=>$i->indipendenteEF,
                    'ef_accesso_autonomo'=>$i->accessoAutonomiEF,
                    'ef_usufruito_110'=>$i->usufruito110EF,
                    'ef_riqualificazioni_balconi'=>$i->riqualificazioneBalconiEF,
        
                ]);
                if ($idProgetto>0){
                    if (count($i->propietariImmobiliEF) > 0){
                        $this->cancellaElementiDaAggiornare('proprietari_immobilief_progetto',$idProgetto);
                        foreach ($i->propietariImmobiliEF as $value) {
                           DB::table('proprietari_immobilief_progetto')->Insert([
                                'id_progetto' =>$idProgetto,
                                'id_tipoedificio'=>$idTipoEdificioProgetto,
                                'nome'=>$value['nome'],
                                'cognome'=>$value['cognome'],
                                'codicefiscale'=>$value['codiceFiscale'],
                                'telefono'=>$value['telefono'],
                            ]);
                        }
                    }
                    }

                }


                    $this->cancellaElementiDaAggiornare('progettisti_progetto',$idProgetto);
                    if (count($i->progettisti) > 0){
                        
                        foreach ($i->progettisti as $value) {
                           DB::table('progettisti_progetto')->insertGetId([
                                'id_progetto' =>$idProgetto,
                                'id_progettista' =>$value['id'],
                            ]);
                        }
                    }
                    

                   
                    if (count($i->successiviInterventiStraordinaria) > 0){
                        foreach ($i->successiviInterventiStraordinaria as $value) {
                            if ($value['new']==1 && $value['cancellare'] == '0'){

                            $auxAllegato=$value['allegato'];
                            $idIntervento=DB::table('interventi_manutenzione_straordinaria_progetto')->insertGetId([
                                'id_progetto' =>$idProgetto,
                                'anno_intervento' =>$value['anno'],
                            ]);
                            $nomefile = $this->generaNomeFile($value['allegato']);
                          
                           DB::table('allegati_progetto')->insertGetId([
                                'id_progetto' =>$idProgetto,
                                'id_legame' =>$idIntervento,
                                'tipo_allegato' =>1,
                                'nome_file'=> $nomefile,
                                'note_allegato'=>'',
                            ]);
                            if($value['allegatoBase64'] != '0'){
                            $file =base64_decode($value['allegatoBase64']);
                            if (!file_exists($path."/".$idProgetto)){
                                mkdir($path."/".$idProgetto);}
                           
                            file_put_contents($path."/".$idProgetto."/". $nomefile, $file);
                            }
                        }
                        if ($value['new']=='0' && $value['cancellare'] == '1'){
                            $id= $value['id'];
                            $idLegame= $value['id_legame'];
                            $this->cancellaElementiDaAggiornareConID('interventi_manutenzione_straordinaria_progetto',$id);
                            $this->cancellaElementiDaAggiornareConID('allegati_progetto',$id,$idLegame);

                        }
                        }
                    }
                   
                    if (count($i->TitoliAutorizzatiInterventiSuccessivi) > 0){
                        foreach ($i->TitoliAutorizzatiInterventiSuccessivi as $value) {
                            if($value['new'] == '1' && $value['cancellare'] == '0'){
                          
                           $idIntervento=DB::table('titoli_autorizzati_interventi_successivi')->insertGetId([
                                'id_progetto' =>$idProgetto,
                                'sub' =>$value['sub'],
                                'descrizione' =>$value['descrizione'],
                            ]);
                            $nomefile = $this->generaNomeFile($value['nomeAllegato']);
                          
                         
                           DB::table('allegati_progetto')->insertGetId([
                                'id_progetto' =>$idProgetto,
                                'id_legame' =>$idIntervento,
                                'tipo_allegato' =>2,
                                'nome_file'=>$nomefile,
                                'note_allegato'=>'',
                            ]);
                            if($value['allegatoBase64'] != '0'){
                            $file =base64_decode($value['allegatoBase64']);
                            if (!file_exists($path."/".$idProgetto)){
                                mkdir($path."/".$idProgetto);}
                            file_put_contents($path."/".$idProgetto."/".$nomefile, $file);
                            }
                        }
                        if ($value['new'] == 0 && $value['cancellare'] == '1'){
                            $id= $value['id'];
                            
                            $this->cancellaElementiDaAggiornareConID('interventi_manutenzione_straordinaria_progetto',$id);
                            $this->cancellaElementiDaAggiornareConID('allegati_progetto',$id,$id);
                        }
                        }
                    }

                    $this->cancellaElementiDaAggiornare('dati_catastali',$idProgetto);
                    if (count($i->datiCatastali) > 0){
                        foreach ($i->datiCatastali as $value) {
                          
                           $idIntervento=DB::table('dati_catastali')->insertGetId([
                                'id_progetto' =>$idProgetto,
                                'sub' =>$value['sub'],
                                'foglio' =>$value['foglio'],
                                'particella' =>$value['particella'],
                            ]);
                          
                     
                        }
                    }
                    $this->cancellaElementiDaAggiornare('quote_progetto',$idProgetto);
                    if (count($i->elencoAcconti) > 0){
                        foreach ($i->elencoAcconti as $value) {
                           DB::table('quote_progetto')->insertGetId([
                                'id_progetto' =>$idProgetto,
                                'data' =>$value['dataPagamento'],
                                'importo'=>$value['importo'],
                                'modalita_pagamento'=>$value['metodoPagamento'],
                                'chi_ha_fatturata'=>$value['chiFatturato'],
                                'chi_ha_pagato'=>'',
                                'causale'=>'',
                                'tipo_quota'=>$value['tipo_quota'],
            
                            ]);
                        }
                    }
                   // $this->cancellaElementiDaAggiornare('dati_catastali',$idProgetto);
                    if (count($i->elencoSpese) > 0){
                        foreach ($i->elencoSpese as $value) {
                           DB::table('quote_progetto')->insertGetId([
                                'id_progetto' =>$idProgetto,
                                'data' =>$value['dataPagamento'],
                                'importo'=>$value['importo'],
                                'modalita_pagamento'=>'',
                                'chi_ha_fatturata'=>'',
                                'causale'=>$value['causale'],
                                'chi_ha_pagato'=>$value['chiHapagato'],
                                'tipo_quota'=>$value['tipo_quota'],
            
                            ]);
                        }
                    }
                    if (count($i->elencoFile) > 0){
                        foreach ($i->elencoFile as $value) {
                            if($value['new']=='1' && $value['cancellare'] == '0'){
                                $nomefile=explode(".",$value['nomeFile']);
                                $nomefile= $nomefile[0].'_'.date("YmdHis").".".$nomefile[1];
                                
                                DB::table('allegati_progetto')->insertGetId([
                                'id_progetto' =>$idProgetto,
                                'id_legame' =>0,
                                'nome_file' =>$nomefile,
                                'note_allegato' =>$value['noteFile'],
                                'tipo_allegato' =>$value['tipoAllegato'],
                            ]);
                            $file =base64_decode($value['fileBase64']);
                            if (!file_exists($path."/".$idProgetto)){
                            mkdir($path."/".$idProgetto);}
                            file_put_contents($path."/".$idProgetto."/".$nomefile, $file);
                        }
                        if($value['new']==0 && $value['cancellare']==1){
                            $id=$value['id'];
                            $this->cancellaElementiDaAggiornareConID('allegati_progetto',$id);
                           
                            $this->cancellaFile($path."/".$idProgetto."/".$value['nomeFile']);
                        }

                        }
                    }
                    $this->cancellaElementiDaAggiornare('centrale_termica_autonoma',$idProgetto);
                    if (count($i->centraleTermicaDiFAtto) > 0){
                        foreach ($i->centraleTermicaDiFAtto as $value) {
                              
                           $idIntervento=DB::table('centrale_termica_autonoma')->insertGetId([
                                'id_progetto' =>$idProgetto,
                                'sub' =>$value['sub'],
                                'tecnologia_impianto' =>$value['tecnologiaImpianto'],
                                'numero_unita' =>$value['numeronUnitaGenerazione'],
                                'tipo_termoregolazione' =>$value['tipologiaSistemaTermoregolazione'],
                                'potenza_kw' =>$value['potenzaTermicaUtile'],
                                'anno_installazione' =>$value['annoInstallazione'],
                                'oggetto_di_sostituzione' =>$value['GeneratoreOggettoDiSostituzione'],
                                'difatto_diprogetto' =>'difatto',
                            ]);
                          
                     
                        }
                    }
                  
                    if (count($i->centraleTermicaDiProgetto) > 0){
                        foreach ($i->centraleTermicaDiProgetto as $value) {
                              
                           $idIntervento=DB::table('centrale_termica_autonoma')->insertGetId([
                                'id_progetto' =>$idProgetto,
                                'sub' =>$value['sub'],
                                'tecnologia_impianto' =>$value['tecnologiaImpianto'],
                                'numero_unita' =>$value['numeronUnitaGenerazione'],
                                'tipo_termoregolazione' =>$value['tipologiaSistemaTermoregolazione'],
                                'potenza_kw' =>$value['potenzaTermicaUtile'],
                                'anno_installazione' =>$value['annoInstallazione'],
                                'oggetto_di_sostituzione' =>$value['GeneratoreOggettoDiSostituzione'],
                                'difatto_diprogetto' =>'diprogetto',
                            ]);
                          
                     
                        }
                    }
     
                   $stringRitorno=["response"=>"ok","message"=> $i->titoloProgetto];
       
        } catch (\Throwable $th) {
            $stringRitorno=["response"=>"Error","message"=>$th->getMessage()];
        }
        
        return response()->json($stringRitorno);
    }


        public function cancellaElementiDaAggiornare(string $tabella, int $idProgetto,int $idIntervento = 0){

            if ($idIntervento == 0){
            DB::table($tabella)->where('id_progetto',$idProgetto)->delete();
        }
            
            if ($idIntervento != 0){
            DB::table($tabella)->where('id_progetto',$idProgetto)->where('id_legame',$idIntervento)->delete();
        }
            
        }
        public function cancellaElementiDaAggiornareConID(string $tabella, int $id,int $idLegame = 0){

            if ($idLegame == 0){
            DB::table($tabella)->where('id',$id)->delete();
        }
            
            if ($idLegame != 0){
            DB::table($tabella)->where('id_legame',$idLegame)->delete();
        }
            
        }
        public function cancellaFile(string $path){

            unlink($path);
        }

        public function  generaNomeFile($nomeFile){
            $nomefile=str_replace(" ","",$nomeFile);
            $nomefile=explode(".",$nomeFile);
            $nomefile= $nomefile[0].'_'.date("YmdHis").".".$nomefile[1];
            return $nomefile;
        }


        public function SetAutorizzaUtenti(Request $i){
            try {
                $idprogetto=$i->idprogetto;
              
                foreach ($i->listaDaAutorizzare as $daAutorizzare) {
                    DB::table('user-associato-progetto')->insert([
                        'id_user' =>$daAutorizzare['id'],
                        'id_progetto' => $idprogetto
                    ]);
                }
                $stringRitorno=["response"=>"ok","message"=>"Utenti Autorizzati"];
            } catch (\Throwable $th) {
                $stringRitorno=["response"=>"Error","message"=>$th->getMessage()];
    
            }
         
            return $stringRitorno;
        }
    }

 
    
    
    class tipologiaEdificio{
        public $condominio = "condominio";
        public $edificiioResidenziale = "edificioFamiliare";
        public $commerciale = "commerciale";
        public $altro = "altro";
    
    }