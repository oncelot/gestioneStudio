import baseApi from '@/baseApi'
import router from '@/router'
import store from '@/store'
//import { LocalStorage } from 'quasar';

const LOGIN_URL = '/login';
const LOGOUT_URL = '/logout';
const REG_URL = '/register';
const UPD_URL = '/update';

export default ({
    userDefault:{
        id:'',
        name:'',
        email:'',
        role:'',
        token:''
    },
    LogIn(cred,redirect){
        baseApi().post(LOGIN_URL,cred).then((response)=>{
            if(!response.data.error){
                store.dispatch('SET_AUTH_USER',response.data.user.user);
                store.dispatch('SET_TOKEN',response.data.user.token);
                store.dispatch('SET_AUTH',true);
                localStorage.setItem('token',response.data.user.token.value)
                router.push(redirect);
                
            }else{
                alert('error');
            }
            console.log(response.data);
        });
    },
    Register(cred,redirect){
        baseApi().post(REG_URL,cred).then((response)=>{
            console.log(response);
            if(response.data.error){alert('errore regsitrazione');}
            else{router.push(redirect);}
    });
    },
    Update(cred,redirect){
        baseApi().put(UPD_URL,cred).then(response=>{
            if(response.data.error){alert('errore update utente');}
            else{router.push(redirect);}
        })
    },
    LogOut(){
        baseApi().get(LOGOUT_URL).then((response)=>{
            if(!response.data.error){
                this.clear();
                router.push('/')}
            });
    },
  async  AuthCheck(){
      await  baseApi().get('/user').then((response)=>{
          if (!response.data.error){
            store.dispatch('SET_AUTH_USER',response.data.user.user);
            store.dispatch('SET_TOKEN',response.data.user.token);
            store.dispatch('SET_AUTH',true);
            localStorage.setItem('token',response.data.user.token.value)
          }
        });
    },
    clear(){
        store.dispatch('GET_AUTH_USER',this.userDefault);
        store.dispatch('SET_TOKEN','');
        store.dispatch('SET_AUTH',false);
        localStorage.removeItem('token');

    }
})