function confirmDelete() {
    if (confirm('Are you sure you want to delete this?') == true) {
      // user clicked OK so execute the link
      return true;
    }else{
      // user clicked Cancel so stop execution
      return false;
    }
  }

function passwordMatch() {
  let password = document.getElementById('password').value;
  let ok = document.getElementById('confirm').value;
  let Error = document.getElementById('Error');

  if (password != ok){
    Error.innerText = 'Passwords do not match';
    return false;
  }
  else{
    Error.innerText = '';
    return true;
  }
}

function showHidePass(){
  let Input = document.getElementById('password');
  let img = document.getElementById('showHide');

  if(Input.type == 'password'){
    Input.type = 'text';
    img.src = 'images/hide.png';
  }else{
    Input.type = 'password';
    img.src = 'images/show.png';
  }
}