(function(window,document,$){
    $(function(){
        'use strict';

        // console.log(songs);
        // window.songs ? window.songs.length : 0

        // Show all anzeigen mit JS
        $('#unfold').removeClass('hide');
        var li_hide = true;


        function readMore() {
            if(!$('.hinweis').hasClass('hide')) {
                $('.hinweisfig').addClass('mehrlesen');
                $('.hinweis').addClass('hide');
            } else {
                return;
            }
        };

        // beim laden verbergen
        $('.letter ul').each(function(){
            $(this).addClass('hide');
        });
        // alle LIs einblenden und wieder ausblenden
        $('#unfold').on('click',function(){
            readMore();
            $('.letter ul').each(function(){
                if (li_hide) {
                    $(this).removeClass('hide');
                } else {
                    $(this).addClass('hide');
                }
            });
            if (li_hide){
                li_hide = false;
                $('#unfold').text('Hide all');
            } else {
                li_hide = true;
                $('#unfold').text('Show all');
            }
        });

        $('.letter h3').on('click',function(e){
            readMore();
            $('.letter ul').addClass('hide');
            // h3 -> div    -> ul als natives JS Obj -> class...
            $(this).parent().children()[1].classList.remove('hide');
            li_hide = true;
            $('#unfold').text('Show all');
        }); // _______end h3 click

        $('.entry').on('click',function(e){
            readMore();
            e.preventDefault();

            // div output enternen, eins von beiden?

            $('.output').remove();
            // $('<div/>').insertAfter($('main .clearfix').last());

            // Liste wieder ausblenden, in extrafunc auslagern.. nocch
            li_hide = true;
            $('#unfold').text('Show all');
            $('.letter ul').each(function(){
                    $(this).addClass('hide');
            });

            for (var i = 0; i < songs.length; i++) {
                if(this.childNodes[0].nodeValue === songs[i]['song']) {
                    // dynamisch einfügen nach dem letzten div mit der klasse clearfix in main
                    var $output = $('<div/>').insertAfter($('main .clearfix').last());
                    // console.log($('<div/>').insertAfter($('main .clearfix').last()));
                    $output.addClass('output clearfix');

                    var $outputleft = $('<div/>');
                    $outputleft.addClass('col2 outleft');

                    // var $span = $('<span/>').text(songs[i]['song']);
                    // var $h3 = $('<h3/>').html($span);
                    var $h3 = $('<h3/>').html('Titel: <span class="outlefth3">'+songs[i]['song']+'</span>');
                    $outputleft.append($h3);

                    var $h4 = $('<h4/>').html('Interpret: <span class="outlefth4">'+songs[i]['band']+'</span>');
                    $outputleft.append($h4);


                    if (songs[i]['tabs'] == 'NA') {
                        $outputleft.append($('<p/>').text('kein Link vorhanden'));
                    } else {
                        var $a = $('<a/>').text('Link zu Tabs');
                        $a.attr('href',songs[i]['tabs']).attr('target','_blank');
                        $outputleft.append($a);
                    };

                    $output.append($outputleft);

                    // open lyrics file, .txt for now
                    // über ajax?
                    var xhr = new XMLHttpRequest();
                    var file = './public/data/' + songs[i]['file'];
                    xhr.open("GET", file, true);
                    xhr.onreadystatechange = function () {
                        if(xhr.readyState === 4) {
                            // auf 0 prüfen wegen/falls local oder so, muss nich sein hier
                            if(xhr.status === 200 || xhr.status == 0) {

                                var $lyrics = xhr.responseText;
                                $lyrics = $lyrics.split('\n');
                                if ($lyrics[0] === 'NA') {
                                    $lyrics = '<p>kein Text vorhanden</p>';
                                } else {
                                    $lyrics = '<p>'+$lyrics.join('</p><p>')+'</p>';
                                }

                                var $outputright = $('<div/>');
                                $outputright.addClass('col2 outright');

                                $outputright.append($lyrics);
                                $output.append($outputright);
                            }
                        }
                    }
                    xhr.send();
                }
            }
        });//______end li

        $('.hinweisfig').on('click',function(){
            if ($('.hinweis').hasClass('hide')) {
                $('.hinweis').removeClass('hide');
                $(this).removeClass('mehrlesen');
            } else {
                readMore();
            }
        });
        
    }); //_______end load
}(window,document,jQuery));