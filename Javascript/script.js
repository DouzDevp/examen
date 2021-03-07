//logout : session destroy
if(document.getElementById("destroy_session")){
    document.getElementById("destroy_session").addEventListener("click", function() {
    document.getElementById('logout_hidden').value = 1;
    document.getElementById('form_session_destroy').submit();
});
}


//Scroll
$(window).on("scroll", function() {
	var scrollHeight = $(document).height();
	var scrollPosition = $(window).height() + $(window).scrollTop();
            
    // ! rarement pile = 0
if ((scrollHeight - scrollPosition) / scrollHeight < 0.0001) {
       
        // when scroll to bottom of the page
        $.ajax({
            // recup id du dernier element
            url: "../library/load.php?last_date_in_article=" + $('.post:last').attr('date') +'&id_category='+ $('.post:last').attr('category'),
            beforeSend: function(){$("#loader").show();},
            success: function(html){
                if(html){
                    $(".content").append(html);
                    $("#loader").hide();

                }else{
                    $("#loader").hide();  
                }
            }

        });
	}
});

// share on social media
document.addEventListener('DOMContentLoaded', function() {
    var els = document.getElementsByClassName("JSrslink");
    var heightScreen = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
    var widthScreen = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    Array.prototype.forEach.call(els, function(el) {
        el.addEventListener("click", function(e) {
            e.stopPropagation();
            e.preventDefault();
            var width = 320,
                height = 400,
                left = (widthScreen - width) / 2,
                top = (heightScreen - height) / 2,
                url = this.href,
                opts = 'status=1' +
                ',width=' + width +
                ',height=' + height +
                ',top=' + top +
                ',left=' + left;
            window.open(url, 'myWindow', opts);
            return false;
        });
    });
});

// copy url
var $temp = $("<input>");
var $url = $(location).attr('href');

$('.clipboard').on('click', function() {
  $("body").append($temp);
  $temp.val($url).select();
  document.execCommand("copy");
  $temp.remove();
  alert("L'adresse de la page a bien été copié !");
});


// copy list contacts
var button = document.getElementById("copy_contacts");
var input = document.getElementById("copy");

button.addEventListener("click", function(event) {
    event.preventDefault();
    input.select();
    document.execCommand("copy");    
    alert("La liste des contacts a bien été copiée !");
});

