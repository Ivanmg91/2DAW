// HACER CON PROMT TAMBIEN. Ej: let nombre = prompt("Nombre:"); 

const salario = document.getElementById("salario");
const edad = document.getElementById("edad");
const hijos = document.getElementById("hijos");
const salarioNuevo = document.getElementById("salarioNuevo");

function calcularSalarioNuevo() {
  let salarioNumero = Number(salario.value);
  const edadNumero = Number(edad.value);
  const hijosNumero = Number(hijos.value);

  if (salarioNumero < 1000 && edadNumero < 30 && hijosNumero > 0) {
    salarioNumero = 1200;
  }

  if (salarioNumero < 1000 && edadNumero < 30 && hijosNumero == 0) {
    salarioNumero += salarioNumero * 0.05;
  }

  if (edadNumero >= 30 ) {
    
  }
  salarioNuevo.textContent = salarioNumero; 
}