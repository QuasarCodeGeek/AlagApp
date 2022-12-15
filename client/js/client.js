function login(){
    const email = document.getElementById("email").value;
    const password = document.getElementById("password".value);
}
//Field Required Alert Trigger
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

function getSched(qid) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("EditHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "api/sched/editSched.php?qid="+qid);
    xhttp.send();
}

function getSymptom() {
    var type = document.getElementById("type").value;
    var part = document.getElementById("part").value;
    var symptom = document.getElementById("symptom").value;
    console.log(type+" "+part+" "+symptom);
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("ContentHere").innerHTML = this.responseText;
    }
    xhttp.open("GET", "api/symptom.php?type="+type+"&part="+part+"&symptom="+symptom);
    xhttp.send();
}

    