function toggleVideo(){
    var checkInput = document.querySelector('#cadastroCheck');

    var episodioElement = document.querySelector('#episodio');
    var thumbElement = document.querySelector('#thumb');
    if(checkInput.checked){
        episodioElement.disabled = true;
        thumbElement.disabled = true;
    }else {
        episodioElement.disabled = false;
        thumbElement.disabled = false;
    }
}