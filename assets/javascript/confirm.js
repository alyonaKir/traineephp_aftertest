function deleletconfig() {
    var del = confirm("Are you sure you want to delete this record?");
    if (del === true) {
        alert("Record deleted")
    } else {
        alert("Record Not Deleted")
    }
    return del;
}
