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
        <div v-for="id in user" :key="id.userid">
          <ion-list class="list">
          <ion-item lines="none" :href="/user/+id.userid">
            <ion-icon :src = "person" float="start"  size="large"></ion-icon>
            <ion-label>User Profile</ion-label>
          </ion-item>
          <ion-item lines="none" :button="/home/+id.userid">
            <ion-icon :src = "home" float="start"  size="large"></ion-icon>
            <ion-label>Home</ion-label>
          </ion-item >
          <ion-item lines="none" :href="/chat/+id.userid">
            <ion-icon :src = "chatbox" float="start"  size="large"></ion-icon>
            <ion-label>O-Consultation</ion-label>
          </ion-item >
          <ion-item  lines="none" :href="/tracker/+id.userid">
            <ion-icon :src = "fitness" float="start" size="large"></ion-icon>
            <ion-label>Pet Health Tracker</ion-label>
          </ion-item>
          <ion-item  lines="none" :href="/about/+id.userid">
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
        <ion-list v-for="call in userData" :key="call.vid">
            <ion-item>
                <ion-label>{{call.vtype}}</ion-label>
                <ion-label>{{call.vdatetime}}</ion-label>
            </ion-item>
        </ion-list>
      </ion-content>
      <ion-footer>
        <ion-toolbar color="success">
          <ion-buttons v-for="id in user" :key="id.userid">
            <ion-button fill="clear" :href="/chat/+id.userid">Chat</ion-button>
            <ion-button fill="clear" :href="/call/+id.userid" active><strong>Call</strong></ion-button>
            <ion-button fill="clear" :href="/sched/+id.userid">Schedule</ion-button>
          </ion-buttons>
        </ion-toolbar>
      </ion-footer>
    </ion-app>
  </template>
  
  <script lang="ts">
  import {  IonApp,  IonToolbar, IonContent, IonButtons, IonButton, IonMenuButton, IonList, IonItem,
    IonLabel, IonFooter, IonMenu
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
    logOut
  } from 'ionicons/icons';
  
  export default defineComponent({
    name: "CallPage",
    components: {
      IonApp,
      IonToolbar, IonContent,
      IonButtons, IonButton, IonMenuButton,
      IonLabel, IonFooter, IonList, IonItem, IonMenu
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
      }
    }, data () {
      return {
        userData: [],
        user: [],
        userList: [],
        dog: "assets/img/dog/Dog_PembrokeWelshCorgi.jpg",
        cat: "assets/img/cat/Cat_ScottishFold.jpg",
        bird: "assets/img/bird/Bird_ConuresSmall.jpg",
        mouse: "assets/img/mouse/Mouse_Marked.jpg",
        logo: "assets/img/cat/Cat_ScottishFold.jpg"
      }
    }, mounted () {
      this.getUser();
      this.checkUser();
      this.userTab();
    }, methods: {
      getUser() {
          axios.post("http://localhost/_alagapp/_call.php", null, {params: {
                "userid":this.userid
            }})
        .then((response)=>{
          this.userData = response.data;
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
          this.user = response.data;
          console.log(response.data);
        })
        .catch(function(error){
          alert(error);
        });
      },
      userTab() {
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
  