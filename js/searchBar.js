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
  
if (nombreDeArchivo == 'index.php?controller=Category&action=categories') {
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
function busquedaCategory(searchValue) {
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
  
if (nombreDeArchivo == 'index.php?controller=Product&action=products') {
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