function validateMyForm(){
    return false;
}

function view(clicked){
    var id = clicked.getAttribute('data-id');
    location.assign('viewServices.php?uid=' + encodeURIComponent(id));
}