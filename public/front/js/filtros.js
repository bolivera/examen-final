const addCriteria = (event) => {
    event.preventDefault()
 
    let name = event.target.dataset.name
    let data = event.target.getAttribute("data-" + name)
    let add_criteria = name + '=' + data;
  
    new_route = '/todos-los-productos/?' + add_criteria + '&' + 'page=' + 1
    window.location.replace(new_route)
    localStorage.setItem(name, data)
}

const keySearch= (event) => {
    if (event.keyCode === 13 && !event.shiftKey) {
        event.preventDefault()
        let name = document.getElementById("search").name;
        let data = document.getElementById("search").value;
        let add_criteria = name + '=' + data;
        new_route = '/todos-los-productos/?' + add_criteria + '&' + 'page=' + 1
        window.location.replace(new_route)
    }
}

const addSearch= (event) => {
        event.preventDefault()
        let name = document.getElementById("search").name;
        let data = document.getElementById("search").value;
        let add_criteria = name + '=' + data;
        new_route = '/todos-los-productos/?' + add_criteria + '&' + 'page=' + 1
        window.location.replace(new_route)
}


const changeCriteria = (event, page) => {
    event.preventDefault();
    let name = event.target.dataset.name;
    let data = document.getElementById(name + '-dep').value;
    let aux = '';

    let add_data = name + '=' + data;
    let route = document.querySelectorAll("[data-result]");

    let url = '';
    route.forEach(function(valor) {
        aux= valor.dataset.result
        if(aux.substring(0, 5) != "orden"){
            url += valor.dataset.result + '&'
        }
    });
    let new_route = '/todos-los-productos/?' + url.substring(0, url.length - 1) + '&' + add_data + '&' + 'page=' + page
    window.location.replace(new_route)
    
}

const changeDespacho = (event, page) =>{

    event.preventDefault();
    let despacho = event.target.dataset.name
    let route = document.querySelectorAll("[data-result]");
    let add_data_1 = 'despacho' + '=' + despacho;
    let url = '';
    let aux = '';
    let new_route = '';

    if(event.currentTarget.checked) {
        route.forEach(function(valor) {  
            aux= valor.dataset.result
            if(aux.substring(0, 8) != "despacho"){
                url += valor.dataset.result + '&' 
            }
        });
        new_route = '/todos-los-productos/?' + url.substring(0, url.length - 1) + '&' + add_data_1 + '&' + 'page=' + page  
    }
    window.location.replace(new_route)
    localStorage.setItem("despacho", despacho)
 }

 const changeCriteria_salario = (event, page) =>{
      
    event.preventDefault();
    let bandera = true;
    let precio_min =document.getElementById("min-price").innerHTML;
    let precio_max =document.getElementById("max-price").innerHTML;
    let aux = '';
  
    if(precio_min == '')
        min = 0;
    else 
        min = parseInt(precio_min);
    if(precio_max == '')
        max = 0;
    else
        max = parseInt(precio_max);  
    
    if(min !== 0 && max !==0){
    if(min > max)
        bandera= false;  
    }
    if(min == 0 && max ==0){
        bandera= false; 
    }

     if(bandera){
         let add_data_1 = 'precio_min' + '=' + precio_min;
         let add_data_2 = 'precio_max' + '=' + precio_max;
         let route = document.querySelectorAll("[data-result]");

         let url = '';

         route.forEach(function(valor) {
            aux = valor.dataset.result
            if(aux.substring(0, 10) != "precio_max" & aux.substring(0, 10) != "precio_min"){
                 url += valor.dataset.result + '&'
            }
         });

         let new_route = '/todos-los-productos/?' + url.substring(0, url.length - 1) + '&' + add_data_1 + '&' + add_data_2 + '&' + 'page=' + page
         window.location.replace(new_route)
     }else
     console.log("error");
 }


 const changeTalla = (event, page) =>{

    event.preventDefault();
    let talla = event.target.dataset.name
    let route = document.querySelectorAll("[data-result]");
    let add_data_1 = 'talla' + '=' + talla;
    let url = '';
    let aux = '';
    let new_route = '';
    let aux_1 = '';
    var aux_2 = '';
    var bandera = false;

    if(event.currentTarget.checked) {
        if( route.length != 0)
        {
            route.forEach(function(valor) {  
                aux= valor.dataset.result
                if(aux.substring(0, 5) == "talla"){
                    url += valor.dataset.result + ',' + talla + '&' 
                    bandera = true;
                }else{
                    url += valor.dataset.result + '&' 
                }
            });
            if(bandera)
                new_route = '/todos-los-productos/?' + url.substring(0, url.length - 1) + '&' + 'page=' + page
            else
                new_route = '/todos-los-productos/?' + url.substring(0, url.length - 1) + '&' + add_data_1 + '&' + 'page=' + page
        }else{
            new_route = '/todos-los-productos/?' + url.substring(0, url.length - 1) + '&' + add_data_1 + '&' + 'page=' + page
        }
    }else{
            route.forEach(function(valor) {  
                aux = valor.dataset.result
                if(aux.substring(0, 5) == "talla"){
                    aux_1 = aux.replace('talla=', '');
                    aux_2 = aux_1.split(',');
                    if(aux_2.length > 1){
                        if(aux_2[0] == talla){ 
                             url +=  aux.replace(talla+',',"") + '&';
                              }
                         else{ 
                            url +=  aux.replace(','+talla,"") + '&';
                             }
                    }  
                }else{
                    url += valor.dataset.result + '&';
                }
            });
            new_route = '/todos-los-productos/?' + url.substring(0, url.length - 1) + '&' + 'page=' + page
    }
    window.location.replace(new_route)
    localStorage.setItem("talla", talla)
 }


 const changeColor = (event, page) =>{

    event.preventDefault();
    let color = event.target.dataset.name
    let route = document.querySelectorAll("[data-result]");
    let add_data_1 = 'color' + '=' + color;
    let url = '';
    let aux = '';
    let new_route = '';
    let aux_1 = '';
    var aux_2 = '';
    var bandera = false;

    if(event.currentTarget.checked) {
        if( route.length != 0)
        {
            route.forEach(function(valor) {  
                aux= valor.dataset.result
                if(aux.substring(0, 5) == "color"){
                    url += valor.dataset.result + ',' + color + '&' 
                    bandera = true;
                }else{
                    url += valor.dataset.result + '&' 
                }
            });
            if(bandera)
                new_route = '/todos-los-productos/?' + url.substring(0, url.length - 1) + '&' + 'page=' + page
            else
                new_route = '/todos-los-productos/?' + url.substring(0, url.length - 1) + '&' + add_data_1 + '&' + 'page=' + page
        }else{
            new_route = '/todos-los-productos/?' + url.substring(0, url.length - 1) + '&' + add_data_1 + '&' + 'page=' + page
        }
    }else{
            route.forEach(function(valor) {  
                aux = valor.dataset.result
                if(aux.substring(0, 5) == "color"){
                    aux_1 = aux.replace('color=', '');
                    aux_2 = aux_1.split(',');
                    if(aux_2.length > 1){
                        if(aux_2[0] == color){ 
                             url +=  aux.replace(color+',',"") + '&';
                              }
                         else{ 
                            url +=  aux.replace(','+color,"") + '&';
                             }
                    }  
                }else{
                    url += valor.dataset.result + '&';
                }
            });
            new_route = '/todos-los-productos/?' + url.substring(0, url.length - 1) + '&' + 'page=' + page
    }
    window.location.replace(new_route)
    localStorage.setItem("color", color)
 }


//  const removeCriteria = (event, page) => {
//     event.preventDefault()
    
//     let name = event.target.dataset.name
//     if (document.getElementById(name) !== null) {
//         document.getElementById(name).remove()
//     }
//     let route = document.querySelectorAll("[data-result]");
//     let url = '';
//     route.forEach(function(valor) {
//         url += valor.dataset.result + '&'
//     });
//     let new_route = ''
    
//     new_route = '/todos-los-productos/?' + url.substring(0, url.length - 1) + '&' + 'page=' + page
    
//     window.location.replace(new_route)
//     localStorage.removeItem(name)
// }