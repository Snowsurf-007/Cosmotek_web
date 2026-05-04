function togglePassword(reset=false){
let a=document.getElementById("mdp");
if(a.getAttribute("type")=="password" && !reset){
    a.setAttribute('type','text');
    setTimeout(() => togglePassword(true),2000);
}
else{
    a.setAttribute('type','password');
}

}
