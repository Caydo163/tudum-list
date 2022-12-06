function checkbox_js(idTask) {
    checkbox = document.getElementById(idTask);
    // TODO : nettoyer url
    if(checkbox.checked) {
        console.log("checked");
        window.location = window.location.href + 'v-valid_task&task=' + idTask + '&achieve=true';
    } else {
        console.log("not checked");
        window.location = window.location.href + 'v-valid_task&task=' + idTask + '&achieve=false';
    }
}