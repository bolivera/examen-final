$("#slider-range").slider({
    range: true,
    min: 0,
    max: 1000,
    step: 50,
    slide: function (event, ui) {
      $("#min-price").html(ui.values[0]);
  
      console.log(ui.values[0]);
  
      suffix = "";
      if (ui.values[1] == $("#max-price").data("max")) {
        suffix = " +";
      }
      $("#max-price").html(ui.values[1] + suffix);
    }
  });

//agrega y quita la clase active en el detalle del producto

let buttons2 = document.querySelectorAll(".btn-colour");

buttons2.forEach(button =>{
  button.addEventListener("click",_ =>{
    buttons2.forEach(button =>{
      button.classList.remove("active");
    })
    button.classList.toggle("active");
  })
})
  