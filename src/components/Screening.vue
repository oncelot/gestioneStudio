<template>
<div style="color:grey" >
    {{TipoEdificioForScreening}}
    <div  :if="TipoEdificioForScreening == 'edificioFamiliare'">
        <div class="row">
<div class="col"></div>

        </div>
    </div>

    <div  :if="TipoEdificioForScreening == 'domicilio'">
       <div class="row" style="padding-top:20px">
          <div class="col">
            <b>L’unità immobiliare è funzionalmente indipendente? <q-icon name="info" > <q-tooltip anchor="top middle" self="bottom middle">
               Barrare una delle caselle
N.B. L’U.I. è funzionalmente indipendente se è dotata di installazioni o manufatti <br>
di qualunque genere, quali impianti per l’acqua, per il gas, per l’energia elettrica, <br>
per il riscaldamento di proprietà esclusiva.
                </q-tooltip></q-icon> </b>
            <div class="q-gutter-sm">
         
         
          </div>
          </div>
        </div>
    </div>
  </div>
  


</template>
<script>
export default { 
    props: ['TipoEdificioForScreening']
    
}
</script>
