// shows / hides appropriate form based on selection
// called on change

function formSelect() {
  // get new value
  form = document.getElementById('form-select');
  value = form.options[form.selectedIndex].value;

  // show post search, hide image
  if (value == "post") {
    document.getElementById('image').style.display="none";
    document.getElementById('post').style.display="inline";
  }
  // show image search, hide post
  else if (value == "image") {
    document.getElementById('post').style.display="none";
    document.getElementById('image').style.display="inline";
  }
}
