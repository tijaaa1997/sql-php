
function kreirajP () {
   
    const p2 = document.createElement('p');

    p2.innerHTML = "paragraph 2";
    
    const elem = document.getElementById("p1");
  
    elem.parentNode.appendChild(p2);
}