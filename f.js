//search-box
function search(){

}
//customdropdown

function house1(){
  location.href="/property1.html";
}
function house2(){
  location.href="";
}
function house3(){
  location.href=" ";
}
function house4(){
  location.href=" ";
}

function house6(){
  location.href=" ";
}
function house7(){
  location.href=" ";
}
function house8(){
  location.href="";
}
function rent()
{
  location.href="/rent"
}
var modalBtns = [...document.querySelectorAll(".pg")];
modalBtns.forEach(function(btn){
btn.onclick = function() {
var modal = btn.getAttribute('data-modal3');
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
var modalBtns = [...document.querySelectorAll(".button")];
modalBtns.forEach(function(btn){
btn.onclick = function() {
var modal = btn.getAttribute('data-modal');
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
var modalBtns = [...document.querySelectorAll(".sign-in")];
modalBtns.forEach(function(btn){
btn.onclick = function() {
var modal = btn.getAttribute('data-modal2');
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

/*let enquire = document.getElementById("enquire");
enquire.addEventListener('click', function sellprop(){
    let name2 = document.getElementById("name2");
    let email2 = document.getElementById("email2");
    let number2 = document.getElementById("number2");
    let address = document.getElementById("address");
    let budjet = document.getElementById("budjet");
    let accom = document.getElementById("accom");
    let area = document.getElementById("area");
    let availability = document.getElementById("avl");
    let parks = document.getElementById("parks");
    let gyms = document.getElementById("gyms");
    let swimming = document.getElementById("swimming");
    let parking = document.getElementById("parking");
    let malls = document.getElementById("malls");
    let store = localStorage.getItem('notes'); 
    let objInfo ={
       name: name2.value,
       email: email2.value,
       number: number2.value,
       address: address.value,
       budjet: budjet.value,
       accom: accom.value,
       area: area.value
    }
    
})*/

function link() {
  location.href = "property1.html";
}

    let newElement = document.createElement('div');
    newElement.className = "card";
    let insert = document.querySelector('section.props');
    insert.appendChild(newElement);
    console.log(insert);
    console.log(newElement);


