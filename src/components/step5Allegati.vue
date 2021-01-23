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
                <q-select v-model="value.tipoAllegatodiAllegati" :options="tipiDiAllegati" :dense="true" outlined label="Seleziona..."  />
                <q-input v-if="value.tipoAllegatodiAllegati.value =='altro'" v-model="value.tipoAltroAllegato" type="text" label="Altro tipo allegato" :dense=true />
            </div>
            <div class="col-12"> 
                <label for="" class="text-bold"> Note</label>
                <q-input v-model="value.noteallegatoDiallegati" outlined :dense="true" type="text"  />  
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
                    <span v-if="allegato.idprogetto != '0'"  @click="downloadFile(idprogetto+'/'+allegato.nomeFile, allegato.nomeFile)" style=" cursor: pointer; text-decoration:underline">{{allegato.nomeFile}}</span>
                    <span v-if="allegato.idprogetto == '0'" >{{allegato.nomeFile}}</span>
                </div>
            <div class="col">{{allegato.noteFile}}</div>
            <div class="col">{{allegato.tipoAllegato}}</div>
            <div class="col"> <q-btn   size="sm" round icon="delete" @click="elencoAllegati[index].cancellare='1'" /></div>
            </div>
        </div>
        
</div>
</template>
<script>
import Axios from 'axios';

export default {
    data(){return {
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
        },

    props:["value"]
}
</script>