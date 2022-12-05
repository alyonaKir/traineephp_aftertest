$(document).ready(function(){
    if(localStorage.getItem('flag')){
        $('#select_all').prop('checked',true);
    }
    var allCheck = document.getElementById('select_all');
    alert(allCheck.checked);
    if(allCheck.checked === true){
        localStorage.setItem('flag', true);
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
            localStorage.setItem('flag', false);
            $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    }

    // $('#select_all').on('click',function(){
    //     if(this.checked){
    //         $('.checkbox').each(function(){
    //             localStorage.setItem('flag', true);
    //             this.checked = true;
    //         });
    //     }else{
    //         localStorage.setItem('flag', false);
    //         $('.checkbox').each(function(){
    //             this.checked = false;
    //         });
    //     }
    // });
    // $('.checkbox').on('click',function(){
    //     if($('.checkbox:checked').length == $('.checkbox').length){
    //         $('#select_all').prop('checked',true);
    //     }else{
    //         $('#select_all').prop('checked',false);
    //     }
    // });
});