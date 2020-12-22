const auth=({
state:{
user:{
    'id':'',
'name':'',
'email':'',
'role':''

},
token:{
    'value':'',
    'type':'',
    'experies_at':''
},
autheticated:false

},
mutations:{
SET_AUTH_USER:(state,data)=>{state.user=data},
SET_TOKEN:(state,token)=>{state.token=token;},
SET_AUTH:(state,authh)=>{state.autheticated=authh}

},
actions:{

    SET_AUTH_USER:({commit},data)=>{commit('SET_AUTH_USER',data)},
    SET_TOKEN:({commit},token)=>{commit('SET_TOKEN',token)},
    SET_AUTH:({commit},authh)=>{commit('SET_AUTH',authh)}

},
getters:{

    GET_AUTH_USER:state=>state.user,
    GET_TOKEN:state=>state.token,
    GET_AUTH:state=>state.autheticated
}

});

export default auth