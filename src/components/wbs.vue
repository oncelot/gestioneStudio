<template>
    <div>
        <div class="row q-col-gutter-md">
            <div class="col-1">Attività</div>
            <div class="col-1">Descrizione</div>
            <div class="col-1">Assegnato A</div>
            <div class="col-1">STATO</div>
            <div class="col-1">PRIORITà</div>
            <div class="col-1">SCADENZA</div>
            <div class="col-1">COMPLETAMENTO</div>
            <div class="col-1">INIZIO</div>
            <div class="col-1">FINE</div>
            <div class="col-1">DURATA</div>
        </div>
        <div class="row q-col-gutter-md">
            <div class="col-1">Acquisizione DOC</div>
            <div class="col-1">Descrizione</div>
            <div class="col-1">Nome Cognome Assegnato</div>
            <div class="col-1"><q-select 
                v-model="stato"
                type="checkbox"
                color="secondary"
                filled :dense='true' label="Seleziona..."
                :options="optionstatoWbs"
            /></div>
            <div class="col-1"><q-select 
                v-model="priorita"
                type="checkbox"
                color="secondary"
                filled 
                :dense='true' label="seleziona..."
                :options="optionPriorita"
            /></div>
            <div class="col-1">
               <q-input v-model="text" type="text" label="Scadenza" /></div>
            <div class="col-1"> <q-input v-model="text" type="text" label="Completamento" /></div>
            <div class="col-1"> <q-linear-progress :value="progress" class="q-mt-md" /></div>
            <div class="col-1"> <q-input v-model="text" type="text" label="Inizio" /></div>
            <div class="col-1"> <q-input v-model="text" type="text" label="Fine" /></div>
            <div class="col-1"> <q-input v-model="text" type="text" label="Durata" /></div>
        </div>
        <div class="row q-col-gutter-md">
            <div class="col-4">
                 <q-card class="my-card" flat bordered>
      <q-card-section horizontal>
        <q-card-section class="q-pt-xs">
            <div class="text-overline"> <q-linear-progress :value="progress" class="q-mt-md" /></div>
           <div class="text-h5 q-mt-sm q-mb-xs">Acquisizione DOC</div>
         
          <div class="text-caption text-grey">
              <q-input v-model="text" type="textarea" label="Descrizione"  />
              </div>
        </q-card-section>

        <q-card-section class="col-5 flex flex-center">
         <q-input v-model="text" type="text" label="Assegnato A:" :dense='true' outlined />
         <q-select 
                v-model="stato"
                type="checkbox"
                color="secondary"
                outlined :dense='true' label="Stato"
                :options="optionstatoWbs"
                style="width:100%"
            />
            <q-select 
                v-model="priorita"
                type="checkbox"
                color="secondary"
                filled 
                :dense='true' label="Priorita"
                :options="optionPriorita"
                style="width:100%"
            />
             <div >
      <label>Scadenza</label>
     <q-input  outlined :dense="true"  v-model="text" mask="date" :rules="['date']">
      <template v-slot:append>
        <q-icon name="event" class="cursor-pointer">
          <q-popup-proxy ref="qDateProxy" transition-show="scale" transition-hide="scale">
            <q-date v-model="text">
              <div class="row items-center justify-end">
                <q-btn v-close-popup label="Close" color="primary" flat />
              </div>
            </q-date>
          </q-popup-proxy>
        </q-icon>
      </template>
    </q-input>
    </div>
      
        </q-card-section>
        
      </q-card-section>

      <q-separator />

      <q-card-actions>
      
       
      
      </q-card-actions>
      <q-card-actions>
     <q-input v-model="text" type="text" outlined :dense="true" label="Inizio" />
      <q-input v-model="text" type="text" outlined :dense="true"  label="fine" />
       <q-input v-model="text" type="text" outlined :dense="true"  label="Durata" />
      </q-card-actions>
    </q-card>
        </div>
            <div class="col-4">
                 <q-card class="my-card" flat bordered>
      <q-card-section horizontal>
        <q-card-section class="q-pt-xs">
            <div class="text-overline"> <q-linear-progress :value="progress" class="q-mt-md" /></div>
           <div class="text-h5 q-mt-sm q-mb-xs">SOPRALLUOGHI</div>
         
          <div class="text-caption text-grey">
              <q-input v-model="text" type="textarea" label="Descrizione"  />
              </div>
        </q-card-section>

        <q-card-section class="col-5 flex flex-center">
         <q-input v-model="text" type="text" label="Assegnato A:" :dense='true' outlined />
         <q-select 
                v-model="stato"
                type="checkbox"
                color="secondary"
                outlined :dense='true' label="Stato"
                :options="optionstatoWbs"
                style="width:100%"
            />
            <q-select 
                v-model="priorita"
                type="checkbox"
                color="secondary"
                filled 
                :dense='true' label="Priorita"
                :options="optionPriorita"
                style="width:100%"
            />
        </q-card-section>
        
      </q-card-section>

      <q-separator />

      <q-card-actions>
        <q-btn flat round icon="event" />
       <q-input v-model="text" type="text" label="Scadenza" />
      
      </q-card-actions>
      <q-card-actions>
     <q-input v-model="text" type="text" outlined :dense="true" label="Inizio" />
      <q-input v-model="text" type="text" outlined :dense="true"  label="fine" />
       <q-input v-model="text" type="text" outlined :dense="true"  label="Durata" />
      </q-card-actions>
    </q-card>
        </div>
        </div>
        
        </div>
</template>
<script>
export default {
    data(){return{

        optionstatoWbs:[ 
            {label: 'Non Iniziato',value: 'non iniziato'},
            {label: 'in corso',value: 'in corso'},
            {label: 'completato',value: 'completato'},
            {label: 'scaduto',value: 'scaduto'},
            {label: 'in attesa',value: 'in attesa'},],
        optionPriorita:[{label:'Alto',value:'alto'},{label:'Medio',value:'medio'},{label:'Basso',value:'basso'}],
        priorita:'',
        stato:'',
        progress:0.5,
        date:'',
        text:''
    }}
}
</script>