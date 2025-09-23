const nombre = document.getElementById("nombre");
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
  } else if (salarioNumero < 1000 && edadNumero < 30 && hijosNumero === 0) {
    salarioNumero += salarioNumero * 0.05;
  } else if (edadNumero >= 30 && edadNumero <= 45) {
    if (salarioNumero < 1250 && hijosNumero > 1 && hijosNumero < 3) {
      salarioNumero += salarioNumero * 0.1;
    } else if (salarioNumero < 1250 && hijosNumero >= 3) {
      salarioNumero += salarioNumero * 0.15;
    }
  } else if (edadNumero > 45) {
    if (salarioNumero < 2000) {
      salarioNumero += salarioNumero * 0.15;
    }
    
  }

  salarioNuevo.textContent = salarioNumero + " " + nombre.value;
  salarioNuevo.textContent = "Hola " + nombre.value + ", tu saldo actual es de " + salario.value + "€. Tu nuevo saldo es de " + salarioNumero + "€." 
}
