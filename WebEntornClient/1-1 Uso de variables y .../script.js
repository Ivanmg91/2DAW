const num1 = 1;
const num2 = 2;
let num3 = 9;

let sum = num1 + num1 + num3;
let bool = Boolean(sum > 10);

document.getElementById("num1Display").innerHTML = num1;
document.getElementById("num2Display").innerHTML = num2;
document.getElementById("num3Display").innerHTML = num3;

document.getElementById("resultDisplay").innerHTML = sum;

document.getElementById("isOverTen").innerHTML = bool;