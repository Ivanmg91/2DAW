document.getElementById("parrafo").style.color = "blue";
document.getElementsByClassName("parrafo2")[0].style.color = "red";
document.getElementsByTagName('p')[2].style.color = "yellow";
document.querySelector('.contenedor2').style.backgroundColor = "black";
document.querySelectorAll('.contenedores')[0].style.backgroundColor = "blue";

document.getElementById('innerText').innerText = "Aquí usamos innerText";
const oculto = document.getElementById('textContent').textContent = "Aquí usamos textContent";
document.getElementById('innerHTML').innerHTML = "Aquí usamos <strong>textContent</strong>";

console.log(oculto);