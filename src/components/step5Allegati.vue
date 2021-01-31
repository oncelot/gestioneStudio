<template>
    <div>
        
        <span class="text-h5">Allegati</span>
        
        <div class="row">
            <div class="col-3">
                <label class="text-bold"> Allegato</label><br>
                <input type="file" @change="handleFile"  >
            </div>
            <div class="col-6">  
                <label class="text-bold"> Tipo Allegato</label>
                <q-select v-model="tipoAllegatodiAllegati" :options="tipiDiAllegati" :dense="true" outlined label="Seleziona..."  />
                <q-input v-if="tipoAllegatodiAllegati.value =='altro'" v-model="value.tipoAltroAllegato" type="text" label="Altro tipo allegato" :dense=true />
            </div>
            <div class="col-12"> 
                <label for="" class="text-bold"> Note</label>
                <q-input v-model="noteallegatoDiallegati" outlined :dense="true" type="text"  />  
            </div>
                
            <div class="col-12" style="margin-top:10px;"><q-btn class="white" icon="add" label="Aggiungi" @click="addrowAllegati()" /></div>
        </div>
        <div class="row" style="margin-top:20px"> 
            <div class="col">File</div>
            <div class="col">Note</div>
            <div class="col">Tipo Documento</div>
            <div class="col"></div>
        </div>
        
        <div  v-for="(allegato,index) in value.elencoAllegati" :key="allegato.nomeFile">
            <div class="row" v-if="allegato.cancellare=='0'">
                <div class="col">
                    <span v-if="allegato.idprogetto != '0'"  @click="downloadFile(value.idprogetto+'/'+allegato.nomeFile, allegato.nomeFile)" style=" cursor: pointer; text-decoration:underline">{{allegato.nomeFile}}</span>
                    <span v-if="allegato.idprogetto == '0'" >{{allegato.nomeFile}}</span>
                </div>
            <div class="col">{{allegato.noteFile}}</div>
            <div class="col">{{allegato.tipoAllegato}}</div>
            <div class="col"> <q-btn   size="sm" round icon="delete" @click="value.elencoAllegati[index].cancellare='1'" /></div>
            </div>
        </div>
        
</div>
</template>
<script>
import Axios from 'axios';

export default {
    data(){return {
        nameAuxFile:'',
        auxFile:'',
        noteallegatoDiallegati:'',
        tipoAllegatodiAllegati:{value:'',label:'Seleziona..'},


         tipiDiAllegati:[
        {
        value:'ModelloPrivacy',
        label:'Modello privacy',
        },
        {
        value:'Visure',
        label:'Visure',
        },
        {
        value:'TitoloProvenienza',
        label:'Titolo di provenienza',
        },
        {
        value:'DocumentiIdentita',
        label:'Documenti di identità',
        },
        {
        value:'ConcessioneEdilizia',
        label:'Concessione edilizia',
        },
        {
        value:'Agibilita',
        label:'Agibilità',
        },
        {
        value:'PermessoCostruire',
        label:'Permesso di Costruire',
        },
        {
        value:'Cila',
        label:'Cila',
        },
        {
        value:'Cil',
        label:'Cil',
        },
        {
        value:'AgibilitaAbitabilita',
        label:'Agibilità abitabilità',
        },
        {
        value:'SCA',
        label:'SCA',
        },
        {
        value:'SCIA',
        label:'SCIA',
        },
        {
        value:'DIA',
        label:'DIA',
        },
        {
        value:'CertificazioniVarie',
        label:'Certificazioni varie',
        },
        {
        value:'DocumentiStrutture',
        label:'Documenti Strutture',
        },
        {
        value:'DocumentiImpianti',
        label:'Documenti Impianti',
        },
        {
        value:'PareriVariEnti',
        label:'Pareri vari enti',
        },
        {
        value:'APE',
        label:'APE',
        },
        {
        value:'Contratto',
        label:'Contratto',
        },
        {
        value:'altro',
        label:'Altro',
        },
       
        
      ],
    }},
    methods:{ 
        
        handleFile(e){
            this.nameAuxFile=e.target.files[0].name;
            const selectImage= e.target.files[0];
            this.createBase64(selectImage);
            },
            
        createBase64(fileObject)
        {
            const reader = new FileReader();
            reader.onload = (e)=>{
                var aux= e.target.result;
                var base64string = window.btoa(aux);
                this.auxFile=base64string;
            };
            this.auxFile= reader.readAsBinaryString(fileObject);
        },
        
        downloadFile(path,titoloFile){
            Axios({
                url: this.linkApi+'/download/?pp='+path,
                method:'get',
                responseType: 'arraybuffer',
                }).then(response=>{
                    console.log(response);
                    if(response.data.byteLength >2){
                        
                        const url = window.URL.createObjectURL(new Blob([response.data]))
                        const link = document.createElement('a')
                        link.href = url
                        link.setAttribute('download',titoloFile)
                        document.body.appendChild(link)
                        link.click()
                        }else
                        {
                            alert('Errore file non esistente');
                        }
                    });
                },
        addrowAllegati()
        {
            //TODO prevedere caricaemnto sul database diretto
            this.value.elencoAllegati.push({
                nomeFile:this.nameAuxFile,
                fileBase64:this.auxFile,
                noteFile:this.noteallegatoDiallegati,
                tipoAllegato:this.tipoAllegatodiAllegati.value,
                idprogetto:0,
                new:1,
                cancellare:0,
                });

    },
        },

    props:["value"]
}
</script>

<style scoped>
.bgmargintop{
  background-color: white; margin-top:20px;
}
.bgAree{
  background-color: white;padding:5px
}
.paddingInput{padding:10px;}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff;
  border-bottom: 1px solid #d4d4d4;
}
.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9;
  
}
.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important;
  color: #ffffff;
}
</style>