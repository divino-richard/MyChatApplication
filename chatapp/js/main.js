
var choosenProfile = document.querySelector("#profile");
function trigerProfile(){
    choosenProfile.click();
}

function displayProfile(e){
    if(e.files[0]){
        var reader = new FileReader();

        reader.onload = function(e){
            document.querySelector("#profile-view").setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(e.files[0]);
    }
}

function sendMessages(receiverId,senderId){
    var msg = document.querySelector("#text-messages").value;

    var params = "reciever_id="+receiverId+"&sender_id="+senderId+"&message="+msg;//Save the item id and the setted quantity with concatination
    var xhr = new XMLHttpRequest();//Create a new http request object
    xhr.open("POST", "classes/userscontr.class.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                window.location.reload(true);
            }
        }
    }

    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send(params);//Send with the data taken from the current page
}

function scrollingMessage(){
    var convo = document.getElementById("convo");
    convo.scrollBy(0, 200);
}
scrollingMessage();

setInterval(()=>{
    $("#conversation").load(" #conversation");
}, 100);
