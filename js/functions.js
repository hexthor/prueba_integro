$(document).ready(function(){
    $('input[type="text"], input[type="password"]').on('focus', function () {
        $(this).tooltip('hide');
    })
});

function hideTooltip(campo){
    $("#" + campo).tooltip('hide');
}

function userValidation(){
    var user = $("#inputUser").val();
    var pass = $("#inputPassword").val();
    if( user.length == 0 ){
        $('#inputUser').attr('data-toggle', 'tooltip').attr('data-placement', 'right').attr('title', 'Ingrese el usuario').tooltip({trigger: 'manual'}).tooltip('show');
        return;
    }

    if( pass.length == 0 ){
        $('#inputPassword').attr('data-toggle', 'tooltip').attr('data-placement', 'right').attr('title', 'Ingrese la contraseña').tooltip({trigger: 'manual'}).tooltip('show');
        return;
    }

    $.ajax({
		url : 'functions.php?function=validarUsuario&user=' + user + '&pass=' + pass,
		success: function(data){
            var datos = eval("(" + data + ")" );
            if(datos["resultado"] == false){
                alert(datos["mensaje"]);
            }else{
                window.location.href = 'movies.php';
            }
		}
	});
}

function loadTable(type){
    $.ajax({
		url : 'functions.php?function=loadTable&type=' + type,
		success: function(data){
            $("#table_" + type).html(data);
		}
	});
}

function logout(){
    if(confirm('¿Desea cerrar sesión?')){
        window.location.href = 'functions.php?function=logout';
    }
}

function closeTable(){
    $("#img_add").show();
    $("#img_close").hide();
    $("#table_add").html("");
}

function editBean(type, id = ""){
    $("#edit_" + id).hide();
    $("#save_" + id).show();

    if(id.length == 0){
        $("#img_add").hide();
        $("#img_close").show();
        $.ajax({
            url : 'functions.php?function=addBean&type=' + type,
            success: function(data){
                $("#table_add").html(data);
            }
        });
    }else{
        $("span[id='pass_thead']").show();
        $("span[id*='"+ id +"']").hide();
        $("input[id*='"+ id +"'], textarea[id*='"+ id +"']").show();
    }
}

function saveBean(type, id = ""){
    switch(type){
        case "movies":
            var current_year = new Date().getFullYear();
            if(id.length == 0){
                var title_input = "movie_title";
                var synopsis_input = "movie_synopsis";
                var year_input = "movie_year";
            }else{
                var title_input = "title_input_" + id;
                var synopsis_input = "synopsis_input_" + id;
                var year_input = "year_input_" + id;
            }

            if( $("#" + title_input).val().length == 0 ){
                $('#' + title_input).attr('data-toggle', 'tooltip').attr('data-placement', 'right').attr('title', 'Ingrese el título').tooltip({trigger: 'manual'}).tooltip('show');
                return;
            }

            if( $("#" + year_input).val().length == 0 ){
                $("#" + year_input).attr('data-toggle', 'tooltip').attr('data-placement', 'right').attr('title', 'Ingrese el año').tooltip({trigger: 'manual'}).tooltip('show');
                return;
            }

            if( $("#" + year_input).val() > current_year){
                $("#" + year_input).attr('data-toggle', 'tooltip').attr('data-placement', 'right').attr('title', 'No puede ser mayor al actual').tooltip({trigger: 'manual'}).tooltip('show');
                return;
            }

            $.ajax({
                url : 'functions.php?function=saveBean&type=' + type + '&id=' + id + '&title=' + $("#" + title_input).val() + '&synopsis=' + $("#" + synopsis_input).val() + '&year=' + $("#" + year_input).val(),
                async: false,
                success: function(data){
                    //console.log("prueba");
                }
            });
            break;
        
        case "users":
            if(id.length == 0){
                var name_input = "user_fullname";
                var nickname_input = "user_nickname";
                var password_input = "user_password";
                var password_input2 = "user_password2";
            }else{
                var name_input = "fullname_input_" + id;
                var nickname_input = "nickname_input_" + id;
                var password_input = "pass_input_" + id;
                var password_input2 = "pass2_input_" + id;
            }

            if( $("#" + name_input).val().length == 0 || $("#" + name_input).val().length < 5 ){
                $("#" + name_input).attr('data-toggle', 'tooltip').attr('data-placement', 'right').attr('title', 'Debe tener 5 caracteres como mínimo').tooltip({trigger: 'manual'}).tooltip('show');
                return;
            }

            var patt = /^[a-z]([0-9a-z_])+$/i;
            if(! patt.test($("#" + nickname_input).val()) || $("#" + nickname_input).val().length == 0 ){
                $("#" + nickname_input).attr('data-toggle', 'tooltip').attr('data-placement', 'right').attr('title', 'Campo requerido. Solo se permiten letras, números y guión al piso').tooltip({trigger: 'manual'}).tooltip('show');
                return;
            }

            var patt2 = /^(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
            if( ! patt2.test($("#" + password_input).val()) || $("#" + password_input).val().length == 0 ){
                $("#" + password_input).attr('data-toggle', 'tooltip').attr('data-placement', 'right').attr('title', 'Campo requerido. Debe contener mínimo una mayúscula y un número').tooltip({trigger: 'manual'}).tooltip('show');
                return;
            }

            if( $("#" + password_input).val() != $("#" + password_input2).val() ){
                $("#" + password_input2).attr('data-toggle', 'tooltip').attr('data-placement', 'right').attr('title', 'Las contraseñas no coinciden').tooltip({trigger: 'manual'}).tooltip('show');
                return;
            }

            var resp = false;
            $.ajax({
                url : 'functions.php?function=validateUsername&username=' + $("#" + nickname_input).val() + '&id=' + id,
                async: false,
                success: function(data){
                    var datos = eval("(" + data + ")" );
                    if(datos["resultado"] == true){
                        alert("El campo Nickname se encuentra repetido.");
                        resp = true;
                        return false;
                    }else{
                        //Procesamos el registro
                        $.ajax({
                            url : 'functions.php?function=saveBean&type=' + type + '&id=' + id + '&name=' + $("#" + name_input).val() + '&username=' + $("#" + nickname_input).val() + '&password=' + $("#" + password_input).val() ,
                            async: false,
                            success: function(data){
                                //console.log("prueb2");
                            }
                        });
                    }
                }
            });

            if(resp){
                console.log("retornamos, nickname repetido");
                return;
            }
            break;
    }

    $("#table_add").html("");
    $("#img_close").click();
    loadTable(type);
}

function showBean(type, id = ""){
    $("#edit_" + id).show();
    $("#save_" + id).hide();

    if(id.length > 0){
        $("span[id='pass_thead']").hide();
        $("span[id*='"+ id +"']").show();
        $("input[id*='"+ id +"'], textarea[id*='"+ id +"']").hide();
    }
}

function deleteBean(type, id, title){
    if(confirm('¿Desea borrar el registro: ' + title + '?')){
        $.ajax({
            url : 'functions.php?function=deleteBean&type=' + type + '&id=' + id,
            success: function(data){
                $("#" + type + "_" + id).remove();
            }
        });
    }
}