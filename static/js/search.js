function formSelect() {
  form = document.getElementById('form-select');
  value = form.options[form.selectedIndex].value;

  if (value == "post") {
    document.getElementById('image').style.display="none";
    document.getElementById('post').style.display="inline";
  }
  else if (value == "image") {
    document.getElementById('post').style.display="none";
    document.getElementById('image').style.display="inline";
  }
}
