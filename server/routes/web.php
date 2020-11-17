<?php

/** @var \Laravel\Lumen\Routing\Router $router */
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

$router->get('/', function () use ($router) {
    return $router->app->version();
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


$router->get('/getAnagrafica/{idutente}',function (Request $request,$idutente){
$dettagliutente=DB::table('anagrafica')->select('*')->where('id',$idutente)->get();
   return  response()
            ->json($dettagliutente);
});
$router->get('/getCercaAnagrafica/{tipo}/{varie}',function (Request $request,$itpo,$varie){
$dettagliutente=DB::table('anagrafica')->select('*')->where('tipo_anagrafica',$tipo)->orWhere('nome','like',$varie)->orwhere('cognome','like',$varie)->get();
   return  response()
            ->json($dettagliutente);
});


class foo{
    public $valore = "ciao";

}

/**********APPUNTI*********/
//$out->writeln( $request->json()->get('title'));
// $request->json()->get('article')
// $output= $request->input('article');
// $output=json_decode($request->json()->get('sendanagrafica'), true);
// $output=$request->json()->get('title');
//$out = new \Symfony\Component\Console\Output\ConsoleOutput();
//$out->writeln($request->nuovaAnagraficaDenominazione);