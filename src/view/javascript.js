function checkbox_js(idTask) {
  checkbox = document.getElementById(idTask);
  url = window.location.href.split("src")[0] + "src/?action=";
  if (checkbox.checked) {
    window.location = url + "v-check_task&task=" + idTask;
  } else {
    window.location = url + "v-uncheck_task&task=" + idTask;
  }
}
