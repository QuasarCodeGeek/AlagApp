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

function cardAlterNew(petid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "newData/cardNewalter.php?petid="+petid);
    xhttp.send();
  }

function noteNew(petid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "newData/noteNew.php?petid="+petid);
    xhttp.send();
  }
function scheduleNew() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalNew").innerHTML = this.responseText;
    }
    xhttp.open("GET", "newData/scheduleNew.php");
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

function cardAlterEdit(cid) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("modalHere").innerHTML = this.responseText;
  }
  xhttp.open("GET", "editData/cardEditalter.php?cid="+cid);
  xhttp.send();
}

function prescriptionEdit(nid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("modalHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "editData/prescriptionEdit.php?nid="+nid);
    xhttp.send();
}

function scheduleEdit(qid) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("schedHere").innerHTML = this.responseText;
  }
  xhttp.open("GET", "api/editData/scheduleEdit.php?qid="+qid);
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
  xhttp.open("GET", "../editData/scheduleEdit.php?qid="+qid);
  xhttp.send();
}

// Search Functions
function _searchAccount() {
  var account = document.getElementById("searchAccount").value;
    if(account != "") {
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
        document.getElementById("accountHere").innerHTML = this.responseText;
      }
      xhttp.open("GET", "api/searchData/searchAccount.php?account="+account);
      xhttp.send();
    } else {
      document.getElementById("accountHere").innerHTML = "";
    }
}

// Additional Functions
function checkField() {
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;

  if(email == "" || password == ""){
      console.log(email+"" +password);
      const alertPlaceholder = document.getElementById('liveAlertPlaceholder')

      const wrapper = document.createElement('div')
      wrapper.innerHTML = [
          `<div class="alert alert-success alert-dismissible" role="alert">`,
          `   <div>Complete fields required!</div>`,
          '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
          '</div>'
      ].join('')

      alertPlaceholder.append(wrapper)
  }
}