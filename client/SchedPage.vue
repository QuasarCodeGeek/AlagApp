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
    
    <ion-app id ="main-content">
      <ion-header>
        <ion-toolbar color="success">
          <ion-buttons slot="start">
            <ion-menu-button slot="start"></ion-menu-button>
          </ion-buttons>
          <ion-title>Scheduler</ion-title>
          <ion-buttons slot="end" v-for="user in userList" :key="user.userid">
            <ion-button slot="end" fill="clear" :href="/request/+user.userid">
              Add Schedule
            </ion-button>
          </ion-buttons>
        </ion-toolbar>
      </ion-header>
      
      <ion-content>
        <div v-for="sched in schedList" :key="sched.qid">
          <ion-card>
            <div>
              <img v-if="sched.pettype == 'Dog'" alt="pet" :src="dog" />
              <img v-else-if="sched.pettype == 'Cat'" alt="pet" :src="cat" />
              <img v-else-if="sched.pettype == 'Mouse'" alt="pet" :src="mouse" />
              <img v-else-if="sched.pettype == 'Bird'" alt="pet" :src="bird" />
            </div>
            <ion-card-content>
                <ion-item lines="none">
                  <ion-label>Pet: {{sched.petname}}</ion-label>
                </ion-item>
                <ion-item lines="none">
                  <ion-label>Species: {{sched.pettype}}</ion-label>
                </ion-item>
                <ion-item lines="none">
                  <ion-label>Description: {{sched.qdescription}}</ion-label>
                </ion-item>
                <ion-item lines="none">
                  <ion-label>Date: {{sched.qdate}}</ion-label>
                </ion-item>
                <ion-item lines="none">
                  <ion-label>Status: {{sched.qstatus}}</ion-label>
                </ion-item>
            </ion-card-content>
            <ion-buttons class="cardbutton">
                <ion-button class="tab"  fill="clear" :href="/editsched/+sched.qid">Edit</ion-button>
                <ion-button class="tab"  fill="clear" :href="/cancelsched/+sched.qid">Cancel</ion-button>
            </ion-buttons>
          </ion-card>
        </div>
      </ion-content>
      <ion-footer>
        <ion-toolbar color="success">
          <ion-buttons v-for="id in user" :key="id.userid">
            <ion-button class="tab"  fill="clear" :href="/chat/+id.userid">Chat</ion-button>
            <ion-button class="tab"  fill="clear" :href="/call/+id.userid">Call</ion-button>
            <ion-button class="tab"  fill="clear" :href="/sched/+id.userid" active><strong>Schedule</strong></ion-button>
          </ion-buttons>
        </ion-toolbar>
      </ion-footer>
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
      IonCard,
      IonLabel,
      IonList,
      IonItem,
      IonAvatar,
      IonButton,
      IonFooter
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
        IonCard,
        IonLabel,
        IonList,
        IonItem,
        IonAvatar,
        IonButton,
        IonFooter
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
        schedList: [],
        userList: [],
        user: [],
        dog: "assets/img/Dog/Corgi.jpg",
        cat: "assets/img/Cat/Scottish Fold.jpg",
        bird: "assets/img/Bird/Conures.jpg",
        mouse: "assets/img/Mouse/Agouti.jpg",
        logo: "assets/img/AlagApp.png"
      }
    }, mounted() {
        this.viewSchedule();
        this.getUser();
        this.checkUser();
    }, methods: {
      viewSchedule() {
          axios.post("http://localhost/_alagapp/_schedule.php", null, {params: {
                "userid":this.userid
            }})
        .then((response)=>{
          this.schedList = response.data;
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
      getUser() {
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

  .cardbutton ion-button {
    color: whitesmoke;
  }
  .cardbutton{
    background-color: #4CAF50;
  }

  .tab {
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

  .queue {
    width: 85%;
    margin-left: auto;
    margin-right: auto;
  }

  .selection {
    width: 50%;
    padding: 5px;
    background-color:  rgb(184, 223, 184);
    border-radius: 5px;
    text-align: center;
    align-items: center;
  }
  </style>