function checkbox_js(idTask, $role) {
  checkbox = document.getElementById(idTask);
  url = window.location.href.split("src")[0] + "src/?action=";
  if (checkbox.checked) {
    window.location = url + $role + "-check_task&task=" + idTask;
  } else {
    window.location = url + $role + "-uncheck_task&task=" + idTask;
  }
}
