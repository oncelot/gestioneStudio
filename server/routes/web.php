<?php

/** @var \Laravel\Lumen\Routing\Router $router */
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Classes\CommandCode;



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->put('/update',function(Request $request){
    if(count ($request->ruolo) > 0){
        $ruoliUtente=implode(";",$request->ruolo);}

$utente = DB::table('users')->where('id',$request->id)->update(
    ['name'=>$request->nome,
    'email'=>$request->email,
    'role'=>$ruoliUtente]
);
return response()->json(['message'=>'Utente Modificato con successo']);
});

$router->post('register',function(Request $request){

$user = new User;
$user->name=$request->nome;
$user->email=$request->email;
$user->password=Hash::make($request->password);
$user->role='guest';
$user->save();

return response()->json(['message'=>'Utente creato con successo']);

});

$router->post('login',function(Request $request){

$credenziali = $request->only(['email','password']);

if($token = auth()->attempt($credenziali)){
    $user=auth()->user();
    $response=[
        'user'=>[
            'id'=>$user->id,
            'email'=>$user->email,
            'role'=>$user->role,

        ], 
        'token'=>[
            'type'=>'Bearer',
            'value'=>$token,
            'expires_at'=>auth()->guard()->factory()->getTTl(),
            ]
        ];
        return response()->json(['user'=>$response,'error'=>false])->header('Authorization',$token);
        }
        return response()->json(['error'=>true, 'message'=>'Email o password errati']);
});
$router->get('logout', function(){
    auth()->logout();

    return response()->json(['error'=>false,'message' => 'Successfully logged out']);

});

$router->get('/user','AccountController@index');
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/lista-users',function(){
$users=DB::table('users')->get();
return response()->json($users);

});
$router->post('/lista-users/{id}',function($id){
$users=DB::table('users')->where('id',$id)->select('name','email','role','id')->get();
return response()->json($users);

});

$router->get('/download',function(Request $request){

  //  $out = new \Symfony\Component\Console\Output\ConsoleOutput();
//$out->writeln($request->pp);
    //$path="C:\\Users\\Fausto\\source\\repos\\oncelot\\gestionestudio\\server\\public\\";
   
    $path =  app()->basePath('public/');
    try {
        $response=response()->download($path.$request->pp);
    ob_end_clean();
    return  $response;
    } catch (\Throwable $th) {
       $response="";
       return  $response;
    }
   
   
});
$router->post('/aggiorna-progetto','ProgettoController@aggiornaProgetto');
$router->post('/SetAutorizzaUtenti','ProgettoController@SetAutorizzaUtenti');




            
$router->post('/aggiungi-progetto',function(Request $i){
    $tipoAllegati= new CommandCode();
    $path="C:\Users\Fausto\source\\repos\oncelot\gestionestudio\server\public";
   $out = new \Symfony\Component\Console\Output\ConsoleOutput();
    $out->writeln($i);
    $zonaClimatica="";
    $datistrutturalichk="";
    $tipologiaParetechk="";
    $tipologia_doppia_parete="";
    $isolamentoEsistentechk="";
    $TipoInterventoProposto="";
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


try {
    $idProgetto=DB::table('progetti')->insertGetId([
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

        $file =base64_decode($i->Base64AllegatoTitoloAutorizzativo);
        mkdir($path."/".$idProgetto);
        file_put_contents($path."/".$idProgetto."/". $i->AllegatoTitoloAutorizzativo, $file);
    }
    if ($idProgetto>0){
       
    if ($i->quoteAllegatoPreventivo != ''){

          $nomefile=$i->quoteAllegatoPreventivo.date("YmdHis");
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
         file_put_contents($path."/".$idProgetto."/".$nomefile, $file);
        }

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
    }


    $tipoEdificio= new tipologiaEdificio();
    
    if ($i->tipologiaEdificio == $tipoEdificio->condominio ){

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
            'cd_unico_proprietario'=>$annoCostruzioneCD,
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
            'ef_indirizzo'=>$i->indirizzoEF,
            'ef_citta'=>$i->cittaEF,
            'ef_provincia'=>$i->provinciaEF,
            'ef_annocostruzione'=>$annoCostruzioneEF,
            'ef_indipendente'=>$i->indipendenteEF,
            'ef_accesso_autonomo'=>$i->accessoAutonomiEF,
            'ef_usufruito_110'=>$i->usufruito110EF,
            'ef_riqualificazioni_balconi'=>$i->riqualificazioneBalconiEF,

        ]);
        if ($idProgetto>0){
            if (count($i->propietariImmobiliEF) > 0){
                foreach ($i->propietariImmobiliEF as $value) {
                   DB::table('proprietari_immobilief_progetto')->insertGetId([
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
       
        if ($idProgetto>0){
            if (count($i->clienti) > 0){
                foreach ($i->clienti as $value) {
                   DB::table('clienti_progetto')->insertGetId([
                        'id_progetto' =>$idProgetto,
                        'id_cliente'=>$value['id'],
                    ]);
                }
            }
            if (count($i->collaboratoriInterni) > 0){
                foreach ($i->collaboratoriInterni as $value) {
                    DB::table('collaboratori_interni_progetto')->insertGetId([
                        'id_progetto' =>$idProgetto,
                        'id_collaboratore_interno'=>$value['id'],
                    ]);
                }
            }
            if (count($i->collaboratoriEsterni) > 0){
                foreach ($i->collaboratoriEsterni as $value) {
                   DB::table('collaboratori_esterni_progetto')->insertGetId([
                        'id_progetto' =>$idProgetto,
                        'id_collaboratore_esterno' =>$value['id'],
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
         //Allegati
            if (count($i->elencoFile) > 0){
                foreach ($i->elencoFile as $value) {
                    $nomefile=$value['nomeFile'].date("YmdHis");
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
         


            if (count($i->successiviInterventiStraordinaria) > 0){
                foreach ($i->successiviInterventiStraordinaria as $value) {
                    $auxAllegato=$value['allegato'];
                   $idIntervento=DB::table('interventi_manutenzione_straordinaria_progetto')->insertGetId([
                        'id_progetto' =>$idProgetto,
                        'anno_intervento' =>$value['anno'],
                    ]);
                  
                    $nomefile= $value['allegato'].date("YmdHis");
                   DB::table('allegati_progetto')->insertGetId([
                        'id_progetto' =>$idProgetto,
                        'id_legame' =>$idIntervento,
                        'tipo_allegato' =>1,
                        'nome_file'=> $nomefile,
                    ]);
                    $file =base64_decode($value['allegatoBase64']);
                    mkdir($path."/".$idProgetto);
                    file_put_contents($path."/".$idProgetto."/". $nomefile, $file);
                }
            }
        
            if (count($i->TitoliAutorizzatiInterventiSuccessivi) > 0){
                foreach ($i->TitoliAutorizzatiInterventiSuccessivi as $value) {
                  
                   $idIntervento=DB::table('titoli_autorizzati_interventi_successivi')->insertGetId([
                        'id_progetto' =>$idProgetto,
                        'sub' =>$value['sub'],
                        'descrizione' =>$value['descrizione'],
                    ]);
                  
                    $nomefile= $value['nomeAllegato'].date("YmdHis");
                   DB::table('allegati_progetto')->insertGetId([
                        'id_progetto' =>$idProgetto,
                        'id_legame' =>$idIntervento,
                        'tipo_allegato' =>2,
                        'nome_file'=>$nomefile,
                    ]);
                    $file =base64_decode($value['allegatoBase64']);
                    mkdir($path."/".$idProgetto);
                    file_put_contents($path."/".$idProgetto."/".$nomefile, $file);
                }
            }
        
        
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

            /*Informazione sul tipo di edificio*/

        
        }
           $stringRitorno=["response"=>"ok","message"=> $i->titoloProgetto];

} catch (\Throwable $th) {
    $stringRitorno=["response"=>"Error","message"=>$th->getMessage()];
}

return response()->json($stringRitorno);
});

$router->post('/aggiungi-anagrafica',function (Request $request){
  
try{
    $idAnagrafica=DB::table('anagrafica')->insertGetId(
        [
            'tipo_anagrafica' => $request->nuovaAnagraficaTipo,
            'tipologia' => $request->tipologia['value'],
            'denominazione'=>$request->nuovaAnagraficaDenominazione,
            'nome'=>$request->nuovaAnagraficaNome,
            'cognome'=>$request->nuovaAnagraficaCognome ,
            'partita_iva'=> $request->nuovaAnagraficaPartitaIva,
            'codice_fiscale'=>$request->nuovaAnagraficaCodiceFiscale ,
            'telefono'=> $request->nuovaAnagraficaTelefono,
            'email'=>$request->nuovaAnagraficaEmail ,
            'pec'=>$request->nuovaAnagraficaEmailPec,
            'paese'=> $request->nuovaAnagraficaPaese,
            'citta'=>$request->nuovaAnagraficaCitta ,
            'provincia'=>$request->nuovaAnagraficaProvincia ,
            'indirizzo'=> $request->nuovaAnagraficaIndirizzo,
            'cap'=> $request->nuovaAnagraficaCap,
            'note'=> $request->nuovaAnagraficaNote
            ]
    );
    $stringRitorno=["response"=>"ok","message"=>"Utente Salvato"];
   }
   catch(\Exception $e){
       $stringRitorno=["response"=>"Error","message"=>$e->getMessage()];
       //throw new Exception("Error Processing Request", 1);
    }
    return response()->json($stringRitorno);

  

});

$router->post('/modifica-anagrafica/{idutente}',function (Request $request, $idutente){
  
try{
   $output= DB::table('anagrafica')->where('id',$idutente)->update(
        [
            'tipo_anagrafica' => $request->nuovaAnagraficaTipo,
            'tipologia' => $request->tipologia,
            'denominazione'=>$request->nuovaAnagraficaDenominazione,
            'nome'=>$request->nuovaAnagraficaNome,
            'cognome'=>$request->nuovaAnagraficaCognome ,
            'partita_iva'=> $request->nuovaAnagraficaPartitaIva,
            'codice_fiscale'=>$request->nuovaAnagraficaCodiceFiscale ,
            'telefono'=> $request->nuovaAnagraficaTelefono,
            'email'=>$request->nuovaAnagraficaEmail ,
            'pec'=>$request->nuovaAnagraficaEmailPec,
            'paese'=> $request->nuovaAnagraficaPaese,
            'citta'=>$request->nuovaAnagraficaCitta ,
            'provincia'=>$request->nuovaAnagraficaProvincia ,
            'indirizzo'=> $request->nuovaAnagraficaIndirizzo,
            'cap'=> $request->nuovaAnagraficaCap,
            'note'=> $request->nuovaAnagraficaNote
            ]
    );
    $stringRitorno=["response"=>"ok","message"=>"Utente modificato"];
   }
   catch(\Exception $e){
       $stringRitorno=["response"=>"Error","message"=>$e->getMessage()];
       //throw new Exception("Error Processing Request", 1);
    }
    return response()->json($stringRitorno);

  // $out = new \Symfony\Component\Console\Output\ConsoleOutput();
  // $out->writeln($stringRitorno);

});


$router->get('/getAnagrafica',function (Request $request){
$elencoanagrafica=DB::table('anagrafica')->select('*')->get();
   return  response()
            ->json($elencoanagrafica);
});
$router->get('/getProgetti',function (Request $request){
    try {
        $elencoprogetti=DB::table('progetti')->select('*')->orderBy('id','desc')->get();
        return  response()
                 ->json($elencoprogetti);
    } catch (\Throwable $th) {
        return response()->json($th);
    }

});


$router->get('/getAnagrafica/{idutente}',function (Request $request,$idutente){
    try {
        $dettagliutente=DB::table('anagrafica')->select('*')->where('id',$idutente)->get();
        return  response()
            ->json($dettagliutente);
    } catch (\Throwable $th) {
       return response()->json($th);
    }

   
});

$router->get('/getCercaAnagrafica/{tipo}/{varie}',function (Request $request,$tipo,$varie){
$dettagliutente=DB::table('anagrafica')->select('nome','cognome','denominazione','codice_fiscale','partita_iva','id')->where('tipo_anagrafica',$tipo)->where('nome','like',"%$varie%")->orwhere('cognome','like',"%$varie%")->get();
   return  response()
            ->json($dettagliutente);
});
$router->get('/getCercaUsersDaAutorizzare/{idprogetto}/{varie}',function (Request $request,$idprogetto,$varie){
$listaNotIn=DB::table('user-associato-progetto')->where('id_progetto',$idprogetto)->select('id_user');

$listaUsers=DB::table('users')->select('name','email','role','id')->whereNotIn('id', $listaNotIn)->where('name','like',"%$varie%")->orwhere('email','like',"%$varie%")->orwhere('role','like',"%$varie%")->get();
   return  response()
            ->json($listaUsers);
});
$router->delete('/cancellaAutorizzazione/{idriga}', function(Request $request,$idriga){
$output='';
    try {
    DB::table('user-associato-progetto')->where('id',$idriga)->delete();
    $output=['response'=>'ok','message'=>'utente cancellato'];

} catch (\Throwable $th) {
    //throw $th;
    $output=['response'=>'errore','message'=>$th->getMessage()];
}
  
    return response()->json($output);
});

$router->get('/getUtentiAutorizzati/{idprogetto}',function(Request $request,$idprogetto){
    $listaUsersAssociatiAlProgetto=DB::table('user-associato-progetto')->join('users','id_user','users.id')->where('id_progetto',$idprogetto)->select('*')->get();
    $progetto=['listaUsersAssociatiAlProgetto'=>$listaUsersAssociatiAlProgetto ];
    return  response()->json($progetto);
});

$router->get('/getProgetto/{idprogetto}',function (Request $request,$idprogetto){
    $dettagliutente=DB::table('progetti')->leftJoin('clienti_progetto','progetti.id','=','clienti_progetto.id_progetto')->where('progetti.id',$idprogetto)->select('*')->get();
    $dettagliProgetto= DB::table('progetti')->where('progetti.id',$idprogetto)->select('*')->get();
    $clientiProgetto=DB::table('clienti_progetto')->join('anagrafica','clienti_progetto.id_cliente','=','anagrafica.id')->where('id_progetto',$idprogetto)->select('nome','cognome','codice_fiscale','anagrafica.id','denominazione','partita_iva')->get();
    $collaboratoriEsterniProgetto=DB::table('collaboratori_esterni_progetto')->join('anagrafica','id_collaboratore_esterno','=','anagrafica.id')->where('id_progetto',$idprogetto)->select('nome','cognome','codice_fiscale','anagrafica.id','denominazione','partita_iva')->get();
    $collaboratoriInterniProgetto=DB::table('collaboratori_interni_progetto')->join('anagrafica','id_collaboratore_interno','=','anagrafica.id')->where('id_progetto',$idprogetto)->select('nome','cognome','codice_fiscale','anagrafica.id','denominazione','partita_iva')->get();
    $progettistiProgetto=DB::table('progettisti_progetto')->join('anagrafica','id_progettista','=','anagrafica.id')->where('id_progetto',$idprogetto)->select('nome','cognome','codice_fiscale','anagrafica.id','denominazione','partita_iva')->get();
    $infoTipologiaEdificioProgetto=DB::table('tipologia_edificio_progetto')->where('id_progetto',$idprogetto)->select('*')->get();
    $infoelencoProprietariImmobile=DB::table('proprietari_immobilief_progetto')->where('id_progetto',$idprogetto)->select('*')->get();
    $interventiSuccessivi=DB::table('interventi_manutenzione_straordinaria_progetto')->join('allegati_progetto','interventi_manutenzione_straordinaria_progetto.id','id_legame')->where('interventi_manutenzione_straordinaria_progetto.id_progetto',$idprogetto)->select('interventi_manutenzione_straordinaria_progetto.id','interventi_manutenzione_straordinaria_progetto.id_progetto','interventi_manutenzione_straordinaria_progetto.anno_intervento','allegati_progetto.tipo_allegato','allegati_progetto.nome_file','allegati_progetto.note_allegato','allegati_progetto.id_legame')->get();
    $titoliAutorizzativiInterventiSuccessici= DB::table('titoli_autorizzati_interventi_successivi')->join('allegati_progetto','titoli_autorizzati_interventi_successivi.id','id_legame')->where('titoli_autorizzati_interventi_successivi.id_progetto',$idprogetto)->get();
    $datiCatastali= DB::table('dati_catastali')->where('id_progetto',$idprogetto)->get();
    $impiantoAutonomoDiFatto=DB::table('centrale_termica_autonoma')->where('id_progetto',$idprogetto)->where('difatto_diprogetto','difatto')->get();
    $impiantoAutonomoDiProgetto=DB::table('centrale_termica_autonoma')->where('id_progetto',$idprogetto)->where('difatto_diprogetto','diprogetto')->get();
    $allegatiProgetto= DB::table('allegati_progetto')->where('id_progetto',$idprogetto)->get();
    $quoteAcconti= DB::table('quote_progetto')->where('id_progetto',$idprogetto)->where('tipo_quota','entrata')->get();
    $quoteSpese= DB::table('quote_progetto')->where('id_progetto',$idprogetto)->where('tipo_quota','uscita')->get();
    $listaUsersAssociatiAlProgetto=DB::table('user-associato-progetto')->join('users','id_user','users.id')->where('id_progetto',$idprogetto)->select('user-associato-progetto.id','name','email','role','id_user')->get();

    $progetto=[
        'progetto'=>$dettagliProgetto,
        'clienti'=>$clientiProgetto,
        'collaboratoriEsterni'=>$collaboratoriEsterniProgetto,
        'collaboratoriInterni'=>$collaboratoriInterniProgetto,
        'progettistiProgetto'=>$progettistiProgetto,
        'infoEdificioProgetto'=>$infoTipologiaEdificioProgetto,
        'infoelencoProprietariImmobile'=>$infoelencoProprietariImmobile,
        'interventiSuccessivi'=>$interventiSuccessivi,
        'titoliAutorizzativiInterventiSuccessici'=>$titoliAutorizzativiInterventiSuccessici,
        'dataCatastali'=>$datiCatastali,
        'impiantoAutonomoDiFatto'=>$impiantoAutonomoDiFatto,
        'impiantoAutonomoDiProgetto'=>$impiantoAutonomoDiProgetto,
        'allegatiProgetto'=>$allegatiProgetto,
        'quoteAcconti'=>$quoteAcconti,
        'quoteSpese'=>$quoteSpese,
        'listaUsersAssociatiAlProgetto'=>$listaUsersAssociatiAlProgetto,
        ];
       return  response()->json($progetto);
    });

class tipologiaEdificio{
    public $condominio = "condominio";
    public $edificiioResidenziale = "edificioFamiliare";
    public $commerciale = "commerciale";
    public $altro = "altro";

}
 class elementiProgetto{
    
    public $titolo_progetto= 'titolo_progetto';
    public $tipologia_edificio;
    public $zona_climatica;
    public $gradi_giorno;
    public $areavincolata;
    public $zonasismisca;
    public $TipoInterventoProposto;
    public $TipologiainterventoDPR3802001;
    public $abusiEdilizi;
    public $TipologiaAbusiEdilizi;
    public $comuneStatoDiFatto;
    public $NCEUStatoDiFatto;
    public $difformitaUrbanistiche;
    public $noteDifformitaUrbanistiche;
    public $difformitaCatastali;
    public $noteDifformitaCatastali;
    public $irregolaritaSanabili;
    public $noteIrregolaritaSanabili;
    public $tipologia_struttura_edificiio;
    public $tipologia_parete;
    public $tipologia_doppia_parete;
    public $spessori_muri_esternicm;
    public $spessori_camera_ariacm;
    public $spessore_isolamentocm;
    public $tipo_isolamento_camera_aria;	
    public $cappotto;	
    public $centraletermicaesistente_tipo_impianto;	
    public $centraletermicaesistente_tecnologia_impianto;	
    public $centraletermicaesistente_numero_unita_generazione;	
    public $centraletermicaesistente_anno_installazione;	
    public $centraletermicaesistente_potenza_termica;	
    public $centraletermicaesistente_tipologia_distribuzione;	
    public $centraletermicaesistente_tipologia_termoregolazione;
    public $centraletermicaesistente_libretto_impianto_aggiornato;
    public $centraletermicaesistente_provefumi;
    public $centraletermicaesistente_cpi;
    public $centraletermicaprogetto_tecnologia_esistente;
    public $centraletermicaprogetto_numero_unita;
    public $centraletermicaprogetto_potenza_termica;
    public $centraletermicaprogetto_vettore_energetico;																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																							


}

/**********APPUNTI*********/
//$out->writeln( $request->json()->get('title'));
// $request->json()->get('article')
// $output= $request->input('article');
// $output=json_decode($request->json()->get('sendanagrafica'), true);
// $output=$request->json()->get('title');
//$out = new \Symfony\Component\Console\Output\ConsoleOutput();
//$out->writeln($request->nuovaAnagraficaDenominazione);