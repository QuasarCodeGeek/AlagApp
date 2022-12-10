<template>
  <ion-app>
    <ion-content class="container">
        <div>
          <ion-avatar >
            <img :src = "logo">
          </ion-avatar>
        </div>
        <div>
          <h1><strong>AlagApp</strong></h1>
        </div><br>
        <div>
          <ion-item lines="none" class="login">
            <ion-icon :src = "person" color="success"></ion-icon>
            <ion-input type = "text" v-model="email" placeholder="Email" required></ion-input>
          </ion-item>
          <ion-item lines="none" class="login">
            <ion-icon :src = "key" color="success"></ion-icon>
            <ion-input type = "text" v-model="password" placeholder="Password" required></ion-input>
        </ion-item>
        </div>
        <div>
          <ion-input v-model="user" hidden></ion-input>
          <ion-button color="success" @click="saveLog" shape="round">Login</ion-button>
        </div>
    </ion-content>
  </ion-app>
</template>

<script lang="ts">
import { IonApp, IonItem, IonButton, IonInput, IonContent } from '@ionic/vue';
import { defineComponent } from 'vue';  
import axios from 'axios';
import {person, key} from 'ionicons/icons';


export default defineComponent({
  components: {
    IonApp,
    IonItem,
    IonButton,
    IonInput,
    IonContent
  }, data(){
    return{
      email:'',
      password:'',
      message: '',
      user: ''
    }
  }, setup(){
    return{
      person,
      key,
      logo: "assets/img/AlagApp.png"
    }
  }, methods:{
    saveLog(){
      axios.post("http://localhost/_alagapp/_login.php", null, {params:{
        "useremail":this.email,
        "userpassword":this.password
      }})
        .then((response) => {
          this.user = response.data.userid;
          if(response.data.message == "success"){
            alert("Login Successful!");
            this.$router.push("/home/"+this.user);
          } else {
            alert("Invalid")
          }
        })
        .catch( function(error) {
            console.log(error);
          });
      }
    }
  });
</script>

<style scoped>
ion-app {
  --ion-background-color: #E8F5E9;
}

ion-content {
  margin: auto;
}

.container {
  text-align: center;
  align-content: center;
}

ion-avatar {
    margin: auto;
    width: 150px;
    height: 150px;
    align-content: center;
    align-items: center;
    margin-top: 50px;
}
h1 {
  color: #4CAF50;
}
ion-item.login {
  --ion-background-color: whitesmoke;
  border-radius: 5px;
  margin: 25px;
}

ion-input {
 margin-left: 5px;
}
</style>
