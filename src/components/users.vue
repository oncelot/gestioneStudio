<template>
 <div class="q-gutter-sm row  justify-center">
       <q-form @submit="creautente"  >
     {{ !(modificaUtente  || nuovoutente) }}
     {{ (modificaUtente  || nuovoutente) }}
     {{nuovoutente}}
     <q-input
         class="col-md-7 col-sm-12" v-model="cred.nome" :dense='false' outlined label="Nome e Cognome" 
         :disable="disattiva"
         lazy-rules
         :rules="[ val => val && val.length > 0 || 'Valore obbligatorio']"
         />
         <q-input  class="col-md-7 col-sm-12" v-model="cred.email" :dense='false' outlined type="email" label="Email*"
                :disable=" disattiva"
                lazy-rules
                  :rules="[ val => val && val.length > 0 || 'Valore obbligatorio']" />

          <div v-if="!modificaUtente">
              <label>Ruolo Utente</label>
              {{cred.ruolo}}
          </div>

          <div v-if="modificaUtente">
            <label>Ruolo Utente</label>
            <q-option-group
              :options="ruoliUtenti"
              label="Notifications"
              type="checkbox"
              v-model="cred.ruolo"
              />
              </div>
         <!-- <q-input class="col-md-7 col-sm-12" name="ruolo" v-model="cred.ruolo" :dense='false' outlined type="text" label="Ruolo*"
                  :disable="!modificaUtente"
                 lazy-rules
                  :rules="[ val => val && val.length > 0 || 'Valore obbligatorio']"  /> -->
          <q-input v-if="nuovoutente" class="col-md-7 col-sm-12" v-model="pass1" :dense='false' outlined type="password" label="Password*"
               
                 lazy-rules
                  :rules="[ val => val && val.length > 0 || 'Valore obbligatorio']"  />
          <q-input  v-if="nuovoutente"  class="col-md-7 col-sm-12" v-model="pass2" :dense='false' outlined type="password" label="Ripeti password*"
                
                 lazy-rules
                  :rules="[ val => val && val.length > 0 || 'Valore obbligatorio']"  />
      
          <div class="col-md-12">
            <q-btn color="primary" type="submit" v-if="nuovoutente" icon="check" label="Crea" />
            <q-btn icon="edit" @click="modifiche()"  v-if="!nuovoutente" />
            <q-btn color="primary"  v-if="!nuovoutente && modificaUtente" icon="check" label="Modifica" @click="modificaUser()" />
          </div>
        </q-form>
</div>
</template>
<script>
import auth from '@/auth'
import Axios from 'axios'

export default {
 
     props: ['iduser'],
    data(){return {
         cred:{
           id:null,
             nome:null,
             email:'',
             password:'',
             ruolo:[]
             },
             pass1:'',
             pass2:'',
           nuovoutente:true,
           modificaUtente:false,
           disattiva:false,
          ruoliUtenti:[
            {value:'guest',label:'Ospite'},
            {value:'admin',label:'Admin'},
            {value:'collaboratoreInterno',label:'Collaboratore Interno'},
            
            ]
           
      
    }},
    methods:{
      modifiche(){
        if(this.modificaUtente){
          this.modificaUtente=false;
          this.disattiva=true;
          }else{
            this.modificaUtente=true
            this.disattiva=false;
            }
      },
        creautente(){
        
            if(this.pass1==this.pass2){
                this.cred.password=this.pass1
                auth.Register(this.cred,'/utenti');
            }else{
               alert('le password risultano diverse');
            }
        
    },
    modificaUser(){
        auth.Update(this.cred,'/');
       
    }
    },
    beforeMount:function(){
        if(this.iduser==null || this.iduser=='' ){
         this.cred.nome=null;
          this.cred.email=null;
          this.cred.password=null;
          this.pass1=null;
          this.pass2=null;
          this.nuovoutente=true;
          this.modificaUtente=false;
          this.disattiva=false;

        }
        else{
        this.nuovoutente=false;
        this.modificaUtente=false;
        this.disattiva=true;
        /**recupero dati */
         Axios.post(this.linkApi+'/lista-users/'+this.iduser).then(response=>{
          console.log(response.data[0]);
          this.cred.nome=response.data[0].name;
            this.cred.email=response.data[0].email;

            if (response.data[0].role != null){
            var  ruoliUtentiSplit=response.data[0].role.split(';');
              if (ruoliUtentiSplit != null){

               ruoliUtentiSplit.forEach(element => {
                  this.cred.ruolo.push(element);
                });
              }
            }
            
            this.cred.id=response.data[0].id;
        })
        }

    }
    
}
</script>