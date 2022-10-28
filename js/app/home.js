$(document).ready(function() {
    
});
function cekHarga(){
    var besar70=$('input[name="umur70"]:checked').val();
    var kategoripesertaid=$('input[name="kategoripesertaid"]:checked').val();
    var searchIDs = $('input:checked').map(function(){

        return $(this).val();
  
    });
    alert(searchIDs);
}