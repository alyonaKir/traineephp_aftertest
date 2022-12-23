function deleletconfig() {
    var del = confirm("Are you sure you want to delete this record?");
    if (del === true) {
        alert("Record will be deleted")
    } else {
        alert("Record will Not be Deleted")
    }
    return del;
}


