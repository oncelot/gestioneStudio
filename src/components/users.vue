<template>
 <div class="q-gutter-sm  justify-center">
       <q-form @submit="creautente"  >
         {{iduser}}
         <q-input
         class="col-md-7 col-sm-12" v-model="cred.nome" :dense='false' outlined label="Nome*" 
         :disable="!modificaUtente"
         lazy-rules
         :rules="[ val => val && val.length > 0 || 'Valore obbligatorio']"
         />
         <q-input  class="col-md-7 col-sm-12" v-model="cred.email" :dense='false' outlined type="email" label="Email*"
                :disable="!modificaUtente"
                lazy-rules
                  :rules="[ val => val && val.length > 0 || 'Valore obbligatorio']" />
          <q-input class="col-md-7 col-sm-12" name="ruolo" v-model="cred.ruolo" :dense='false' outlined type="text" label="Ruolo*"
                  :disable="!modificaUtente"
                 lazy-rules
                  :rules="[ val => val && val.length > 0 || 'Valore obbligatorio']"  />
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
             ruolo:''
             },
             pass1:'',
             pass2:'',
           nuovoutente:true,
           modificaUtente:false,
      
    }},
    methods:{
      modifiche(){
if(this.modificaUtente){this.modificaUtente=false}else{this.modificaUtente=true}
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
          this.modificaUtente=true;

        }
        else{
        this.nuovoutente=false;
        this.modificaUtente=false;
         Axios.post(this.linkApi+'/lista-users/'+this.iduser).then(response=>{
          console.log(response.data[0]);
          this.cred.nome=response.data[0].name;
            this.cred.email=response.data[0].email;
            this.cred.ruolo=response.data[0].role;
            this.cred.id=response.data[0].id;
        })
        }

    }
    
}
</script>