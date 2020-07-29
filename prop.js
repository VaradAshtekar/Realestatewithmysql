
var modalBtns = [...document.querySelectorAll(".contact")];
modalBtns.forEach(function(btn){
btn.onclick = function() {
var modal = btn.getAttribute('data');
document.getElementById(modal).style.display = "block";
}
}); 
var closeBtns = [...document.querySelectorAll(".close")];
closeBtns.forEach(function(btn){
btn.onclick = function() {
var modal = btn.closest('.modal');
modal.style.display = "none";
}
});
window.onclick = function(event) {
if (event.target.className === "modal") {
event.target.style.display = "none";
}
}
             


var modalBtns = [...document.querySelectorAll(".contact")];
modalBtns.forEach(function(btn){
btn.onclick = function() {
var modal = btn.getAttribute('data');
document.getElementById(modal).style.display = "block";
}
}); 
var closeBtns = [...document.querySelectorAll(".close")];
closeBtns.forEach(function(btn){
btn.onclick = function() {
var modal = btn.closest('.modal');
modal.style.display = "none";
}
});
window.onclick = function(event) {
if (event.target.className === "modal") {
event.target.style.display = "none";
}
}
             


let select = document.getElementsByTagName("select");

    select[0].addEventListener("change", function(){
        let divcard = document.getElementsByClassName("card");
                       
        for(var i=0; i<divcard.length; i++){
            let divcardpara = document.getElementsByClassName("card-body")[i].getElementsByTagName("p");
            // console.log(divcardpara[0].textContent);
            if(select[0].value == divcardpara[0].textContent){
                divcard[i].style.display = "";
            }else{
                divcard[i].style.display = "none";
            }

        }               
       })
    

       select[2].addEventListener("change", function(){
         let divcard = document.getElementsByClassName("card");

        for(var i=0; i<divcard.length; i++){
            let divcardpara = document.getElementsByClassName("card-body")[i].getElementsByTagName("p");
            // console.log(divcardpara[0].textContent);
            if(select[2].value == divcardpara[4].textContent){
                divcard[i].style.display = "";
            }else{
                divcard[i].style.display = "none";
            }

        }               
       })
    

       select[3].addEventListener("change", function(){
        let divcard = document.getElementsByClassName("card");

        for(var i=0; i<divcard.length; i++){
            let divcardpara = document.getElementsByClassName("card-body")[i].getElementsByTagName("p");
            
            // console.log(divcardpara[0].textContent);
            if(select[3].value == divcardpara[5].textContent){
                divcard[i].style.display = "";
            }else{
                divcard[i].style.display = "none";
            }

        }               
       })
    




// function filter(){
//     for(var i=0; i<option.length; i++){
//         let divfetch = document.getElementsByClassName("card-body")[1].getElementsByTagName("p");
//         if(option[i]==divfetch[0]){
//             let divcard = document.getElementsByClassName("card");
//             divcard[i].style.display = "";
//         }else{
//             divcard[i].style.display = "none";
//         }        
//     }
// }

          

