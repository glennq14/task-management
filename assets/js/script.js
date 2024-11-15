function confirm_before_delete(id, name) {
  if (confirm("Are you sure you want to delete this task \""+name+"\"?")) {
    return true;
  } else {
    return false;
  }
}
