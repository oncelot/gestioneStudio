<template>
    <div class="q-pa-md">
        <div class="q-gutter-md">
        <div class=" row justify-center ">
            <div class="col-3">
                <q-input v-model="cred.email" type="text" label="Email" />
                <q-input v-model="cred.password" type="password" label="Password" />
               

            </div>
        </div>
        <div class=" row justify-center q-gutter-md">
            <q-btn color="primary"  style="text-align:center" icon="check" label="Login" @click="login()" />
            <q-btn color="secondary"  style="text-align:center" icon="check" label="Registrati" @click="$router.push({ path:'Registrazione-utente'});" />
        </div>
    </div>
    </div>
</template>
<script>
import auth from '@/auth'
export default {
    data(){return {
        cred:{
        email:'',
        password:''
        }

    }},
    methods:{
        login(){
            auth.LogIn(this.cred,'/');

        },
     
    }
 
   
}
</script>

                
                    
                