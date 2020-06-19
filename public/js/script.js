(function(window,document,$){
    $(function(){
        'use strict';

// Hamburger Menu*******************************************************************************************
        $('#menu').on('click',function(){
            $("#menu")[0].classList.toggle("change");
            $("#navi")[0].classList.toggle("change");
        });

// resize -  erstmal nich ************************************************************************************
        // function sizeContent() {
        //     var newHeight = $("html").height() + "px";
        //     $("html").css("min-height", newHeight);
        // };
        // sizeContent();
        // $(window).resize(sizeContent);


// Navigation Tabulatur *************************************************************************************************
        $('nav ul').on('keydown','li',function(e){

            if(e.keyCode == 13){
                // console.log($(this));
                // console.log($(this.children));
                // console.log($(this.children[0]));
                // console.log($(this.children)[0]);
                // console.log(e);
                $(this).children()[0].click();
                // nein, bugged
            };
           
        });

        // focus 2.ebene 
        $('nav>ul>li>ul').on('focus','li',function(e){
            $(this).parent().css('left','auto');
            $(this).parent().css('opacity','1');
            // $(this).parent().css('margin-top','0.5em');
            $(this).parent().css('margin-left','0');

        });
        // on blur ausgangszustand
        // sache hier ist, dass .css() inline style schreibt, also onblur dieses wieder entfernen '' um auf stylesheet zurücksetzen
        $('nav>ul>li>ul').on('blur','li',function(e){
            $(this).parent().css('left','');
            $(this).parent().css('opacity','');
            $(this).parent().css('margin-top','');
            $(this).parent().css('margin-left','');
        });

        $('nav>ul>li>ul>li>ul').on('focus','li',function(e){
            $(this).parent().css('left','auto');
            $(this).parent().css('opacity','1');
            // $(this).parent().css('margin-top','0.5em');
            $(this).parent().css('margin-left','0'); 
            // $(this).css('left','auto');
            // $(this).css('margin-left','0');
            // $(this).css('margin-top','0');
        });

        // on blur 
        // 3.ebene nav
        $('nav ul li ul li ul').on('blur','li',function(e){
            // console.log(this);
            // console.log($(this).parent());
            $(this).parent().css('left','');
            $(this).parent().css('opacity','');
            $(this).parent().css('margin-left',''); 
            // $(this).parent().css('margin-top','0.5em');
            // $(this).css('left','');
            // $(this).css('margin-top','0'); 
        });

// lightbox
        lightbox.option({
            'resizeDuration': 400,
            'wrapAround': true,
            'positionFromTop': 100,
            'albumLabel':"Bild %1 von %2",
            'disableScrolling':true
            });

// Validation***************************************************************************************************
        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        };
        // Song erstmal nur Buchstaben und Leerzeichen
        function isSong(song) {
            var regex = /^[a-zA-Z\s]+$/;
            return regex.test(song);
        };

        // function validate() {
        // };

        function setError(object, message) {
            var $p = $('<p/>');
            $p.addClass('error');
            $p.text(message);
            $p.insertAfter(object);
        };

        // $('form').on('click',function(e){ beim klick auf jedes element des forms
        $('#addform').on('submit',function(e){
            // e.preventDefault();
            // alle eroors entfernen
            $('.error').each(function(){
                $(this).remove();
            });
            var errors= [];

            if ($('#song').val().trim() !== '') {
                if (isSong($('#song').val()) === false) {
                    setError('#song','Bitte nur Buchstaben und Leerzeichen eingeben.');
                    errors.push('song');
                }
            } else {
                setError('#song','Bitte ein Lied eingeben.');
                errors.push('song');
            }

            if ($('#band').val().trim() === '') {
                setError('#band','Bitte einen Interpret eingeben.');
                errors.push('band');
            }

            if ($('#tabs').val().trim() === '' && $('#linktext').is(':checked') === false) {
                setError('#tabs','Bitte einen Link bereitstellen oder Box klicken.');
                errors.push('tabs');
            }
            if ($('#tabs').val().trim() !== '' && $('#linktext').is(':checked') === true) {
                setError('#tabs','Bitte nicht beides.');
                errors.push('tabs');
            }

            if ($('#textarea').val().trim() === '' && $('#songtext').is(':checked') === false) {
                setError('#textarea','Bitte Liedtext bereitstellen oder Box klicken.');
                errors.push('textarea');
            }
            if ($('#textarea').val().trim() !== '' && $('#songtext').is(':checked') === true) {
                setError('#textarea','Bitte nicht beides.');
                errors.push('textarea');
            }

            if (errors.length !== 0) {
                e.preventDefault();
            }
        });
        

        $('#contactform').on('submit',function(e){

            $('.error').each(function(){
                $(this).remove();
            });
            var errors= [];

            if ($('#nachname').val().trim() === '') {
                setError('#nachname','Bitte geben Sie Ihren Namen ein.');
                errors.push('nachname');
            }
            if ($('#vorname').val().trim() === '') {
                setError('#vorname','Bitte geben Sie Ihren Vornamen ein.');
                errors.push('vorname');
            }

            if ($('#email').val().trim() === '') {
                setError('#email','Bitte geben Sie eine Email Adresse ein.');
                errors.push('email');
            }
            if ($('#email').val().trim() !== '' && isEmail($('#email').val()) === false) {
                setError('#email','Bitte geben Sie eine valide Email Adresse ein.');
                errors.push('email');
            }

            if ($('#message').val().trim() === '') {
                setError('#message','Bitte geben Sie eine Nachricht ein.');
                errors.push('textarea');
            }

            if (errors.length !== 0) {
                e.preventDefault();
            } 
        });

        $('#regform').on('submit',function(e){

            $('.error').each(function(){
                $(this).remove();
            });
            var errors= [];

            if ($('#email').val().trim() === '') {
                setError('#email','Bitte geben Sie eine Email Adresse ein.');
                errors.push('email');
            }
            if ($('#email').val().trim() !== '' && isEmail($('#email').val()) === false) {
                setError('#email','Bitte geben Sie eine valide Email Adresse ein.');
                errors.push('email');
            }

            if ($('#name').val().trim() === '') {
                setError('#name','Bitte geben Sie einen Namen ein.');
                errors.push('name');
            }

            if ($('#password').val().trim() === '') {
                setError('#password','Bitte geben Sie ein Passwort ein.');
                errors.push('password');
            }
            if ($('#password').val().trim() !== '') {

                if ($('#password').val().length < 3 && $('#password').val().trim() !== '') {
                    setError('#password','Das Passwort muss mindestens 3 Zeichen lang sein.');
                    errors.push('password');
                } else if ($('#password').val() !== $('#password_confirm').val() ) {
                    setError('#password','Die Passwörter stimmen nicht überein.');
                    errors.push('password');
                };

            };

            if (errors.length !== 0) {
                e.preventDefault();
            } 
        });

        $('#loginform').on('submit',function(e){

            $('.error').each(function(){
                $(this).remove();
            });
            var errors= [];

            if ($('#email').val().trim() === '') {
                setError('#email','Bitte geben Sie eine Email Adresse ein.');
                errors.push('email');
            }
            if ($('#email').val().trim() !== '' && isEmail($('#email').val()) === false) {
                setError('#email','Bitte geben Sie eine valide Email Adresse ein.');
                errors.push('email');
            }

            if ($('#password').val().trim() === '') {
                setError('#password','Bitte geben Sie ein Passwort ein.');
                errors.push('password');
            }

            if (errors.length !== 0) {
                e.preventDefault();
            } 
        });
    }); //_______end load
}(window,document,jQuery));