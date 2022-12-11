document.addEventListener("show.bs.modal", (event) => {
  const button = event.relatedTarget;
  const recipient = button.getAttribute("data-bs-whatever");
  p = document.getElementById("popup_message");
  a = document.getElementById("removeURL");
  p.innerText = `Voulez-vous vraiment supprimer le compte de ${recipient} ?`;
  a.href = `?action=a-remove_user&delete_login=${recipient}`;
});
