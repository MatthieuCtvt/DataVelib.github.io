
$(document).ready(function() {
    $(".intituleItem").each(function() {
        $(this).mouseenter(function() {
            $(this).nextAll(".sousMenuItem").slideDown("slow");
        });
        // Pour cacher les menus. 0 correspond au nombre de millisecondes, donc c'est instantanné
        $(this).nextAll(".sousMenuItem").slideUp(0);
    });
    $(".menuItem").each(function() {
        $(this).mouseleave(function() {
            $(this).children(".sousMenuItem").slideUp("slow");
        });
    });
});

$(function() {
    $("#pop1").popover();
});
$(function() {
    $("#pop2").popover();
});

$(document).ready(function() {
    $("#changermdp").hide();
    $("#changermdpclick").click(function() {
        $("#changermdp").toggle("slow");
    });
    $("#changerinfo").hide();
    $("#changerinfoclick").click(function() {
        $("#changerinfo").toggle("slow");
    });
    $("#changerProfilPic").hide();
    $("#changerProfilPicclick").click(function() {
        $("#changerProfilPic").toggle("slow");
    });
    $("#commentCaMarcheConducteur").hide();
    $("#commentCaMarcheConducteurclick").click(function() {
        $("#commentCaMarcheConducteur").toggle("slow");
    });
    $("#commentCaMarchePassager").hide();
    $("#commentCaMarchePassagerclick").click(function() {
        $("#commentCaMarchePassager").toggle("slow");
    });
    $("#charteBonneConduite").hide();
    $("#charteBonneConduiteclick").click(function() {
        $("#charteBonneConduite").slideToggle("slow");
    });
    $("#trajetfutur1").hide();
    $("#trajetfutur2").hide();
    $("#trajetfuturclick").click(function() {
        $("#trajetfutur1").slideToggle("slow");
        $("#trajetfutur2").slideToggle("slow");
    });
    
    $("#trajetpasse1").hide();
    $("#trajetpasse2").hide();
    $("#trajetpasseclick").click(function() {
        $("#trajetpasse1").slideToggle("slow");
        $("#trajetpasse2").slideToggle("slow");
    });
     
});

function togglefut(i) {

        $("#trajetfutur1" + i).hide();
        $("#trajetfutur2" + i).hide();
        $("#trajetfuturclick" + i).click(function() {
            $("#trajetfutur1" + i).slideToggle("slow");
            $("#trajetfutur2" + i).slideToggle("slow");
        });


    }
function togglepasse(i) {

        $("#trajetpasse1" + i).hide();
        $("#trajetpasse2" + i).hide();
        $("#trajetpasseclick" + i).click(function() {
            $("#trajetpasse1" + i).slideToggle("slow");
            $("#trajetpasse2" + i).slideToggle("slow");
        });


    }
    
function toggletrip(i) {

        $("#trip" + i).hide();
        $("#clac" + i).click(function() {
            $("#trip" + i).toggle("slow");
        });


    }
    
// Pour le profil :

$(document).ready(function() {
    var panels = $('.user-infos');
    var panelsButton = $('.dropdown-user');
    panels.hide();

    //Click dropdown
    panelsButton.click(function() {
        //get data-for attribute
        var dataFor = $(this).attr('data-for');
        var idFor = $(dataFor);

        //current button
        var currentButton = $(this);
        idFor.slideToggle(400, function() {
            //Completed slidetoggle
            if(idFor.is(':visible'))
            {
                currentButton.html('<i class="glyphicon glyphicon-chevron-up text-muted"></i>');
            }
            else
            {
                currentButton.html('<i class="glyphicon glyphicon-chevron-down text-muted"></i>');
            }
        });
    });
    
    $('[data-toggle="tooltip"]').tooltip();

});


//Register

$(function () {
    $('.button-checkbox').each(function () {

        // Settings
        var $widget = $(this),
            $button = $widget.find('button'),
            $checkbox = $widget.find('input:checkbox'),
            color = $button.data('color'),
            settings = {
                on: {
                    icon: 'glyphicon glyphicon-check'
                },
                off: {
                    icon: 'glyphicon glyphicon-unchecked'
                }
            };

        // Event Handlers
        $button.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $button.data('state', (isChecked) ? "on" : "off");



            // Update the button's color
            if (isChecked) {
                $button
                    .removeClass('btn-default')
                    .addClass('btn-' + color + ' active');
            }
            else {
                $button
                    .removeClass('btn-' + color + ' active')
                    .addClass('btn-default');
            }
        }

        // Initialization
        function init() {

            updateDisplay();

        }
        init();
    });
});

  
  
//Info :

$(document).ready(function() {
    $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });
});

$(document).ready(function() {
   $('#search').keyup(function() {

       var search = $(this).val();

       search = $.trim(search);

       //$('#resultat').text(search);
       

       if (search !== "")
       {
           $('#loader').show();
           $.post('scripts/search.php', {search: search}, function(data) {

               $('#resultat ').html(data);
               $('#loader').hide();

           });
           
       }
       
       else{
           $('#resultat ').html(null);
       }
   });
});

$(function() {
    $( "#input_date" ).datepicker({ dateFormat: 'yy-mm-dd', dateFormat: 'yy-mm-dd', changeMonth: true,
      changeYear: true, yearRange: "-1:+1"});
          
  });
  
  $(function() {
    $( "#input_naissance" ).datepicker({ defaultDate: "1990-01-01", dateFormat: 'yy-mm-dd', changeMonth: true,
      changeYear: true, yearRange: "-100:-10"});
          
  });
  
  jQuery(function($){
		$.datepicker.regional['fr'] = {
                        
			closeText: 'Fermer',
			prevText: '&#x3c;Préc',
			nextText: 'Suiv&#x3e;',
			currentText: 'Courant',
			monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
			'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
			monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun',
			'Jul','Aoû','Sep','Oct','Nov','Déc'],
			dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
			dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
			dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
			weekHeader: 'Sm',
			dateFormat: 'dd/mm/yy',
			firstDay: 1,
			isRTL: false,
			showMonthAfterYear: false,
			yearSuffix: ''};
                    
                    

		$.datepicker.setDefaults($.datepicker.regional['fr']);
                

	});