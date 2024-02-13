//Take the name of the file
var ubicacionCompleta = window.location.href;
var url = new URL(ubicacionCompleta);
var nombreDeArchivo = url.pathname.substring(url.pathname.lastIndexOf('/') + 1) + url.search;

//Categories
function busquedaCategory(searchValue) {
  return new Promise((resolve, reject) => {
    $.ajax({
      type: 'POST',
      url: 'index.php?controller=Category&action=search',
      data: { search: searchValue },
      success: function (response) {
        resolve(response);
      },
      error: function () {
        reject(new Error('Error in the request with AJAX'));
      }
    });
  });
}
  
if (nombreDeArchivo == 'index.php?controller=Category&action=categoriesAdmin') {
  $(document).ready(function () {
    $('#search').keyup(function () {
      var searchValue = $(this).val();

      busquedaCategory(searchValue)
        .then((response) => {
          $('#bodyList').html(response);
        })
        .catch((error) => {
          alert(error.message);
        });
    });
  });
}

//Products
function busquedaProduct(searchValue) {
  return new Promise((resolve, reject) => {
    $.ajax({
      type: 'POST',
      url: 'index.php?controller=Product&action=search',
      data: { search: searchValue },
      success: function (response) {
        resolve(response);
      },
      error: function () {
        reject(new Error('Error in the request with AJAX'));
      }
    });
  });
}
  
if (nombreDeArchivo == 'index.php?controller=Product&action=productsAdmin') {
  $(document).ready(function () {
    $('#search').keyup(function () {
      var searchValue = $(this).val();

      busquedaProduct(searchValue)
        .then((response) => {
          $('#bodyList').html(response);
        })
        .catch((error) => {
          alert(error.message);
        });
    });
  });
}

//Main
function busquedaProduct2(searchValue) {
  return new Promise((resolve, reject) => {
    if (searchValue.trim() === '') {
      // Si está vacío, resolvemos la promesa con un string vacío
      resolve('');
    } else {
      $.ajax({
        type: 'POST',
        url: 'index.php?controller=Product&action=search2',
        data: { search2: searchValue },
        success: function (response) {
          resolve(response);
        },
        error: function () {
          reject(new Error('Error in the request with AJAX'));
        }
      });
    }
  });
}
  
if (nombreDeArchivo == 'index.php?controller=Product&action=principal' || nombreDeArchivo == '' || nombreDeArchivo.includes('index.php?controller=Product&action=buyProduct') || nombreDeArchivo == 'index.php?controller=Product&action=products' || nombreDeArchivo == 'index.php?controller=Category&action=categories' || nombreDeArchivo.includes('index.php?controller=Product&action=singleCategory') || nombreDeArchivo == 'index.php?controller=Product&action=plateart') {
  $(document).ready(function () {
    $('#search').keyup(function () {
      var searchValue = $(this).val();
      
      busquedaProduct2(searchValue)
        .then((response) => {
          $('#bodyList').html(response);
        })
        .catch((error) => {
          alert(error.message);
        });
    });
  });
}