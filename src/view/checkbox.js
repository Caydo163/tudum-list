function checkbox_js(idTask, role) {
  role = role == "visitor" ? "" : role + "/";
  checkbox = document.getElementById(idTask);
  url = window.location.href.split("src")[0] + "src/" + role;
  if (checkbox.checked) {
    window.location = url + "checkTask/" + idTask;
  } else {
    window.location = url + "uncheckTask/" + idTask;
  }
}
