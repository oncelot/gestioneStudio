<template>
    <div class="q-gutter-sm row  justify-center" style="padding-top:30px">
       <q-form @submit="creautente"  >
     
     <q-input
         class="col-md-7 col-sm-12" v-model="cred.nome" :dense='false' outlined label="Nome*" 
        
         lazy-rules
         :rules="[ val => val && val.length > 0 || 'Valore obbligatorio']"
         />
         <q-input  class="col-md-7 col-sm-12" v-model="cred.email" :dense='false' outlined type="email" label="Email*"
                
                lazy-rules
                  :rules="[ val => val && val.length > 0 || 'Valore obbligatorio']" />

          <q-input class="col-md-7 col-sm-12" v-model="pass1" :dense='false' outlined type="password" label="Password*"
               
                 lazy-rules
                  :rules="[ val => val && val.length > 0 || 'Valore obbligatorio']"  />
          <q-input  class="col-md-7 col-sm-12" v-model="pass2" :dense='false' outlined type="password" label="Ripeti password*"
                
                 lazy-rules
                  :rules="[ val => val && val.length > 0 || 'Valore obbligatorio']"  />
      
          <div class="col-md-12">
            <q-btn color="primary" type="submit"  icon="check" label="Crea" />
         
           
            </div>
        </q-form>
</div>
</template>
<script>
import auth from '@/auth'
export default {
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
            }
      },
      methods:{ creautente(){
            if(this.pass1==this.pass2){
                  this.cred.password=this.pass1
                  auth.Register(this.cred,'/login');
                 /* this.$q.notify({
                        type: 'positive',
                        message: `Utente Creato con Successo`
                        });*/
            }else{
                  this.$q.notify({
                        type: 'negative',
                        message: `Ule password risultano diverse`
                        });
                  }
            }
      }
}
</script>