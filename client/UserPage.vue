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
          <ion-item lines="none" :href="/home/+user.userid">
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
  
  <ion-app id ="main-content">
    <ion-header>
      <ion-toolbar color="success">
        <ion-buttons slot="start">
          <ion-menu-button></ion-menu-button>
        </ion-buttons>
        <ion-title>Home</ion-title>
      </ion-toolbar>
    </ion-header>
    
    <ion-content>
      <ion-card v-for="user in userList" :key="user.userid">
          <img v-if="user.usergender == 'M'" src="assets/img/male.png" alt="avatar" />
          <img v-else src="assets/img/female.png" alt="avatar" />
        <ion-card-content>
          <ion-grid>
            <ion-row>
              <ion-label>Name: {{user.userfname}} {{user.usermname}} {{user.userlname}}</ion-label>
            </ion-row>
            <ion-row>
              <ion-label>Gender: {{user.usergender}}</ion-label>
            </ion-row>
            <ion-row>
              <ion-label>DOB: {{user.userbdate}}</ion-label>
            </ion-row>
            <ion-row>
              <ion-label>Address: {{user.userdistrict}} {{user.usermunicipality}} {{user.userprovince}}</ion-label>
            </ion-row>
          </ion-grid>
        </ion-card-content>
      </ion-card>
    </ion-content>
  </ion-app>
</template>

<script lang="ts">
  import { 
    IonApp,
    IonButtons,
    IonContent,
    IonHeader,
    IonMenu,
    IonMenuButton,
    IonTitle,
    IonToolbar, 
    IonLabel,
    IonList,
    IonItem,
    IonAvatar,
    IonCard,
    IonCardContent,
    IonGrid,
    IonRow
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
    name: 'HomePage',
    components: {  
      IonApp,
      IonButtons,  
      IonContent,  
      IonHeader,
      IonMenu,  
      IonMenuButton,
      IonTitle,  
      IonToolbar,
      IonLabel,
      IonList,
      IonItem,
      IonAvatar,
      IonCard,
      IonCardContent,
      IonGrid,
      IonRow
    }, setup(){
      const route = useRoute();        
      const userid = route.params.userid;
      return{
        person,
        card,
        chatbox,
        home,
        fitness,
        options,
        informationCircle,
        logOut,
        userid,
    }
  }, data() {
    return {
      userList: [],
      user: [],
      dog: "assets/img/dog/Dog_PembrokeWelshCorgi.jpg",
      cat: "assets/img/cat/Cat_ScottishFold.jpg",
      bird: "assets/img/bird/Bird_ConuresSmall.jpg",
      mouse: "assets/img/mouse/Mouse_Marked.jpg",
      logo: "assets/img/AlagApp.png",
      profile: "assets/img/lance.jpg"
    }
  }, mounted() {
      this.viewUser();
      this.getUser();
  }, methods: {
    viewUser() {
        axios.post("http://localhost/_alagapp/_userprofile.php", null, {params: {
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
ion-card-title, ion-card-subtitle {
  color: #2E7D32;
}
ion-label {
  margin-left: 15px;
}
ion-button {
  color: whitesmoke;
}
.cardbutton{
  background-color: #4CAF50;
  text-align: center;
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