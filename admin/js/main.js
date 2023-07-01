//const { isEmptyObject } = require("jquery");

//const toastElList = document.querySelectorAll('.toast')
//const toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl, option))

function getRecord(petid) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("pageBody").innerHTML = this.responseText;
  }
  xhttp.open("GET", "petHistory.php?petid="+petid);
  xhttp.send();
}
// Add Data Function
function userNew() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "api/newData/userNew.php");
    xhttp.send();
  }
function petNew(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "api/newData/addPet.php");
    xhttp.send()
  }

function PetNew(userid){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "newData/petNew.php?userid="+userid);
    xhttp.send();
  }

function vaccineNew() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "../newData/vaccineNew.php");
    xhttp.send();
  }

function cardNew(petid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "newData/cardNew.php?petid="+petid);
    xhttp.send();
  }

/*function cardAlterNew(petid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "newData/cardNewalter.php?petid="+petid);
    xhttp.send();
  }*/

function noteNew(petid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "newData/noteNew.php?petid="+petid);
    xhttp.send();
  }

function recordNew(petid){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "newData/recordNew.php?petid="+petid);
    xhttp.send();
  }

  function symptomNew() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "../newData/newSymptom.php");
    xhttp.send();
  }

function scheduleNew(qid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("schedNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "newData/scheduleNew.php?userid="+qid);
    xhttp.send();
  }

  function schedNew(userid, petid, duedate) {
    var user = userid;
    var pet = petid;
    var ddate = duedate;
    comsole
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
        document.getElementById("autoNew").innerHTML = this.responseText;
      }
      xhttp.open("GET", "schedNew.php?userid="+user+"&petid="+pet+"&cnext="+ddate);
      xhttp.send();
  }

// Edit Functions
function userEdit(userid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "editData/userEdit.php?id="+userid);
    xhttp.send();
}

function petEdit(petid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "editData/petEdit.php?id="+petid);
    xhttp.send();
}

function petImg(petid) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("modalPict").innerHTML = this.responseText;
  }
  xhttp.open("GET", "editData/petImage.php?id="+petid);
  xhttp.send();
}

function vaccineEdit(vaxid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "../editData/vaccineEdit.php?id="+vaxid);
    xhttp.send();
}

function cardEdit(cid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "editData/cardEdit.php?cid="+cid);
    xhttp.send();
}

/*function cardAlterEdit(cid) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("modalHere").innerHTML = this.responseText;
  }
  xhttp.open("GET", "editData/cardEditalter.php?cid="+cid);
  xhttp.send();
}*/

function prescriptionEdit(nid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "editData/prescriptionEdit.php?nid="+nid);
    xhttp.send();
}

function recordEdit(rid){
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("modalHere").innerHTML = this.responseText;
  }
  xhttp.open("GET", "editData/recordEdit.php?rid="+rid);
  xhttp.send();
}

function scheduleEdit(qid) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("schedHere").innerHTML = this.responseText;
  }
  xhttp.open("GET", "editData/scheduleEdit.php?qid="+qid);
  xhttp.send();
}
function schedEdit(qid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("schedHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "editData/scheduleEdit.php?qid="+qid);
    xhttp.send();
}

function SchedEdit(qid) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("schedHere").innerHTML = this.responseText;
  }
  xhttp.open("GET", "editData/schedEdit.php?qid="+qid);
  xhttp.send();
}

function symptomEdit(sid) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("modalHere").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../editData/editSymptom.php?sid="+sid);
  xhttp.send();
}

function adminEdit(id) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("modalHere").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../adminData/adminEdit.php?id="+id);
  xhttp.send();
}

//Sort Functions
function descUser() {
  document.getElementById("table").style.display = "none";
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("alter").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../sortData/userDES.php");
  xhttp.send();
}

function descSched() {
  document.getElementById("table").style.display = "none";
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("alter").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../sortData/schedDES.php");
  xhttp.send();
}
function descPet() {
  document.getElementById("table").style.display = "none";
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("alter").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../sortData/petDES.php");
  xhttp.send();
}
function descCard() {
  document.getElementById("table").style.display = "none";
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("alter").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../sortData/cardDES.php");
  xhttp.send();
}

function descNote() {
  document.getElementById("table").style.display = "none";
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("alter").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../sortData/noteDES.php");
  xhttp.send();
}

function descConsult() {
  document.getElementById("table").style.display = "none";
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("alter").innerHTML = this.responseText;
  }
  xhttp.open("GET", "api/sortData/consultDES.php");
  xhttp.send();
}

function descVaxx() {
  document.getElementById("table").style.display = "none";
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("alter").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../sortData/vaxxDES.php");
  xhttp.send();
}

function descSymptom() {
  document.getElementById("table").style.display = "none";
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("alter").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../sortData/symptomDES.php");
  xhttp.send();
}
//=======================================================================================================================
// Additional Functions
function checkField() {
  var email = document.getElementById("code").value;
  var password = document.getElementById("pass").value;

  if(email == "" || password == ""){
      const alertPlaceholder = document.getElementById('liveAlertPlaceholder')

      const wrapper = document.createElement('div')
      wrapper.innerHTML = [
          `<div class="alert alert-warning alert-dismissible" role="alert">`,
          `   <div>Complete fields required!</div>`,
          '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
          '</div>'
      ].join('')

      alertPlaceholder.append(wrapper)
  }
}

function checkDate() {
  var date = document.getElementById("date").value;

  var dateOne = new Date(date);
  var dateTwo = new Date(); 

  if(dateOne <= dateTwo){
      const alertPlaceholder = document.getElementById('errorDate')

      const wrapper = document.createElement('div')
      wrapper.innerHTML = [
          `<div class="alert alert-warning alert-dismissible" role="alert">`,
          `   <div>Invalid Date!</div>`,
          '</div>'
      ].join('')

      alertPlaceholder.append(wrapper);
  }

  setTimeout(function(){
    document.getElementById("errorDate").style.display='none';
  },5000);
}


//========================================================================================================================
function triggerModal(){
  var trigger = document.getElementById('trigger').value;
  if(trigger == 'newUser'){
    document.getElementById('triggerNewUser').click(); 
  } else if(trigger == 'newPet'){
    document.getElementById('triggerNewPet').click(); 
  } else if(trigger == 'newSched'){
    document.getElementById('triggerNewSched').click(); 
  } else if(trigger == 'newCard'){
    document.getElementById('triggerNewCard').click(); 
  } else if(trigger == 'newNote'){
    document.getElementById('triggerNewNote').click(); 
  } else if(trigger == 'newVaccine'){
    document.getElementById('triggerNewVaccine').click(); 
  } else if(trigger == 'newSymptom'){
    document.getElementById('triggerNewSymptom').click(); 
  } else if(trigger == 'newRecord'){
    document.getElementById('triggerNewRecord').click(); 
  } else if(trigger == 'editUser'){
    document.getElementById('triggerEditUser').click(); 
  } else if(trigger == 'editPet'){
    document.getElementById('triggerEditPet').click(); 
  } else if(trigger == 'editSched'){
    document.getElementById('triggerEditSched').click(); 
  } else if(trigger == 'editCard'){
    document.getElementById('triggerEditCard').click(); 
  } else if(trigger == 'editNote'){
    document.getElementById('triggerEditNote').click(); 
  } else if(trigger == 'editVaccine'){
    document.getElementById('triggerEditVaccine').click(); 
  } else if(trigger == 'editSymptom'){
    document.getElementById('triggerEditSymptom').click(); 
  } else if(trigger == 'editRecord'){
    document.getElementById('triggerEditRecord').click(); 
  } else if(trigger == 'success'){
    document.getElementById('triggerSuccess').click(); 
  } else if(trigger == 'delSCard'){
    document.getElementById('successDelCard').click(); 
  } else if(trigger == 'delSNote'){
    document.getElementById('successDelNote').click(); 
  } 
  
    else if(trigger == 'newEUser'){
    document.getElementById('triggerENewUser').click(); 
  } else if(trigger == 'newEPet'){
    document.getElementById('triggerENewPet').click(); 
  } else if(trigger == 'newESched'){
    document.getElementById('triggerENewSched').click(); 
  } else if(trigger == 'newECard'){
    document.getElementById('triggerENewCard').click(); 
  } else if(trigger == 'newENote'){
    document.getElementById('triggerENewNote').click(); 
  } else if(trigger == 'newEVaccine'){
    document.getElementById('triggerENewVaccine').click(); 
  } else if(trigger == 'newESymptom'){
    document.getElementById('triggerENewSymptom').click(); 
  } else if(trigger == 'newERecord'){
    document.getElementById('triggerENewRecord').click(); 
  } else if(trigger == 'editEUser'){
    document.getElementById('triggerEEditUser').click(); 
  } else if(trigger == 'editEPet'){
    document.getElementById('triggerEEditPet').click(); 
  } else if(trigger == 'editESched'){
    document.getElementById('triggerEEditSched').click(); 
  } else if(trigger == 'editECard'){
    document.getElementById('triggerEEditCard').click(); 
  } else if(trigger == 'editENote'){
    document.getElementById('triggerEEditNote').click(); 
  } else if(trigger == 'editEVaccine'){
    document.getElementById('triggerEEditVaccine').click(); 
  } else if(trigger == 'editESymptom'){
    document.getElementById('triggerEEditSymptom').click(); 
  } else if(trigger == 'editERecord'){
    document.getElementById('triggerEEditRecord').click(); 
  } else if(trigger == 'failed'){
    document.getElementById('triggerFailed').click(); 
  } else if(trigger == 'delFCard'){
    document.getElementById('failedDelCard').click(); 
  } else if(trigger == 'delFNote'){
    document.getElementById('failedDelNote').click(); 
  }
}