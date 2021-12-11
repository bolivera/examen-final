const prevPage = (event, current_page) => {
    event.preventDefault();
    let number_page = 'page=' + (current_page - 1);
    let route = document.querySelectorAll("[data-result]");
    let url = '';
    route.forEach(function(valor) {
        url += valor.dataset.result + '&'
    });
    let new_route = ''
   
    new_route = '/todos-los-productos/?' + url.substring(0, url.length - 1) + '&' + number_page
    
    window.location.replace(new_route)
    localStorage.setItem('page', number_page)
}


const chnagePageWitchCriteria = (event) => {
    
    event.preventDefault();
    let number = event.target.dataset.page;
    let number_page = 'page=' + number;
    let route = document.querySelectorAll("[data-result]");
    let url = '';
    route.forEach(function(valor) {
        url += valor.dataset.result + '&'
    });
    let new_route = ''
    
    new_route = '/todos-los-productos/?' + url.substring(0, url.length - 1) + '&' + number_page
    
    window.location.replace(new_route)
    localStorage.setItem('page', number_page)
}

const nextPage = (event, current_page) => {
    event.preventDefault();
    let number_page = 'page=' + (current_page + 1);
    let route = document.querySelectorAll("[data-result]");
    let url = '';
    route.forEach(function(valor) {
        url += valor.dataset.result + '&'
    });
    let new_route = ''
    
    new_route = '/todos-los-productos/?' + url.substring(0, url.length - 1) + '&' + number_page

    window.location.replace(new_route)
    localStorage.setItem('page', number_page)
}

function validatePaginate() {
    const init_page = 1;
    const stop = parseInt(document.getElementById('stop_pagination').value);
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const page = parseInt(urlParams.get('page'))
        //1 < page > stop
    if (page > 1 && page < stop) {
        console.log("<->")
        document.getElementById('next_page').style.visibility = 'visible'
        document.getElementById('prev_page').style.visibility = 'visible'
    } else if (page < stop && page == 1) {
        console.log("<-")
        document.getElementById('next_page').style.visibility = 'visible'
        document.getElementById('prev_page').style.visibility = 'hidden'
    } else if (page > init_page && page == stop) {
        document.getElementById('prev_page').style.visibility = 'visible'
        document.getElementById('next_page').style.visibility = 'hidden'
    } else {
        console.log("-")
        document.getElementById('next_page').style.visibility = 'hidden'
        document.getElementById('prev_page').style.visibility = 'hidden'
    }
    /* console.log(init_page);
    console.log(page);
    console.log(stop); */
    // console.log("entro 2");
}

if (window.location.pathname === '/todos-los-productos/') {
    validatePaginate()
}