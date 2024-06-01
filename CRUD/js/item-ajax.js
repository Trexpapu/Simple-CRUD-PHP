$( document ).ready(function() {


    var page = 1;
    var current_page = 1;
    var total_page = 0;
    var is_ajax_fire = 0;
    
    
    manageData();
    
    
    /* manage data list */
    function manageData() {
        $.ajax({
            dataType: 'json',
            url: url+'CRUD/api/getData.php',
            data: {page:page}
        }).done(function(data){
            total_page = Math.ceil(data.total/10);
            current_page = page;
    
    
            $('#pagination').twbsPagination({
                totalPages: total_page,
                visiblePages: current_page,
                onPageClick: function (event, pageL) {
                    page = pageL;
                    if(is_ajax_fire != 0){
                      getPageData();
                    }
                }
            });
    
    
            manageRow(data.data);
            is_ajax_fire = 1;
    
    
        });
    
    
    }
    
    
    /* Get Page Data*/
    function getPageData() {
        $.ajax({
            dataType: 'json',
            url: url+'CRUD/api/getData.php',
            data: {page:page}
        }).done(function(data){
            manageRow(data.data);
        });
    }
    
    
    /* Add new Item table row */
    function manageRow(data) {
        var	rows = '';
        $.each( data, function( key, value ) {
              rows = rows + '<tr>';
              rows = rows + '<td>'+value.articulo+'</td>';
              rows = rows + '<td>'+value.descripcion+'</td>';
              rows = rows + '<td data-id="'+value.id+'">';
            rows = rows + '<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Editar</button> ';
            rows = rows + '<button class="btn btn-danger remove-item">Borrar</button>';
            rows = rows + '</td>';
              rows = rows + '</tr>';
        });
    
    
        $("tbody").html(rows);
    }
    
    
   
    
    
    
    /* Remove Item */
    $("body").on("click",".remove-item",function(){
        var id = $(this).parent("td").data('id');
        var c_obj = $(this).parents("tr");
    
    
        $.ajax({
            dataType: 'json',
            type:'POST',
            url: url + 'CRUD/api/delete.php',
            data:{id:id}
        }).done(function(data){
            c_obj.remove();
            toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 5000});
            getPageData();
        });
    
    
    });
    
    
    /* Edit Item */
    $("body").on("click",".edit-item",function(){
    
    
        var id = $(this).parent("td").data('id');
        var title = $(this).parent("td").prev("td").prev("td").text();
        var descripcion = $(this).parent("td").prev("td").text();
    
    
        $("#edit-item").find("input[name='title']").val(title);
        $("#edit-item").find("textarea[name='descripcion']").val(descripcion);
        $("#edit-item").find(".edit-id").val(id);
    
    
    });
    
    
    /* Updated new Item */
    $(".crud-submit-edit").click(function(e){
    
    
        e.preventDefault();
        var form_action = $("#edit-item").find("form").attr("action");
        var title = $("#edit-item").find("input[name='title']").val();
    
    
        var descripcion = $("#edit-item").find("textarea[name='descripcion']").val();
        var id = $("#edit-item").find(".edit-id").val();
    
    
        if(title != '' && descripcion != ''){
            $.ajax({
                dataType: 'json',
                type:'POST',
                url: url+'CRUD/api/update.php',
                data:{title:title, descripcion:descripcion,id:id}
            }).done(function(data){
                getPageData();
                $(".modal").modal('hide');
                toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 5000});
            });
        }else{
            alert('You are missing title or descripcion.')
        }
    
    
    });
});