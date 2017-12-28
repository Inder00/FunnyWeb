$(function () {
    $("#kup_teraz").click(function(){
        $(this).html("<i class='fa fa-circle-o-notch fa-spin'></i> Kupowanie...");

        var id = $.trim($('#uid_payment').val());
        var nickname = $.trim($('#nickname').val());
        var smscode = $.trim($('#smscode').val());
        if(id.length > 0 && nickname.length > 0 && smscode.length > 0){

            if(smscode.length == 8){

                $.ajax({
					type: "POST",
					url: "../application/ajax/check_payment.php",
					data: "id="+id+"&nickname="+nickname+"&smscode="+smscode,
					dataType: "html",
					success: function(data){
						switch (data) {
                            case "ERR_NO_VALUES":
                                $("#kup_teraz").html('<i class="fa fa-shopping-cart"></i> Kup teraz');
                                error("Spróbuj ponownie. Wypełnij wszystkie pola, a następnie kliknij <strong>Kup teraz</strong>!");
                                break;
                            case "SERVER_OFFLINE":
                                $("#kup_teraz").html('<i class="fa fa-shopping-cart"></i> Kup teraz');
                                error("Serwer jest aktualnie offline. Zachowaj kod SMS i spróbuj ponownie później!");
                                break;
                            case "PURCHASED":
                                $("#kup_teraz").html('<i class="fa fa-check"></i> Zakupiono');
                                success("Zakup przebiegł pomylśnie, zakupiona usługa zostanie dodana w ciągu kilku sekund. Dziękujemy za wsparcie!");
                                break;
                            case "ERR_BAD_CODE":
                                $("#kup_teraz").html('<i class="fa fa-shopping-cart"></i> Kup teraz');
                                error("Podany kod z smsa jest nieprawidłowy. Spróbuj ponownie przepisując go zwracając uwagę na każdą literę, cyfrę!");
                                break;
                        default:
                            $("#kup_teraz").html('<i class="fa fa-shopping-cart"></i> Kup teraz');
                            error(data);
                            break;
                        }
					}
				});

            } else {
                $("#kup_teraz").html('<i class="fa fa-shopping-cart"></i> Kup teraz');
                error("Podany kod z smsa jest nieprawidłowy. Spróbuj ponownie przepisując go zwracając uwagę na każdą literę, cyfrę!");
            }

        } else {
            $("#kup_teraz").html('<i class="fa fa-shopping-cart"></i> Kup teraz');
            error("Spróbuj ponownie. Wypełnij wszystkie pola, a następnie kliknij <strong>Kup teraz</strong>!");
        }
    });
});
function success(text){

    $("#success").show(0);
    $("#success_html").html(text);

}
function error(text){

    $("#error").show(0);
    $("#error_html").html(text);
    setTimeout(function(){

        $("#error").hide(0);

    },10000);

}
