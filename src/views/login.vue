<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col">
                <q-input v-model="cred.email" type="text" label="Email" />
                <q-input v-model="cred.password" type="password" label="Label" />
                <q-btn color="primary" icon="check" label="Login" @click="login()" />

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

        }
    }
 
   
}
</script>

                
                    
                