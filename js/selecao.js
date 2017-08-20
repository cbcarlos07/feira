/**
 * Created by carlos on 20/08/17.
 */
var selector = '.nav li';
var url = window.location.href;
var target = url.split('/');
$(selector).each(function(){
    if($(this).find('a').attr('href')===(target[target.length-1])){
        $(selector).removeClass('active');
        $(this).addClass('active');
    }
});