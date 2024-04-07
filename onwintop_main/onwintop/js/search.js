$(document).ready(function(){
    $('#search').on('submit',function(e){
        e.preventDefault();
        search_text=$('#search-text').val();
        alert(search_text);
    })
})