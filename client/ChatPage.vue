<template>
  <ion-menu content-id="main-content" >
  <ion-header>
    <ion-toolbar color="success">
      <ion-title>Menu</ion-title>
    </ion-toolbar>
  </ion-header>
  
  <ion-content>
      <ion-avatar class="logo"> 
        <img :src = "logo">
      </ion-avatar>
      <div v-for="user in userList" :key="user.userid">
          <ion-list class="list">
          <ion-item lines="none" :href="/user/+user.userid">
            <ion-icon :src = "person" float="start"  size="large"></ion-icon>
            <ion-label>User Profile</ion-label>
          </ion-item>
          <ion-item lines="none" :button="/home/+user.userid">
            <ion-icon :src = "home" float="start"  size="large"></ion-icon>
            <ion-label>Home</ion-label>
          </ion-item >
          <ion-item lines="none" :href="/chat/+user.userid">
            <ion-icon :src = "chatbox" float="start"  size="large"></ion-icon>
            <ion-label>O-Consultation</ion-label>
          </ion-item >
          <ion-item  lines="none" :href="/tracker/+user.userid">
            <ion-icon :src = "fitness" float="start" size="large"></ion-icon>
            <ion-label>Pet Health Tracker</ion-label>
          </ion-item>
          <ion-item  lines="none" :href="/about/+user.userid">
            <ion-icon :src = "informationCircle" float="start" size="large"></ion-icon>
            <ion-label>About Us</ion-label>
          </ion-item>
          <ion-item  lines="none" href="/login">
            <ion-icon :src = "logOut" float="start" size="large"></ion-icon>
            <ion-label>Log Out</ion-label>
          </ion-item>
        </ion-list>
        </div>
  </ion-content>
</ion-menu>

  <ion-app id="main-content">
      <ion-header>
          <ion-toolbar color="success">
              <ion-buttons slot="start">
                  <ion-menu-button></ion-menu-button>
              </ion-buttons>
              <ion-title>O-Consultation</ion-title>
          </ion-toolbar>
      </ion-header>
    
    <ion-content>
      <div v-for="chat in chatData" :key="chat.mid">
          <ion-card slot="end" v-if="chat.msender != 0" color="success" style="width: 15rem; display: flex; text-align: left; margin-left: 30%;">
            <ion-card-content class="ion-align-items-end" >
              <ion-label>You</ion-label><br>
              <ion-label>{{chat.mcontent}}</ion-label><br>
              <ion-label>{{chat.mdatetime}}</ion-label>
            </ion-card-content>
          </ion-card>
          <ion-card v-else slot="start" style="width: 15rem; background-color: #E8F5E9; display: flex; text-align: left; margin-right: 35%;">
              <ion-card-content class="ion-align-items-start">
                <ion-label>Vet</ion-label><br>
                <ion-label>{{chat.mcontent}}</ion-label><br>
                <ion-label>{{chat.mdatetime}}</ion-label>
              </ion-card-content>
          </ion-card>
        </div>
        <ion-item class="sender" lines="none">
          <div class="field">
            <ion-input v-model="message"></ion-input>
          </div>
          <ion-button fill="clear" @click="sendChat">
            <ion-icon class="icon" :src="send"></ion-icon>
          </ion-button>
        </ion-item>
    </ion-content>
    <ion-footer>
      <ion-toolbar color="success">
        <ion-buttons v-for="id in user" :key="id.userid">
          <ion-button fill="clear" :href="/chat/+id.userid" active><strong>Chat</strong></ion-button>
          <ion-button fill="clear" :href="/call/+id.userid">Call</ion-button>
          <ion-button fill="clear" :href="/sched/+id.userid">Schedule</ion-button>
        </ion-buttons>
      </ion-toolbar>
    </ion-footer>
  </ion-app>
</template>

<script lang="ts">
import {  IonApp,  IonToolbar, IonContent, IonButtons, IonButton, IonMenuButton, IonList, IonItem, IonCard, IonCardContent,
  IonLabel, IonFooter, IonMenu, IonInput
} from '@ionic/vue';
import { defineComponent } from 'vue';  
import { useRoute } from 'vue-router';
import axios from 'axios';
import {
  person,
  card,
  chatbox,
  home,
  fitness,
  options,
  informationCircle,
  logOut,
  send
} from 'ionicons/icons';

export default defineComponent({
  name: "ChatPage",
  components: {
    IonApp,
    IonToolbar, IonContent,
    IonButtons, IonButton, IonMenuButton,
    IonLabel, IonFooter, IonList, IonItem, IonMenu, IonCard, IonCardContent, IonInput
  }, setup () {
    const route = useRoute();        
    const userid = route.params.userid;
    return {
      userid,
      person,
      card,
      chatbox,
      home,
      fitness,
      options,
      informationCircle,
      logOut,
      send
    }
  }, data () {
    return {
      chatData: [],
      userList: [],
      user: [],
      message: '',
      logo: "assets/img/AlagApp.png"
    }
  }, mounted () {
    this.getChat();
    this.checkUser();
    this.getUser();
    this.sendChat();
  }, methods: {
    getChat() {
        axios.post("http://localhost/_alagapp/_chat.php", null, {params: {
              "userid":this.userid
          }})
      .then((response)=>{
        this.chatData = response.data;
        console.log(response.data);
      })
      .catch(function(error){
        alert(error);
      });
    },
    checkUser() {
      axios.post("http://localhost/_alagapp/_user.php", null, {params: {
              "userid":this.userid
          }})
      .then((response)=>{
        this.userList = response.data;
        console.log(response.data);
      })
      .catch(function(error){
        alert(error);
      });
    },
    getUser() {
      axios.post("http://localhost/_alagapp/_user.php", null, {params: {
              "userid":this.userid
          }})
      .then((response)=>{
        this.user = response.data;
        console.log(response.data);
      })
      .catch(function(error){
        alert(error);
      });
    },
    sendChat() {
      axios.post("http://localhost/_alagapp/_message.php", null, {params: {
              "userid":this.userid,
              "message":this.message
          }})
      .then((response)=>{
        console.log(response.data);
        if(response.data.message == "success"){
          window.location.reload();
        } else {
          console.log("Error");
        }
      })
      .catch(function(error){
        alert(error);
      });
    }
  }
});
</script>

<style scoped>
ion-app {
  --ion-background-color: #C8E6C9;
}
ion-menu {
  --ion-background-color: #E8F5E9;
}
ion-card {
  --ion-background-color: #E8F5E9;
}
ion-label {
margin-left: 15px;
}
ion-button {
  margin-left: auto;
  margin-right: auto;
}

.logo{
  margin: auto;
  width: 150px;
  height: 150px;
  align-content: center;
  align-items: center;
  margin-top: 30px;
  margin-bottom: 30px;
}

.list ion-item {
color: #388E3C;
}

.sender {
  --ion-background-color: #81C784;
}
.field {
  margin: 5px;
  padding: 5px;
  width: 100%;
  border-radius: 5px;
  background-color: #C8E6C9;
}
.icon {
  color: #388E3C;
}

ion-avatar {
width: 100px;
height: 100px;
margin-right: 25px;
border: #2E7D32;
}

a {
text-decoration: none;
}
</style>
